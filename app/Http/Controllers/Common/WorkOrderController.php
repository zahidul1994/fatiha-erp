<?php

namespace App\Http\Controllers\Common;
use PDF;
use App\Models\User;
use App\Helpers\Helper;
use App\Models\Product;
use App\Models\WorkOrder;
use App\Models\Supplier;
use App\Models\SupplierDue;
use Illuminate\Http\Request;
use App\Helpers\ErrorTryCatch;
use App\Models\PurchaseDetails;
use App\Models\ShopCurrentStock;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Notifications\Usernotification;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class WorkOrderController extends Controller
{
    private $User;
    function __construct()
    {

        $this->middleware(function ($request, $next) {
            $this->User = Auth::user();
            if ($this->User->status == 0) {
                $request->session()->flush();
                Toastr::error('Your Account was De-active Please Contact with Support Center', "Error");
                return redirect('login');
            }
            return $next($request);
        });

        $this->middleware('permission:work-order-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:work-order-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:work-order-edit', ['only' => ['edit', 'update', 'updateStatus']]);
        $this->middleware('permission:work-order-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        
        // try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $data = WorkOrder::with('user')->latest();
            } elseif ($User->user_type == 'Admin') {
                $data = WorkOrder::with('user')->whereadmin_id($this->User->id)->latest();
            } else {
                $data = WorkOrder::with('user')->whereadmin_id(Auth::user()->admin_id)->whereemployee_id($User->id)->latest();
            }
            if ($request->ajax()) {
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) use ($User) {
                        $btn = '<a href=' . route(request()->segment(1) . '.work-orders.show', (encrypt($data->id))) . ' class="btn btn-success btn-sm waves-effect" style="width:30px; padding: 5px"><i class="fa fa-eye"></i></a>';
                        $btn .= '<a href=' . route(request()->segment(1) . '.purchasePdf', (encrypt($data->id))) . ' class="btn btn-info btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px"><i class="fas fa-file-pdf"></i></a>';
                        $btn .= '<a href=' . route(request()->segment(1) . '.purchaseChalan', (encrypt($data->id))) . ' class="btn btn-primary btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px"><i class="fa fa-receipt"></i></a>';
                        $btn .= '<a href=' . route(request()->segment(1) . '.work-orders.edit', (encrypt($data->id))) . ' class="btn btn-warning btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px"><i class="fa fa-edit"></i></a>';
                        return $btn;
                    })
                    

                    ->rawColumns(['action'])
                    ->make(true);
            }
            $breadcrumbs = [
                ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
                ['link' => route(request()->segment(1) . '.work-orders.index'), 'name' => "Work Order"],
                ['name' => 'List'],
            ];
            return view('backend.common.work_orders.index', compact('breadcrumbs'));
        // } catch (\Exception $e) {
        //     $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
        //     Toastr::error($response['message'], "Error");
        //     return back();
        // }
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
            ['link' => route(request()->segment(1) . '.work-orders.index'), 'name' => "WorkOrder"],
            ['name' => 'Create'],
        ];
        return view('backend.common.work_orders.create', compact('breadcrumbs'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
                'shop_id' => 'required',
                'supplier_id' => 'required|min:1|max:198',
                'payment_method' => 'required|min:1|max:300',
                'paid' => 'max:99999999',
                'total_amount' => 'required|numeric|between:1,99999999',
                'product_id.*' => 'required',
                'product_quantity.*' => 'required',
                'product_price.*' => 'required|numeric|between:1,99999999',
                'product_total_price' => 'required',

            ],

            [

                'shop_id.required' => "The Shop name field is required",
                'supplier_id.required' => "The Supplier name field is required",
                'payment_method.required' => "The Payment Method name field is required",
                'paid.max' => "The WorkOrder name Maximum Length 190",
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
            $purchase = new WorkOrder();
            if (Auth::user()->user_type == 'Admin') {
                $purchase->admin_id  = Auth::id();
                $prefix = Helper::getAdmin(Auth::id())->invoice_slug;
            } else {
                $purchase->admin_id  = Auth::user()->admin_id;
                $purchase->employee_id  = Auth::id();
                $prefix = Helper::getAdmin(Auth::user()->admin_id)->invoice_slug;
            }
            $purchase->invoice_no = IdGenerator::generate(['table' => 'work-orders', 'field' => 'invoice_no', 'length' => 8, 'prefix' => $prefix, 'reset_on_prefix_change' => true]);
            $shop = $request->shop_id;
            $supplier = $request->supplier_id;
            $date = date('Y-m-d');
            $purchase->shop_id = $shop;
            $purchase->supplier_id = $supplier;
            $purchase->date = $request->date ?: $date;
            $purchase->total_vat = $request->total_vat;
            $purchase->reference = $request->reference;
            $purchase->total_quantity = $request->total_quantity ?: 0;
            $purchase->extra_discount_percent = $request->extra_discount_percent ?: 0;
            $purchase->total_discount = $request->total_discount ?: 0;
            $purchase->sub_total = ($request->total_amount) - (($purchase->total_vat) + ($request->total_discount));
            $purchase->payment_method = $request->payment_method;
            $purchase->paid = $request->paid ?: 0;
            $purchase->due = ($request->total_amount) - ($purchase->paid);
            $purchase->grand_total = $request->total_amount;
            $purchase->description = $request->description;
            $purchase->created_user_id = $this->User->id;
            $purchase->updated_user_id = $this->User->id;
            $purchase->save();
            if ($purchase) {
                $purchaseProducts = $request->product_id;
                for ($i = 0; $i < count($purchaseProducts); $i++) {
                    $productId = $request->product_id[$i];
                    $price = $request->product_price[$i];
                    $name = $request->product_name[$i];
                    $qty = $request->product_quantity[$i];
                    $total = $request->product_total_price[$i];
                    $productVat = $request->product_vat[$i];
                    $expireDate = $request->product_expire_date[$i];
                    $productVatAmount = $request->product_vat_amount[$i];
                    $product = Product::find($productId);
                    $purchaseDetail = new PurchaseDetails();
                    $purchaseDetail->purchase_id = $purchase->id;
                    $purchaseDetail->admin_id = $purchase->admin_id;
                    $purchaseDetail->product_id = $productId;
                    $purchaseDetail->product_name = $name;
                    $purchaseDetail->qty =  $qty;
                    $purchaseDetail->average_purchase_price = $product->average_price;
                    $purchaseDetail->purchase_price = $price;
                    $purchaseDetail->vat_percent = $productVat;
                    $purchaseDetail->vat_amount = $productVatAmount;
                    $purchaseDetail->product_expire_date = $expireDate;
                    $purchaseDetail->total_price = $total;
                    $purchaseDetail->save();
                    $checkShop = ShopCurrentStock::whereproduct_id($productId)->whereshop_id($shop)->first();
                    if ($checkShop) {
                        $checkShop->increment('stock_qty', $qty);
                        $checkShop->product_name = $product->product_name;
                        $checkShop->sku = $product->sku;
                        $checkShop->barcode = $product->barcode;
                        $checkShop->last_purchase_price = $product->purchase_price;
                        $checkShop->last_sale_price = $product->sale_price;
                        $checkShop->last_purchase_discount = $product->discount;
                        $checkShop->discount = $product->discount;
                        $checkShop->last_purchase_vat = $product->vat;
                        $checkShop->expire_date = $expireDate;
                        $checkShop->save();
                    } else {
                        $checkShop = new ShopCurrentStock();
                        if (Auth::user()->user_type == 'Admin') {
                            $checkShop->admin_id = Auth::id();
                        } else {
                            $checkShop->admin_id = Auth::user()->admin_id;
                        }
                        $checkShop->shop_id = $shop;
                        $checkShop->product_id = $productId;
                        $checkShop->product_name = $product->product_name;
                        $checkShop->sku = $product->sku;
                        $checkShop->barcode = $product->barcode;
                        $checkShop->stock_qty = $qty;
                        $checkShop->last_purchase_price = $product->purchase_price;
                        $checkShop->last_sale_price = $product->sale_price;
                        $checkShop->last_purchase_discount = $product->discount;
                        $checkShop->discount = $product->discount;
                        $checkShop->last_purchase_vat = $product->vat;
                        $checkShop->expire_date = $expireDate;
                        $checkShop->save();
                    }
                    $average_purchase_price = 0;
                    $average_purchase_price = Helper::getAveragePrice($productId, $price, $qty, $shop);
                    $product->average_price = $average_purchase_price;
                    $product->save();
                }

                $supplierDue = new SupplierDue();
                $supplierDue->supplier_id =  $supplier;
                $supplierDue->purchase_id =  $purchase->id;
                $supplierDue->payment_method =  $request->payment_method;
                $supplierDue->phone_number = $request->phone_number;
                $supplierDue->transaction_number = $request->transaction_number;
                $supplierDue->bank_name = $request->bank_name;
                $supplierDue->bank_account_number = $request->bank_account_number;
                $supplierDue->paid = $request->paid ?: 0;
                $supplierDue->due = $purchase->sub_total;
                $supplierDue->note = 'WorkOrder Invoice';
                if ($this->User->user_type == "Admin") {
                    $supplierDue->admin_id = $this->User->id;
                    $prefix = Helper::getAdmin(Auth::id())->invoice_slug;
                } else {
                    $supplierDue->admin_id = $this->User->admin_id;
                    $supplierDue->employee_id = $this->User->id;
                    $prefix = Helper::getAdmin(Auth::user()->admin_id)->invoice_slug;
                }
                $supplierDue->invoice_no = IdGenerator::generate(['table' => 'supplier_dues', 'field' => 'invoice_no', 'length' => 8, 'prefix' => $prefix, 'reset_on_prefix_change' => true]);
                $supplierDue->created_user_id = $this->User->id;
                $supplierDue->updated_user_id = $this->User->id;
                $supplierDue->save();
                if($supplierDue){
                $supplier=Supplier::find($supplier);
                $supplier->total_due += $supplierDue->due;
                $supplier->total_paid += $supplierDue->paid;
                $supplier->total_balance += $supplierDue->due-$supplierDue->paid;
                $supplier->save();
                }
            }
            if ((Auth::user()->user_type === 'Employee')) {
                $data = [
                    'message' => 'Your Staff ' . Auth::user()->name . '  Create A Invoice ' . $purchase->invoice_no,

                ];
                User::find(Auth::user()->admin_id)->notify(new Usernotification($data));
            }

            DB::commit();
            if ($request->has('purchase')) {
                Toastr::success("WorkOrder Created Successfully  Done. Add  Another WorkOrder", "Success");
                return redirect()->back();
            } else {
                Toastr::success("WorkOrder Created Successfully", "Success");
                return redirect()->route(request()->segment(1) . '.work-orders.index');
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
     * @param  \App\Models\Category   $purchase
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $purchase = WorkOrder::with('shop', 'user', 'supplier', 'purchasedetails.product')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $purchase = WorkOrder::with('shop', 'user', 'supplier', 'purchasedetails.product')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $purchase = WorkOrder::with('shop', 'user', 'supplier', 'purchasedetails.product')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }

            return view('backend.common.work-orders.show', compact('purchase'));
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category   $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $data = WorkOrder::with('shop', 'user', 'purchasedetails.product')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $data = WorkOrder::with('shop', 'user', 'purchasedetails.product')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $data = WorkOrder::with('shop', 'user', 'purchasedetails.product')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }
            $paymentInfo = SupplierDue::wherepurchase_id($data->id)->first();
            if (empty($paymentInfo)) {
                $paymentInfo = [];
            }
            return view('backend.common.work-orders.edit', compact('paymentInfo'))->with('purchase', $data);
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
                'product_total_price' => 'required',

            ],

            [


                'payment_method.required' => "The Payment Method name field is required",
                'paid.max' => "The WorkOrder name Maximum Length 190",
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
            $purchase = WorkOrder::find($id);
            $shop = $purchase->shop_id;
            $supplier = $purchase->supplier_id;
            $purchase->shop_id = $shop;
            $purchase->supplier_id = $supplier;
            $purchase->total_vat = $request->total_vat;
            $purchase->reference = $request->reference;
            $purchase->total_quantity = $request->total_quantity ?: 0;
            $purchase->total_discount = $request->total_discount ?: 0;
            $purchase->extra_discount_percent = $request->extra_discount_percent ?: 0;
            $purchase->sub_total = ($request->total_amount) - (($purchase->total_vat) + ($request->total_discount));
            $purchase->payment_method = $request->payment_method;
            $purchase->paid = $request->paid ?: 0;
            $purchase->due = ($request->total_amount) - ($purchase->paid);
            $purchase->grand_total = $request->total_amount;
            $purchase->description = $request->description;
            $purchase->created_user_id = $this->User->id;
            $purchase->updated_user_id = $this->User->id;
            $purchase->save();
            if ($purchase) {
                $purchaseProducts = $request->product_id;
                for ($i = 0; $i < count($purchaseProducts); $i++) {
                    $productId = $request->product_id[$i];
                    $price = $request->product_price[$i];
                    $name = $request->product_name[$i];
                    $qty = $request->product_quantity[$i];
                    $total = $request->product_total_price[$i];
                    $productVat = $request->product_vat[$i];
                    $productVatAmount = $request->product_vat_amount[$i];
                    $expireDate = $request->product_expire_date[$i];
                    $product = Product::find($productId);
                    $checkShop = PurchaseDetails::wherepurchase_id($id)->whereproduct_id($productId)->first();
                    if ($checkShop) {
                        if ($checkShop->qty > $qty) {
                            $newQty = $checkShop->qty - $qty;
                            $stock = ShopCurrentStock::whereproduct_id($productId)->whereshop_id($shop)->first();
                            $stock->product_name = $product->product_name;
                            $stock->sku = $product->sku;
                            $stock->barcode = $product->barcode;
                            $stock->last_purchase_price = $product->purchase_price;
                            $stock->last_sale_price = $product->sale_price;
                            $stock->last_purchase_discount = $product->discount;
                            $stock->last_purchase_vat = $product->vat;
                            $stock->expire_date = $expireDate;
                            $stock->stock_qty -= $newQty;
                            $stock->save();
                        }
                        if ($checkShop->qty < $qty) {
                            $newQty = $qty - $checkShop->qty;
                            $stock = ShopCurrentStock::whereproduct_id($productId)->whereshop_id($shop)->first();
                            $stock->product_name = $product->product_name;
                            $stock->sku = $product->sku;
                            $stock->barcode = $product->barcode;
                            $stock->last_purchase_price = $product->purchase_price;
                            $stock->last_sale_price = $product->sale_price;
                            $stock->last_purchase_discount = $product->discount;
                            $stock->discount = $product->discount;
                            $stock->last_purchase_vat = $product->vat;
                            $stock->expire_date = $expireDate;
                            $stock->stock_qty += $newQty;
                            $stock->save();
                        }
                    } else {

                        $checkShopstock = ShopCurrentStock::whereproduct_id($productId)->whereshop_id($shop)->first();
                       if($checkShopstock){
                        $checkShopstock->increment('stock_qty', $qty);
                        $checkShopstock->product_name = $product->product_name;
                        $checkShopstock->sku = $product->sku;
                        $checkShopstock->barcode = $product->barcode;
                        $checkShopstock->last_purchase_price = $product->purchase_price;
                        $checkShopstock->last_sale_price = $product->sale_price;
                        $checkShopstock->last_purchase_discount = $product->discount;
                        $checkShopstock->discount = $product->discount;
                        $checkShopstock->last_purchase_vat = $product->vat;
                        $checkShopstock->expire_date = $expireDate;
                        $checkShopstock->save();
                       }else{
                        $checkShop = new ShopCurrentStock();
                        if (Auth::user()->user_type == 'Admin') {
                            $checkShop->admin_id = Auth::id();
                        } else {
                            $checkShop->admin_id = Auth::user()->admin_id;
                        }

                        $checkShop->shop_id = $shop;
                        $checkShop->product_id = $productId;
                        $checkShop->product_name = $product->product_name;
                        $checkShop->sku = $product->sku;
                        $checkShop->barcode = $product->barcode;
                        $checkShop->stock_qty = $qty;
                        $checkShop->last_purchase_price = $product->purchase_price;
                        $checkShop->last_sale_price = $product->sale_price;
                        $checkShop->last_purchase_discount = $product->discount;
                        $checkShop->discount = $product->discount;
                        $checkShop->last_purchase_vat = $product->vat;
                        $checkShop->expire_date = $expireDate;
                        $checkShop->save();
                       }

                    }

                        $purchaseId = $purchase->id;
                        $purchaseCheck = PurchaseDetails::wherepurchase_id($purchaseId)->whereproduct_id($productId)->first();
                        if ($purchaseCheck) {
                            $purchaseCheck->qty =  $qty;
                            $purchaseCheck->purchase_price = $price;
                            $purchaseCheck->vat_percent = $productVat;
                            $purchaseCheck->vat_amount = $productVatAmount;
                            $purchaseCheck->total_price = $total;
                            $purchaseCheck->product_expire_date = $expireDate;
                            $purchaseCheck->save();
                        } else {
                            $purchaseDetail = new PurchaseDetails();
                            $purchaseDetail->purchase_id = $purchaseId;
                            $purchaseDetail->admin_id = $purchase->admin_id;
                            $purchaseDetail->product_id = $productId;
                            $purchaseDetail->product_name = $name;
                            $purchaseDetail->qty =  $qty;
                            $purchaseDetail->average_purchase_price = $product->average_price;
                            $purchaseDetail->purchase_price = $price;
                            $purchaseDetail->vat_percent = $productVat;
                            $purchaseDetail->vat_amount = $productVatAmount;
                            $purchaseDetail->total_price = $total;
                            $purchaseDetail->product_expire_date = $expireDate;
                            $purchaseDetail->save();
                        }
                    }

                    $average_purchase_price = 0;
                    $average_purchase_price = Helper::getAveragePrice($productId, $price, $qty, $shop);
                    $product->average_price = $average_purchase_price;
                    $product->save();
                }

                $supplierDue = SupplierDue::wheresupplier_id($supplier)->wherepurchase_id($purchaseId)->first();
                $oldDue= $supplierDue->due;
                $oldPaid= $supplierDue->paid;
                $oldBalance= $oldDue-$oldPaid;
                $supplierDue->payment_method =  $request->payment_method;
                $supplierDue->paid = $purchase->paid;
                $supplierDue->due = $purchase->sub_total;
                $supplierDue->phone_number = $request->phone_number;
                $supplierDue->transaction_number = $request->transaction_number;
                $supplierDue->bank_name = $request->bank_name;
                $supplierDue->bank_account_number = $request->bank_account_number;
                $supplierDue->note = 'WorkOrder Invoice';
                $supplierDue->updated_user_id = $this->User->id;
                $supplierDue->save();
                if($supplierDue){
                           $supplier=Supplier::find($supplierDue->supplier_id);
                            $supplier->total_due -= $oldDue;
                            $supplier->total_paid -= $oldPaid;
                            $supplier->total_balance -=  $oldBalance;
                            $supplier->save();

                           if($supplier){
                            $supplierNewDue=Supplier::find($supplierDue->supplier_id);
                            $supplierNewDue->total_due += $purchase->sub_total;
                            $supplierNewDue->total_paid +=$purchase->paid;
                            $supplierNewDue->total_balance += $purchase->sub_total-$purchase->paid;
                            $supplierNewDue->save();

                           }


                    }

            if ((Auth::user()->user_type === 'Employee')) {
                $data = [
                    'message' => 'Your Staff ' . Auth::user()->name . '  Update A Invoice ' . $purchase->invoice_no,

                ];
                User::find(Auth::user()->admin_id)->notify(new Usernotification($data));
            }

            DB::commit();
            if ($request->has('purchase')) {
                Toastr::success("WorkOrder Update Successfully  Done. Add  Another WorkOrder", "Success");
                return redirect()->back();
            } else {
                Toastr::success("WorkOrder Update Successfully", "Success");
                return redirect()->route(request()->segment(1) . '.work-orders.index');
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
     * @param  \App\Models\Category   $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkOrder  $purchase)
    {
        //
    }
    public function updateStatus(Request $request)
    {
        $purchase = WorkOrder::findOrFail($request->id);
        $purchase->status = $request->status;
        if ($purchase->save()) {
            return 1;
        }
        return 0;
    }

   
    public function findWorkOrderProduct(Request $request)
    {
        if ($request->has('term')) {
            if (Auth::user()->user_type == 'Superadmin') {
                $data = Product::wherestatus(1)->where(function ($query) use ($request) {
                    $query->where('product_full_name', 'like', '%' . $request->term . '%')->orWhere('hs_code', 'like', '%' . $request->term . '%');
                })->select('id', 'product_full_name', 'purchase_price', 'sale_price', 'hs_code', 'vat', 'sku', 'expire_date')->inRandomOrder()->take(20)->get();
            } elseif (Auth::user()->user_type == 'Admin') {
                $data = Product::whereadmin_id(Auth::id())->wherestatus(1)->where(function ($query) use ($request) {
                    $query->where('product_full_name', 'like', '%' . $request->term . '%')->orWhere('hs_code', 'like', '%' . $request->term . '%');
                })->select('id', 'product_full_name', 'purchase_price', 'sale_price', 'hs_code', 'vat', 'sku', 'expire_date')->inRandomOrder()->take(20)->get();
            } else {

                $data = Product::whereadmin_id(Auth::user()->admin_id)->wherestatus(1)->where(function ($query) use ($request) {
                    $query->where('product_full_name', 'like', '%' . $request->term . '%')->orWhere('hs_code', 'like', '%' . $request->term . '%');
                })->select('id', 'product_full_name', 'purchase_price', 'sale_price', 'hs_code', 'vat', 'sku', 'expire_date')->inRandomOrder()->take(20)->get();
            }
            $results = array();
            foreach ($data as  $v) {
                $results[] = ['id' => $v->id, 'value' => $v->product_full_name . ' (' . $v->hs_code . ')', 'price' => $v->purchase_price, 'saleprice' => $v->sale_price, 'averageprice' => $v->average_price, 'tax' => $v->vat, 'sku' => $v->sku, 'hs_code' => $v->hs_code, 'date' => $v->expire_date];
            }

            return response()->json($results);
        }
    }

   
    public function purchasePdf($id)
    {

         try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $purchase = WorkOrder::with('shop', 'user', 'supplier', 'purchasedetails')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $purchase = WorkOrder::with('shop', 'user', 'supplier', 'purchasedetails')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $purchase = WorkOrder::with('shop', 'user', 'supplier', 'purchasedetails')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }

            $pdf = PDF::loadView('backend.common.work-orders.pdf', compact('purchase'));
            return $pdf->stream('purchase_invoice_' . now() . '.pdf');
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }
    public function purchaseChalan($id)
    {

        try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $purchase = WorkOrder::with('shop', 'user', 'supplier', 'purchasedetails')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $purchase = WorkOrder::with('shop', 'user', 'supplier', 'purchasedetails')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $purchase = WorkOrder::with('shop', 'user', 'supplier', 'purchasedetails')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }

            return view('backend.common.work-orders.chalan', compact('purchase'));
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

}
