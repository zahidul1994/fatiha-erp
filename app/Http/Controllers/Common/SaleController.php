<?php

namespace App\Http\Controllers\Common;
use PDF;
use App\Models\User;
use App\Helpers\Helper;
use App\Models\Product;
use App\Models\Sale;
use App\Models\CustomerDue;
use App\Models\SaleDetails;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Helpers\ErrorTryCatch;
use App\Models\ShopCurrentStock;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Notifications\Usernotification;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class SaleController extends Controller
{
    private $User;
    function __construct()
    {

        $this->middleware(function ($request, $next) {
            $this->User = Auth::user();
            if ($this->User->status == 0) {
                $request->session()->flush();
                Toastr::error('Your Account was De active Please Contact with Support Center', "Error");
                return redirect('login');
            }
            return $next($request);
        });

        $this->middleware('permission:sale-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:sale-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:sale-edit', ['only' => ['edit', 'update', 'updateStatus']]);
        $this->middleware('permission:sale-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {


        try {

            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $data = Sale::with('user', 'customer')->latest();
            } elseif ($User->user_type == 'Admin') {
                $data = Sale::with('user', 'customer')->whereadmin_id($this->User->id)->latest();
            } else {
                $data = Sale::with('user', 'customer')->whereemployee_id($User->id)->latest();
            }
            if ($request->ajax()) {

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) use ($User) {
                        $btn = '<a href=' . route(request()->segment(1) . '.sales.show', (encrypt($data->id))) . ' class="btn btn-success btn-sm waves-effect"  style="width:30px; padding: 5px"><i class="fa fa-eye"></i></a>';
                        $btn .= '<a href=' . route(request()->segment(1) . '.sales.edit', (encrypt($data->id))) . ' class="btn btn-warning btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px"><i class="fa fa-edit"></i></a>';
                        $btn .= '<a href=' . route(request()->segment(1) . '.salePdf', (encrypt($data->id))) . ' class="btn btn-info btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px"><i class="fas fa-file-pdf"></i></a>';
                        $btn .= '<a href=' . route(request()->segment(1) . '.salePrint', (encrypt($data->id))) . ' class="btn btn-primary btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px"><i class="fa fa-print"></i></a>';
                        return $btn;
                    })
                    ->addColumn('status', function ($data) {
                        if ($data->grand_total == $data->paid) {
                            return '<button data-bs-toggle="tooltip" data-bs-placement="top" title="Paid" data-container="body" data-animation="true" class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-check" aria-hidden="true"></i></button>';
                        } elseif ($data->paid == 0) {
                            return '<button data-bs-toggle="tooltip" data-bs-placement="top" title="Due" data-container="body" class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-times" aria-hidden="true"></i></button>';
                        } else {
                            return '<button data-bs-toggle="tooltip" data-bs-placement="top" title="Partial" data-container="body" class="btn btn-icon-only btn-rounded btn-outline-dark mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-undo" aria-hidden="true"></i></button>';
                        }
                    })

                    ->rawColumns(['action', 'status'])
                    ->make(true);
            }
            $breadcrumbs = [
                ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
                ['link' => route(request()->segment(1) . '.sales.index'), 'name' => "Sale"],
                ['name' => 'List'],
            ];
            return view('backend.common.sales.index', compact('breadcrumbs'));
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
            ['link' => route(request()->segment(1) . '.sales.index'), 'name' => "Sale"],
            ['name' => 'Create'],
        ];
        return view('backend.common.sales.create', compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $request->dd();
        $this->validate($request,
            [
                'shop_id' => 'required|min:1|max:198',
                'customer_id' => 'required|min:1|max:198',
                'payment_method' => 'required|min:1|max:300',
                'paid' => 'max:99999999',
                'total_amount' => 'required|numeric|between:1,99999999',
                'product_id.*' => 'required',
                'product_quantity.*' => 'required',
                'product_price.*' => 'required|numeric|between:1,99999999',
                'product_total_price.*' => 'required|numeric|between:1,99999999',

            ],

            [

                'shop_id.required' => "The Shop name field is required",
                'customer_id.required' => "The Customer name field is required",
                'payment_method.required' => "The Payment Method name field is required",
                'total_amount.required' => "The Total amount name field is required",
                'total_amount.min' => "The Total amount Minimum Length 1",
                'total_amount.max' => "The Total amount Maximum Length 99999999",
                'product_id.required' => "The  Product name field is required",
                'product_price.required' => "The  Product Price name field is required",
                'product_price.min' => "The Product Price Minimum Length 1",
                'product_price.max' => "The Product Price  Maximum Length 99999999",
                'product_quantity.required' => "The Product  Quantity name field is required",
                'product_total_price.required' => "The Product  Quantity name field is required",
            ]
        );

        try {
            DB::beginTransaction();
            $sale = new Sale();
            if (Auth::user()->user_type == 'Admin') {
                $sale->admin_id  = Auth::id();
                $prefix = Helper::getAdmin(Auth::id())->invoice_slug;
            } else {
                $sale->admin_id  = Auth::user()->admin_id;
                $sale->employee_id  = Auth::id();
                $prefix = Helper::getAdmin(Auth::user()->admin_id)->invoice_slug;
            }
            $sale->invoice_no = IdGenerator::generate(['table' => 'sales', 'field' => 'invoice_no', 'length' => 8, 'prefix' => $prefix, 'reset_on_prefix_change' => true]);
            $shop = $request->shop_id;
            $customer = $request->customer_id;
            $date = date('Y-m-d');
            $sale->shop_id = $shop;
            $sale->customer_id = $customer;
            $sale->date = $date;
            $paidAmount=$request->paid?:0;
            if($request->total_amount>=$paidAmount){
                 $due=$request->total_amount - $paidAmount;
                 $change=0;
            }else{
                $due=0;
                $change=$paidAmount - $request->total_amount;
            }
            $sale->total_vat = $request->total_vat;
            $sale->reference = $request->reference;
            $sale->discount = $request->product_total_discount ?: 0;
            $sale->other_discount = $request->other_discount ?: 0;
            $sale->total_discount = $request->total_discount ?: 0;
            $sale->payment_method = $request->payment_method;
            $sale->change_amount =$change;
            $sale->pay_amount =  $paidAmount;
            $sale->paid = $paidAmount-$change;
            $sale->due =  $due;
            $sale->extra_discount_percent = $request->extra_discount_percent ?: 0;
             $sale->total_quantity = $request->total_quantity ?: 0;
            $sale->grand_total = $request->total_amount;
            $sale->description = $request->description;
            $sale->created_user_id = $this->User->id;
            $sale->updated_user_id = $this->User->id;
            $sale->save();
            if ($sale) {

                $saleProducts = $request->product_id;
                $totalLossProfit=0;
              for ($i = 0; $i <count($saleProducts); $i++) {
                    $productId = $request->product_id[$i];
                    $price = $request->product_price[$i];
                    $name = $request->product_name[$i];
                    $qty = $request->product_quantity[$i];
                    $total = $request->product_total_price[$i];
                    $productVat = $request->product_vat[$i];
                    $productVatAmount = $request->product_vat_amount[$i];
                    $productDiscount = $request->product_discount[$i];
                    $productDiscountAmount = $request->product_discount_amount[$i];
                    $shopStock = ShopCurrentStock::whereshop_id($shop)->whereproduct_id($productId)->first();
                    $shopStock->stock_qty -=$qty;
                    $shopStock->save();
                    $saleDetail = new SaleDetails();
                    $saleDetail->sale_id = $sale->id;
                    $saleDetail->admin_id = $sale->admin_id;
                    $saleDetail->product_id = $productId;
                    $saleDetail->product_name = $name;
                    $saleDetail->qty =  $qty;
                    $saleDetail->average_purchase_price = Product::find($productId)->average_price;
                    $saleDetail->sale_price = $price;
                    $saleDetail->loss_profit_amount = ($price*$qty-($qty*$sale->extra_discount_percent)-$productDiscountAmount) -($saleDetail->average_purchase_price * $qty);
                    $totalLossProfit+=$saleDetail->loss_profit_amount;
                    $saleDetail->vat_percent = $productVat;
                    $saleDetail->vat_amount = $productVatAmount;
                    $saleDetail->discount_percent = $productDiscount;
                    $saleDetail->discount_amount = $productDiscountAmount;
                    $saleDetail->total_price = $total;
                    $saleDetail->save();
                }


            }
            $customerDue = new CustomerDue();
            $customerDue->customer_id =  $customer;
            $customerDue->sale_id =  $sale->id;
            $customerDue->payment_method =  $request->payment_method;
            $customerDue->paid = $sale->paid ?: 0;
            $customerDue->due = $request->total_amount;
            $customerDue->phone_number = $request->phone_number;
            $customerDue->transaction_number = $request->transaction_number;
            $customerDue->bank_name = $request->bank_name;
            $customerDue->bank_account_number = $request->bank_account_number;
            $customerDue->note = 'Sale Invoice';
            if ($this->User->user_type == "Admin") {
                $customerDue->admin_id = $this->User->id;
                $prefix = Helper::getAdmin(Auth::id())->invoice_slug;
            } else {
                $customerDue->admin_id = $this->User->admin_id;
                $customerDue->employee_id = $this->User->id;
                $prefix = Helper::getAdmin(Auth::user()->admin_id)->invoice_slug;
            }
            $customerDue->invoice_no = IdGenerator::generate(['table' => 'customer_dues', 'field' => 'invoice_no', 'length' => 8, 'prefix' => $prefix, 'reset_on_prefix_change' => true]);
            $customerDue->created_user_id = $this->User->id;
            $customerDue->updated_user_id = $this->User->id;
            $customerDue->save();
            if($customerDue){
                $customer=Customer::find($customer);
                $customer->total_due += $customerDue->due;
                $customer->total_paid += $customerDue->paid;
                $customer->total_balance += $customerDue->due-$customerDue->paid;
                $customer->save();
                }
            $saleUpdate=Sale::find($sale->id);
            $saleUpdate->sub_total =SaleDetails::wheresale_id($sale->id)->sum('sale_price');
            $saleUpdate->save();
            if ((Auth::user()->user_type === 'Employee')) {
                $data = [
                    'message' => 'Your Staff ' . Auth::user()->name . '  Create A Invoice ' . $sale->invoice_no,

                ];
                User::find(Auth::user()->admin_id)->notify(new Usernotification($data));
            }

            $saleUpdate=Sale::find($sale->id);
            $saleUpdate->total_loss_profit_amount= $totalLossProfit;
            $saleUpdate->save();
            DB::commit();
            if ($request->has('sale')) {
                Toastr::success("Sale Created Successfully  Done. Add  Another Sale", "Success");
                return redirect()->back();
            }elseif($request->has('print')){
                return redirect()->route(request()->segment(1) . '.salePrint', (encrypt($sale->id)));
            }
             else {
                Toastr::success("Sale Created Successfully", "Success");
                return redirect()->route(request()->segment(1) . '.sales.index');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category   $sale
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

         try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $sale = Sale::with('shop', 'user', 'saledetails.product')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $sale = Sale::with('shop', 'user', 'saledetails.product')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $sale = Sale::with('shop', 'user', 'saledetails.product')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }

            return view('backend.common.sales.show', compact('sale'));
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category   $sale
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        try {
            $User = $this->User;

            if ($User->user_type == 'Superadmin') {
                $data = Sale::with('shop', 'user','customerdue', 'saledetails')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $data = Sale::with('shop', 'user','customerdue', 'saledetails')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $data = Sale::with('shop', 'user', 'customerdue','saledetails')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }
            $paymentInfo = CustomerDue::wheresale_id($data->id)->first();
            if (empty($paymentInfo)) {
                $paymentInfo = [];
            }

            return view('backend.common.sales.edit', compact('paymentInfo'))->with('sale', $data);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }


    public function update(Request $request, $id)
    {

        $this->validate(
            $request,
            [

                'payment_method' => 'required|min:1|max:300',
                'paid' => 'max:99999999',
                'total_amount' => 'required|numeric|between:1,99999999',
                'product_id.*' => 'required',
                'product_quantity.*' => 'required',
                'product_price.*' => 'required|numeric|between:1,99999999',
                'product_total_price.*' => 'required|numeric|between:1,99999999',

            ],

            [

                'payment_method.required' => "The Payment Method name field is required",
                'total_amount.required' => "The Total amount name field is required",
                'total_amount.min' => "The Total amount Minimum Length 1",
                'total_amount.max' => "The Total amount Maximum Length 99999999",
                'product_id.required' => "The  Product name field is required",
                'product_price.required' => "The  Product Price name field is required",
                'product_price.min' => "The Product Price Minimum Length 1",
                'product_price.max' => "The Product Price  Maximum Length 99999999",
                'product_quantity.required' => "The Product  Quantity name field is required",
                'product_total_price.required' => "The Product  Quantity name field is required",
            ]
        );

        try {
            DB::beginTransaction();
            $sale = Sale::find($id);
            $shop = $sale->shop_id;
            $sale->shop_id = $shop;
            $paidAmount=$request->paid?:0;
            if($request->total_amount>=$paidAmount){
                 $due=$request->total_amount - $paidAmount;
                 $change=0;
            }else{
                $due=0;
                $change=$paidAmount - $request->total_amount;
            }
            $sale->total_vat = $request->total_vat;
            $sale->reference = $request->reference;
            $sale->discount = $request->product_total_discount ?: 0;
            $sale->other_discount = $request->other_discount ?: 0;
            $sale->total_discount = $request->total_discount ?: 0;
            $sale->payment_method = $request->payment_method;
            $sale->change_amount =$change;
            $sale->pay_amount =  $paidAmount;
            $sale->paid = $paidAmount-$change;
            $sale->due =  $due;
            $sale->total_quantity = $request->total_quantity ?: 0;
            $sale->extra_discount_percent = $request->extra_discount_percent ?: 0;
            $sale->grand_total = $request->total_amount;
            $sale->description = $request->description;
            $sale->updated_user_id = $this->User->id;
            $sale->save();
            if ($sale) {
                $totalLossProfit=0;
                $saleProducts = $request->product_id;
                for ($i = 0; $i < count($saleProducts); $i++) {
                    $productId = $request->product_id[$i];
                    $price = $request->product_price[$i];
                    $name = $request->product_name[$i];
                    $qty = $request->product_quantity[$i];
                    $total = $request->product_total_price[$i];
                    $productVat = $request->product_vat[$i];
                    $productVatAmount = $request->product_vat_amount[$i];
                    $productDiscount = $request->product_discount[$i];
                    $productDiscountAmount = $request->product_discount_amount[$i];
                    $checkStock = SaleDetails::wheresale_id($id)->whereproduct_id($productId)->first();
                    if ($checkStock) {
                        if ($checkStock->qty > $qty) {
                            $newQty = $checkStock->qty - $qty;
                            $checkShop = ShopCurrentStock::whereproduct_id($productId)->whereshop_id($shop)->first();
                            $checkShop->stock_qty -= $newQty;
                            $checkShop->save();
                        }
                        if ($checkStock->qty < $qty) {
                            $newQty = $qty - $checkStock->qty;
                            $checkShop->stock_qty += $newQty;
                            $checkShop->save();
                        }
                    } else {
                        $checkShop = ShopCurrentStock::whereproduct_id($productId)->whereshop_id($shop)->first();
                        $checkShop->stock_qty -= $qty;
                        $checkShop->save();
                    }
                    if ($checkStock) {
                        $checkStock->sale_id = $sale->id;
                        $checkStock->product_id = $productId;
                        $checkStock->product_name = $name;
                        $checkStock->qty =  $qty;
                        $checkStock->average_purchase_price = Product::find($productId)->average_price;
                        $checkStock->sale_price = $price;
                        $checkStock->loss_profit_amount = ($price*$qty-($qty*$sale->extra_discount_percent)-$productDiscountAmount) -($checkStock->average_purchase_price * $qty);
                        $totalLossProfit+=$checkStock->loss_profit_amount;
                        $checkStock->vat_percent = $productVat;
                        $checkStock->vat_amount = $productVatAmount;
                        $checkStock->discount_percent = $productDiscount;
                        $checkStock->discount_amount = $productDiscountAmount;
                        $checkStock->total_price = $total;
                        $checkStock->save();
                    } else {


                        $saleDetail = new SaleDetails();
                        $saleDetail->sale_id = $sale->id;
                        $saleDetail->admin_id = $sale->admin_id;
                        $saleDetail->product_id = $productId;
                        $saleDetail->product_name = $name;
                        $saleDetail->qty =  $qty;
                        $saleDetail->average_purchase_price = Product::find($productId)->average_price;
                        $saleDetail->sale_price = $price;
                        $saleDetail->loss_profit_amount = ($price*$qty-($qty*$sale->extra_discount_percent)-$productDiscountAmount) -($saleDetail->average_purchase_price * $qty);
                        $totalLossProfit+=$saleDetail->loss_profit_amount;
                        $saleDetail->vat_percent = $productVat;
                        $saleDetail->vat_amount = $productVatAmount;
                        $saleDetail->discount_percent = $productDiscount;
                        $saleDetail->discount_amount = $productDiscountAmount;
                        $saleDetail->total_price = $total;
                        $saleDetail->save();
                    }
                }
            }
            $customerDue = CustomerDue::wherecustomer_id($sale->customer_id)->wheresale_id($id)->first();
            $oldDue= $customerDue->due;
            $oldPaid= $customerDue->paid;
            $oldBalance= $oldDue-$oldPaid;
            $customerDue->payment_method =  $request->payment_method;
            $customerDue->paid = $sale->paid ?: 0;
            $customerDue->due = $request->total_amount;
            $customerDue->phone_number = $request->phone_number;
            $customerDue->transaction_number = $request->transaction_number;
            $customerDue->bank_name = $request->bank_name;
            $customerDue->bank_account_number = $request->bank_account_number;
            $customerDue->updated_user_id = $this->User->id;
            $customerDue->save();
            if($customerDue){
                $customer=Customer::find($customerDue->customer_id);
                 $customer->total_due -= $oldDue;
                 $customer->total_paid -= $oldPaid;
                 $customer->total_balance -=  $oldBalance;
                 $customer->save();
                if($customer){
                 $supplierNewDue=Customer::find($customerDue->customer_id);
                 $supplierNewDue->total_due += $sale->grand_total;
                 $supplierNewDue->total_paid +=$sale->paid;
                 $supplierNewDue->total_balance += $sale->grand_total-$sale->paid;
                 $supplierNewDue->save();

                }


         }

            $saleUpdate=Sale::find($sale->id);
            $saleUpdate->sub_total =SaleDetails::wheresale_id($sale->id)->sum('sale_price');
            $saleUpdate->total_loss_profit_amount= $totalLossProfit;
            $saleUpdate->save();

            if ((Auth::user()->user_type === 'Employee')) {
                $data = [
                    'message' => 'Your Staff ' . Auth::user()->name . '  Update A Invoice ' . $sale->invoice_no,

                ];
                User::find(Auth::user()->admin_id)->notify(new Usernotification($data));
            }

            DB::commit();
            if ($request->has('sale')) {
                Toastr::success("Sale Update Successfully  Done. Add  Another Sale", "Success");
                return redirect()->back();
            }elseif($request->has('print')){
                return redirect()->route(request()->segment(1) . '.salePrint', (encrypt($sale->id)));
            }
             else {
                Toastr::success("Sale Update Successfully", "Success");
                return redirect()->route(request()->segment(1) . '.sales.index');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category   $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale  $sale)
    {
        //
    }
    public function updateStatus(Request $request)
    {
        $sale = Sale::findOrFail($request->id);
        $sale->status = $request->status;
        if ($sale->save()) {
            return 1;
        }
        return 0;
    }
    public function findShopCurrentStock(Request $request)
    {
        if ($request->has('term')) {
            if (Auth::user()->user_type == 'Superadmin') {
                $data = ShopCurrentStock::wherestatus(1)->whereshop_id($request->shop_id)->where('stock_qty','>',0)->where(function ($query) use ($request) {
                    $query->where('product_name', 'like', '%' . $request->term . '%')->orWhere('barcode', 'like', '%' . $request->term . '%');
                })->inRandomOrder()->take(20)->get();
            } elseif (Auth::user()->user_type == 'Admin') {
                $data = ShopCurrentStock::whereadmin_id(Auth::id())->wherestatus(1)->where('stock_qty','>',0)->whereshop_id($request->shop_id)->where(function ($query) use ($request) {
                    $query->where('product_name', 'like', '%' . $request->term . '%')->orWhere('barcode', 'like', '%' . $request->term . '%');
                })->inRandomOrder()->take(20)->get();
            } else {

                $data = ShopCurrentStock::whereadmin_id(Auth::user()->admin_id)->wherestatus(1)->where('stock_qty','>',0)->whereshop_id($request->shop_id)->where(function ($query) use ($request) {
                    $query->where('product_name', 'like', '%' . $request->term . '%')->orWhere('barcode', 'like', '%' . $request->term . '%');
                })->inRandomOrder()->take(20)->get();
            }
            $results = array();
            foreach ($data as  $v) {
                $results[] = ['id' => $v->product_id, 'value' => $v->product->product_full_name, 'price' => $v->last_sale_price, 'stock' => $v->stock_qty, 'vat' => $v->last_purchase_vat, 'discount' => $v->discount];
            }

            return response()->json($results);
        }
    }
    public function findCustomer(Request $request)
    {
        if ($request->has('q')) {

            if (Auth::user()->user_type == 'Superadmin') {
                $data = Customer::wherestatus(1)->where(function ($query) use ($request) {
                    $query->where('customer_name', 'like', '%' . $request->q . '%')->orWhere('customer_phone', 'like', '%' . $request->q . '%');
                })->select('id', 'customer_name', 'customer_phone', 'discount')->take(20)->get();
            } elseif (Auth::user()->user_type == 'Admin') {

                $data = Customer::whereadmin_id(Auth::id())->wherestatus(1)->where(function ($query) use ($request) {
                    $query->where('customer_name', 'like', '%' . $request->q . '%')->orWhere('customer_phone', 'like', '%' . $request->q . '%');
                })->select('id', 'customer_name', 'customer_phone', 'discount')->take(20)->get();
            } else {

                $data = Customer::whereadmin_id(Auth::user()->admin_id)->wherestatus(1)->where(function ($query) use ($request) {
                    $query->where('customer_name', 'like', '%' . $request->q . '%')->orWhere('customer_phone', 'like', '%' . $request->q . '%');
                })->select('id', 'customer_name', 'customer_phone', 'discount')->take(20)->get();
            }

            return response()->json($data);
        }
    }

    public function salePdf($id)
    {

         try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $sale = Sale::with('shop', 'user', 'saledetails')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $sale = Sale::with('shop', 'user', 'saledetails')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $sale = Sale::with('shop', 'user', 'saledetails')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }

            $pdf = PDF::loadView('backend.common.sales.pdf',compact('sale'));
            return $pdf->stream('sale_invoice_' . now() . '.pdf');
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }



    public function salePrint($id)
    {

        try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $data = Sale::with('customer', 'user','shop','saledetails.product')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $data = Sale::with('customer', 'user','shop','saledetails.product')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $data = Sale::with('customer', 'user','shop','saledetails.product')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }
            return view('backend.common.sales.print')->with('sale', $data);
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }



}
