<?php

namespace App\Http\Controllers\Common;
use PDF;
use App\Models\User;
use App\Helpers\Helper;
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
use App\Models\SaleReturn;
use App\Models\SaleReturnDetails;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Notifications\Usernotification;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class SaleReturnController extends Controller
{
    private $User;
    function __construct()
    {

        $this->middleware(function ($request, $next) {
            $this->User = Auth::user();
            if ($this->User->status == 0) {
                 Toastr::error('Your Account was De active Please Contact with Support Center', "Error");
                $request->session()->flush();
                return redirect('login');
            }
            return $next($request);
        });

        $this->middleware('permission:sale-return-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:sale-return-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:sale-return-edit', ['only' => ['edit', 'update', 'updateStatus']]);
        $this->middleware('permission:sale-return-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {


        try {

            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $data = SaleReturn::with('user', 'customer')->latest();
            } elseif ($User->user_type == 'Admin') {
                $data = SaleReturn::with('user', 'customer')->whereadmin_id($this->User->id)->latest();
            } else {
                $data = SaleReturn::with('user', 'customer')->whereadmin_id(Auth::user()->admin_id)->whereemployee_id($User->id)->latest();
            }
            if ($request->ajax()) {

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) use ($User) {
                        $btn = '<a href=' . route(request()->segment(1) . '.sale-returns.show', (encrypt($data->id))) . ' class="btn btn-success btn-sm waves-effect" style="width:30px; padding: 5px"><i class="fa fa-eye"></i></a>';

                        $btn .= '<a href=' . route(request()->segment(1) . '.sale-returns.edit', (encrypt($data->id))) . ' class="btn btn-primary btn-sm waves-effect" style="width:30px; padding: 5px; margin-left:2px;"><i class="fa fa-print"></i></a>';
                        $btn .= '<a href=' . route(request()->segment(1) . '.saleReturnPdf', (encrypt($data->id))) . ' class="btn btn-info btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px"><i class="fas fa-file-pdf"></i></a>';
                        return $btn;
                    })


                    ->rawColumns(['action'])
                    ->make(true);
            }
            $breadcrumbs = [
                ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
                ['link' => route(request()->segment(1) . '.sale-returns.index'), 'name' => "Sale"],
                ['name' => 'List'],
            ];
            return view('backend.common.sale_returns.index', compact('breadcrumbs'));
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    public function saleReturnPdf($id)
    {

         try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $sale = SaleReturn::with('shop', 'user', 'salereturndetails')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $sale = SaleReturn::with('shop', 'user', 'salereturndetails')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $sale = SaleReturn::with('shop', 'user', 'salereturndetails')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }

            $pdf = PDF::loadView('backend.common.sale_returns.pdf',compact('sale'));
            return $pdf->stream('sale_invoice_' . now() . '.pdf');
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
    public function saleReturnCreate($id)
    {
        try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $sale = Sale::with('shop', 'user', 'saledetails.product')->findOrFail($id);
            } elseif ($User->user_type == 'Admin') {
                $sale = Sale::with('shop', 'user', 'saledetails.product')->whereadmin_id($this->User->id)->findOrFail($id);
            } else {
                $sale = Sale::with('shop', 'user', 'saledetails.product')->whereadmin_id($this->User->admin_id)->findOrFail($id);
            }


        $breadcrumbs = [
            ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
            ['link' => route(request()->segment(1) . '.sale-returns.index'), 'name' => "Sale"],
            ['name' => 'Create'],
        ];
        return view('backend.common.sale_returns.create', compact('breadcrumbs','sale'));
    } catch (\Exception $e) {
        DB::rollBack();
        $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
        Toastr::error($response['message'], "Error");
        return back();
    }
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
                'payment_method' => 'required|min:1|max:300',
                'total_amount' => 'required',
                'product_id.*' => 'required',
                'product_price.*' => 'required',
                'product_total_price.*' => 'required',

            ],

            [

               'payment_method.required' => "The Payment Method name field is required",
                'total_amount.required' => "The Total amount name field is required",
                'total_amount.min' => "The Total amount Minimum Length 1",
                'total_amount.max' => "The Total amount Maximum Length 99999999",
                'product_id.required' => "The  Product name field is required",
                'product_total_price.required' => "The Product  Quantity name field is required",
            ]
        );

         try {
            DB::beginTransaction();

            $sale = Sale::find(decrypt($request->sale_id));
            $saleReturn=new SaleReturn();
            if (Auth::user()->user_type == 'Admin') {
                $saleReturn->admin_id  = Auth::id();
                $prefix = Helper::getAdmin(Auth::id())->invoice_slug;
            } else {
                $saleReturn->admin_id  = Auth::user()->admin_id;
                $saleReturn->employee_id  = Auth::id();
                $prefix = Helper::getAdmin(Auth::user()->admin_id)->invoice_slug;
            }
            $saleReturn->invoice_no = IdGenerator::generate(['table' => 'sale_returns', 'field' => 'invoice_no', 'length' => 8, 'prefix' => $prefix, 'reset_on_prefix_change' => true]);
            $shop = $sale->shop_id;
            $customer = $sale->customer_id;
            $date = date('Y-m-d');
            $saleReturn->shop_id = $shop;
            $saleReturn->customer_id = $customer;
            $saleReturn->date =$request->date?:$date;
            $saleReturn->total_vat = $request->total_vat;
            $saleReturn->discount = $request->product_total_discount ?: 0;
            $saleReturn->other_discount = $request->other_discount ?: 0;
            $saleReturn->total_discount = $request->total_discount ?: 0;
            $saleReturn->payment_method = $request->payment_method;
            $saleReturn->paid = $request->total_amount;
            $saleReturn->due =  0;
            $saleReturn->grand_total = $request->total_amount;
            $saleReturn->description = $request->description;
            $saleReturn->created_user_id = $this->User->id;
            $saleReturn->updated_user_id = $this->User->id;
            $saleReturn->save();
            if ($saleReturn) {
                $totalQuantity=0;
                $totalLossProfit=0;
                $saleProducts = $request->product_id;
                for ($i = 0; $i < count($saleProducts); $i++) {
                    $productId = $request->product_id[$i];
                    $salePrice = $request->product_price[$i];
                    $name = $request->product_name[$i];
                    $qty = $request->product_return_quantity[$i];
                    $total = $request->product_total_price[$i];
                    $productVat = $request->product_vat[$i];
                    $productVatAmount = $request->product_vat_amount[$i];
                    $productDiscount = $request->product_discount[$i];
                    $productDiscountAmount = $request->product_discount_amount[$i];
                    $averagePurchasePrice = $request->average_purchase_price[$i];

                    if($qty>0){
                    $totalQuantity+=$qty;
                    SaleDetails::wheresale_id($sale->id)->whereproduct_id($productId)->increment('already_return_qty',$qty);
                    $saleReturnDetail = new SaleReturnDetails();
                    $saleReturnDetail->sale_return_id = $saleReturn->id;
                    $saleReturnDetail->admin_id = $saleReturn->admin_id;
                    $saleReturnDetail->product_id = $productId;
                    $saleReturnDetail->product_name = $name;
                    $saleReturnDetail->return_qty =  $qty;
                    $saleReturnDetail->sale_price = $salePrice;
                    $saleReturnDetail->vat_percent = $productVat;
                    $saleReturnDetail->vat_amount = $productVatAmount;
                    $saleReturnDetail->discount_percent = $productDiscount;
                    $saleReturnDetail->discount_amount = $productDiscountAmount;
                    $saleReturnDetail->average_purchase_price = $averagePurchasePrice;
                    $saleReturnDetail->return_loss_profit_amount = ($salePrice*$qty-($qty*$saleReturn->extra_discount_percent)-$productDiscountAmount) -($saleReturnDetail->average_purchase_price * $qty);
                    $totalLossProfit+=$saleReturnDetail->return_loss_profit_amount;
                    $saleReturnDetail->total_price = $total;
                    $saleReturnDetail->save();
                    $checkShop = ShopCurrentStock::whereproduct_id($productId)->whereshop_id($shop)->first();
                     $checkShop->stock_qty+= $qty;
                     $checkShop->save();
                    }

                  }
                }

                $customerDue = new CustomerDue();
                $customerDue->customer_id =  $customer;
                $customerDue->sale_return_id =  $saleReturn->id;
                $customerDue->payment_method =  $request->payment_method;
                $customerDue->paid = $saleReturn->grand_total;
                $customerDue->phone_number = $request->phone_number;
                $customerDue->transaction_number = $request->transaction_number;
                $customerDue->bank_name = $request->bank_name;
                $customerDue->bank_account_number = $request->bank_account_number;
                $customerDue->note = 'Sale Return Invoice';
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
                    $customer=Customer::find($customerDue->customer_id);
                     $customer->total_due -=  $customerDue->paid;
                     $customer->total_balance -=  $customerDue->paid;
                     $customer->save();
                }

                $saleReturns=SaleReturn::find($saleReturn->id);
                $saleReturns->return_quantity=$totalQuantity;
                $saleReturns->total_loss_profit_amount=$totalLossProfit;
                $saleReturns->save();


            if ((Auth::user()->user_type === 'Employee')) {
                $data = [
                    'message' => 'Your Staff ' . Auth::user()->name . '  Create A Invoice ' . $sale->invoice_no,

                ];
                User::find(Auth::user()->admin_id)->notify(new Usernotification($data));
            }

            DB::commit();
           if($request->has('print')){
                return redirect()->route(request()->segment(1) . '.sale-returns.edit', (encrypt($sale->id)));
            }
             else {
                Toastr::success("Sale Return Created Successfully", "Success");
                return redirect()->route(request()->segment(1) . '.sale-returns.index');
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
                $saleReturn = SaleReturn::with('shop', 'user', 'salereturndetails')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $saleReturn = SaleReturn::with('shop', 'user', 'salereturndetails')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $saleReturn = SaleReturn::with('shop', 'user', 'salereturndetails')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }

            return view('backend.common.sale_returns.show', compact('saleReturn'));
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }




    }



    public function edit($id)
    {

        try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $saleReturn = SaleReturn::with('shop', 'user','customer', 'salereturndetails')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $saleReturn = SaleReturn::with('shop', 'user','customer', 'salereturndetails')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $saleReturn = SaleReturn::with('shop', 'user','customer', 'salereturndetails')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }
            return view('backend.common.sale_returns.print')->with('sale', $saleReturn);
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }

    }


    public function findSales(Request $request)
    {
        if ($request->has('q')) {

            if (Auth::user()->user_type == 'Superadmin') {
                $data = Sale::where(function ($query) use ($request) {
                    $query->where('invoice_no', 'like', '%' . $request->q . '%')->orWhere('date', 'like', '%' . $request->q . '%')->orWhere('grand_total', 'like', '%' . $request->q . '%');
                })->select('id', 'invoice_no', 'date', 'grand_total')->take(20)->get();
            } elseif (Auth::user()->user_type == 'Admin') {

                $data = Sale::whereadmin_id(Auth::id())->where(function ($query) use ($request) {
                    $query->where('invoice_no', 'like', '%' . $request->q . '%')->orWhere('date', 'like', '%' . $request->q . '%')->orWhere('grand_total', 'like', '%' . $request->q . '%');
                })->select('id', 'invoice_no', 'date', 'grand_total')->take(20)->get();
            } else {

                $data = Sale::whereadmin_id(Auth::user()->admin_id)->whereshop_id(Auth::user()->shop_id)->where(function ($query) use ($request) {
                    $query->where('invoice_no', 'like', '%' . $request->q . '%')->orWhere('date', 'like', '%' . $request->q . '%')->orWhere('grand_total', 'like', '%' . $request->q . '%');
                })->select('id', 'invoice_no', 'date', 'grand_total')->take(20)->get();
            }

            return response()->json($data);
        }
    }
}
