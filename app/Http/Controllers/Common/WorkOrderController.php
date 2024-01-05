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
use App\Models\WorkOrderDetails;
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
        
     try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $data = WorkOrder::with('user','customer')->latest();
            } elseif ($User->user_type == 'Admin') {
                $data = WorkOrder::with('user','customer')->whereadmin_id($this->User->id)->latest();
            } else {
                $data = WorkOrder::with('user','customer')->whereadmin_id(Auth::user()->admin_id)->whereemployee_id($User->id)->latest();
            }
            if ($request->ajax()) {
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) use ($User) {
                        $btn = '<a href=' . route(request()->segment(1) . '.work-orders.show', (encrypt($data->id))) . ' class="btn btn-success btn-sm waves-effect" style="width:30px; padding: 5px"><i class="fa fa-eye"></i></a>';
                        $btn .= '<a href=' . route(request()->segment(1) . '.workOrderPdf', (encrypt($data->id))) . ' class="btn btn-info btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px"><i class="fas fa-file-pdf"></i></a>';
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
                'customer_id' => 'required',
                'convert_rate' => 'required|min:1',
                'total_vat' => 'required',
                'total_amount' => 'required',
                'product_id.*' => 'required',
                'product_quantity.*' => 'required',
                'product_price.*' => 'required',
                'product_total_price' => 'required',
                'currency_name' => 'required',
                'port_name' => 'required',

            ],

            [

                'customer_id.required' => "The Customer name field is required",
                'payment_method.required' => "The Payment Method name field is required",
                'total_amount.required' => "The Total amount name field is required",
                'product_id.required' => "The  Product name field is required",
                'product_price.required' => "The  Product Price name field is required",
                'product_quantity.required' => "The Product  Quantity name field is required",
                'product_total_price.required' => "The Product  Quantity name field is required",
            ]
        );

         try {
            DB::beginTransaction();
            $workorder = new WorkOrder();
            if (Auth::user()->user_type == 'Admin') {
                $workorder->admin_id  = Auth::id();
                $prefix = Helper::getAdmin(Auth::id())->invoice_slug;
            } else {
                $workorder->admin_id  = Auth::user()->admin_id;
                $workorder->employee_id  = Auth::id();
                $prefix = Helper::getAdmin(Auth::user()->admin_id)->invoice_slug;
            }
            $workorder->invoice_no = IdGenerator::generate(['table' => 'work_orders', 'field' => 'invoice_no', 'length' => 8, 'prefix' => $prefix, 'reset_on_prefix_change' => true]);
           $customer = $request->customer_id;
           $broker = $request->broker_id;
            $date = date('Y-m-d');
            $workorder->customer_id = $customer;
            $workorder->broker_id = $broker;
            $workorder->date = $request->date ?: $date;
            $workorder->total_vat = $request->total_vat;
            $workorder->currency_name = $request->currency_name;
            $workorder->port_name = $request->port_name;
            $workorder->total_quantity = $request->total_quantity ?: 0;
            $workorder->convert_rate = $request->convert_rate ?: 0;
            $workorder->broker_bonus = $request->broker_bonus ?: 0;
            $workorder->grand_total = $request->total_amount;
            $workorder->description = $request->description;
            $workorder->created_user_id = $this->User->id;
            $workorder->updated_user_id = $this->User->id;
            $workorder->created_at =  $date.date('H:i:s');
            $workorder->save();
            if ($workorder) {
                $products = $request->product_id;
                for ($i = 0; $i < count($products); $i++) {
                    $productId = $request->product_id[$i];
                    $price = $request->product_price[$i];
                    $name = $request->product_name[$i];
                    $qty = $request->product_quantity[$i];
                    $total = $request->product_total_price[$i];
                    $productVat = $request->product_vat[$i];
                    $productVatAmount = $request->product_vat_amount[$i];
                    $workorderDetail = new WorkOrderDetails();
                    $workorderDetail->work_order_id = $workorder->id;
                    $workorderDetail->admin_id = $workorder->admin_id;
                    $workorderDetail->product_id = $productId;
                    $workorderDetail->product_name = $name;
                    $workorderDetail->qty =  $qty;
                    $workorderDetail->product_price = $price;
                    $workorderDetail->product_vat_amount = $productVatAmount;
                    $workorderDetail->product_vat = $productVat;
                    $workorderDetail->product_total_price = $total;
                    $workorderDetail->save();
                }
            }
            if ((Auth::user()->user_type === 'Employee')) {
                $data = [
                    'message' => 'Your Staff ' . Auth::user()->name . '  Create A Invoice ' . $workorder->invoice_no,

                ];
                User::find(Auth::user()->admin_id)->notify(new Usernotification($data));
            }

            DB::commit();
            if ($request->has('quotation')) {
                Toastr::success("Quotation  Created Successfully  Done. Add  Another Quotation", "Success");
                return redirect()->back();
            } else {
                Toastr::success("Quotation Created Successfully", "Success");
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
     * @param  \App\Models\Category   $workorder
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

         try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $workorder = WorkOrder::with('user','customer','workorderdetails')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $workorder = WorkOrder::with('user','customer','workorderdetails')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $workorder = WorkOrder::with('user','customer','workorderdetails')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }

            return view('backend.common.work_orders.show', compact('workorder'));
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category   $workorder
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

         try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $data = WorkOrder::with('user','customer','workorderdetails')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $data = WorkOrder::with('user','customer','workorderdetails')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $data = WorkOrder::with('user','customer','workorderdetails')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }
           
            return view('backend.common.work_orders.edit')->with('workorder', $data);
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
                'customer_id' => 'required',
                'convert_rate' => 'required|min:1',
                'total_vat' => 'required',
                'total_amount' => 'required',
                'product_id.*' => 'required',
                'product_quantity.*' => 'required',
                'product_price.*' => 'required',
                'product_total_price' => 'required',
                'currency_name' => 'required',
                'port_name' => 'required',
                'status' => 'required',

            ],

            [

                'customer_id.required' => "The Customer name field is required",
                'payment_method.required' => "The Payment Method name field is required",
                'total_amount.required' => "The Total amount name field is required",
                'product_id.required' => "The  Product name field is required",
                'product_price.required' => "The  Product Price name field is required",
                'product_quantity.required' => "The Product  Quantity name field is required",
                'product_total_price.required' => "The Product  Quantity name field is required",
            ]
        );

        try {
            DB::beginTransaction();
           
           
           $customer = $request->customer_id;
           $broker = $request->broker_id;
            $workorder = WorkOrder::find($id);
            if (Auth::user()->user_type == 'Admin') {
                $workorder->admin_id  = Auth::id();
              
            } else {
                $workorder->admin_id  = Auth::user()->admin_id;
                $workorder->employee_id  = Auth::id();
              
            }
            $workorder->customer_id = $customer;
            $workorder->broker_id = $broker;
            $workorder->date = $request->date ?: $date;
            $workorder->total_vat = $request->total_vat;
            $workorder->currency_name = $request->currency_name;
            $workorder->port_name = $request->port_name;
            $workorder->total_quantity = $request->total_quantity ?: 0;
            $workorder->convert_rate = $request->convert_rate ?: 0;
            $workorder->broker_bonus = $request->broker_bonus ?: 0;
            $workorder->grand_total = $request->total_amount;
            $workorder->description = $request->description;
            $workorder->updated_user_id = $this->User->id;
            $workorder->status = $request->status;
           $workorder->save();
            if ($workorder) {
                $products = $request->product_id;
                for ($i = 0; $i < count($products); $i++) {
                    $productId = $request->product_id[$i];
                    $price = $request->product_price[$i];
                    $name = $request->product_name[$i];
                    $qty = $request->product_quantity[$i];
                    $total = $request->product_total_price[$i];
                    $productVat = $request->product_vat[$i];
                    $productVatAmount = $request->product_vat_amount[$i];
                    $checkOrder = WorkOrderDetails::wherework_order_id($id)->whereproduct_id($productId)->first();
                    if ($checkOrder) {
                        $workorderDetail =WorkOrderDetails::find($checkOrder->id);

                    }else{
                        $workorderDetail = new WorkOrderDetails();
                    }
                    $workorderDetail->work_order_id = $workorder->id;
                    $workorderDetail->admin_id = $workorder->admin_id;
                    $workorderDetail->product_id = $productId;
                    $workorderDetail->product_name = $name;
                    $workorderDetail->qty =  $qty;
                    $workorderDetail->product_price = $price;
                    $workorderDetail->product_vat_amount = $productVatAmount;
                    $workorderDetail->product_vat = $productVat;
                    $workorderDetail->product_total_price = $total;
                    $workorderDetail->save();
                }
            }

            if ((Auth::user()->user_type === 'Employee')) {
                $data = [
                    'message' => 'Your Staff ' . Auth::user()->name . '  Update A Invoice ' . $workorder->invoice_no,

                ];
                User::find(Auth::user()->admin_id)->notify(new Usernotification($data));
            }

            DB::commit();
            if ($request->has('workorder')) {
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
     * @param  \App\Models\Category   $workorder
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkOrder  $workorder)
    {
        //
    }
    public function updateStatus(Request $request)
    {
        $workorder = WorkOrder::findOrFail($request->id);
        $workorder->status = $request->status;
        if ($workorder->save()) {
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
                $results[] = ['id' => $v->id, 'value' => $v->product_full_name . ' (' . $v->hs_code . ')', 'price' => $v->sale_price, 'saleprice' => $v->sale_price, 'vat' => $v->vat, 'sku' => $v->sku, 'hs_code' => $v->hs_code];
            }

            return response()->json($results);
        }
    }

   
    public function workOrderPdf($id){

     try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $workorder = WorkOrder::with('user','customer','workorderdetails')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $workorder = WorkOrder::with('user','customer','workorderdetails')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $workorder = WorkOrder::with('user','customer','workorderdetails')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }
// dd($workorder);
            $pdf = PDF::loadView('backend.common.work_orders.pdf', compact('workorder'));
            return $pdf->stream('work_order_invoice_' . now() . '.pdf');
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }
    

}
