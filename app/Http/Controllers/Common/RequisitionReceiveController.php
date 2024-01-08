<?php

namespace App\Http\Controllers\Common;

use PDF;
use App\Models\User;
use App\Helpers\Helper;
use App\Models\WorkOrder;
use App\Models\Requisition;
use Illuminate\Http\Request;
use App\Helpers\ErrorTryCatch;
use App\Models\RequisitionDetails;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetails;
use App\Models\Warehouse;
use App\Models\WarehouseStock;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Notifications\Usernotification;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class RequisitionReceiveController extends Controller
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

        $this->middleware('permission:requisition-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:requisition-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:requisition-edit', ['only' => ['edit', 'update', 'updateStatus']]);
        $this->middleware('permission:requisition-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {

        // try {

            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $data = Requisition::with('user', 'supplier')->latest();
            } elseif ($User->user_type == 'Admin') {
                $data = Requisition::with('user', 'supplier')->whereadmin_id($this->User->id)->wherestatus('Pending')->latest();
            } else {
                $data = Requisition::with('user', 'supplier')->whereadmin_id(Auth::user()->admin_id)->whereemployee_id($User->id)->wherestatus('Pending')->latest();
            }
            if ($request->ajax()) {
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) use ($User) {
                        $btn = '<a href=' . route(request()->segment(1) . '.requisitions.show', (encrypt($data->id))) . ' class="btn btn-success btn-sm waves-effect" style="width:30px; padding: 5px"><i class="fa fa-eye"></i></a>';
                        $btn .= '<a href=' . route(request()->segment(1) . '.requisition-reject', (encrypt($data->id))) . ' class="btn btn-warning btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px"><i class="fa fa-ban" title="Click for Reject" onclick="return confirm(`Are you sure to reject ?`)"></i></a>';
                        $btn .= '<a href=' . route(request()->segment(1) . '.requisition-purchase', (encrypt($data->id))) . ' class="btn btn-info btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px"><i class="fa fa-handshake" title="Click for Accept"></i></a>';
                        return $btn;
                    })


                    ->rawColumns(['action'])
                    ->make(true);
            }
            $breadcrumbs = [
                ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
                ['link' => route(request()->segment(1) . '.requisition-receive.index'), 'name' => "Requisition Receive"],
                ['name' => 'List'],
            ];
            return view('backend.common.requisition_receives.index', compact('breadcrumbs'));
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
    public function purchase($id)
    {
        $requisition = Requisition::with('user', 'supplier', 'requisitiondetails')->findOrFail(decrypt($id));
        $breadcrumbs = [
            ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
            ['link' => route(request()->segment(1) . '.requisition-receive.index'), 'name' => "Requisition Receive"],
            ['name' => 'Create'],
        ];

      

        return view('backend.common.requisition_receives.create', compact('breadcrumbs', 'requisition'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
       

        $this->validate(
            $request,
            [
                'date' => 'required',
                'supplier_id' => 'required',
                'status' => 'required',
                'total_quantity' => 'required|min:1',
                'grand_total' => 'required|min:1',
                'unit_price.*' => 'required',
                'vat.*' => 'required',
                'total_duty.*' => 'required',
                
            ]
        );

        // try {
            DB::beginTransaction();
            $purchase = new Purchase();
            if (Auth::user()->user_type == 'Admin') {
                $purchase->admin_id  = Auth::id();
                $prefix = Helper::getAdmin(Auth::id())->invoice_slug;
            } else {
                $purchase->admin_id  = Auth::user()->admin_id;
                $purchase->employee_id  = Auth::id();
                $prefix = Helper::getAdmin(Auth::user()->admin_id)->invoice_slug;
            }
            $purchase->invoice_no = IdGenerator::generate(['table' => 'purchases', 'field' => 'invoice_no', 'length' => 8, 'prefix' => $prefix, 'reset_on_prefix_change' => true]);
            $supplier = $request->supplier_id;
            $warehouse = $request->warehouse_id;
            $date = date('Y-m-d');
            $purchase->supplier_id = $supplier;
            $purchase->warehouse_id = $warehouse;
            $purchase->work_order_id = $request->work_order_id;
            $purchase->date = $request->date ?: $date;
            $purchase->total_quantity = $request->total_quantity;
            $purchase->grand_total = $request->grand_total;
            $purchase->paid = $request->paid?:0;
            $purchase->due = $request->due?:0;
            $purchase->description = $request->description;
            $purchase->created_user_id = $this->User->id;
            $purchase->updated_user_id = $this->User->id;
            $purchase->created_at =  $date . date('H:i:s');
            $purchase->save();
            if ($purchase) {
                // if($purchase->work_order_id){
                //     $order=WorkOrder::find($request->work_order_id);
                //     $order->requisition_status='Yes';
                //     $order->save();
                // }
               
                $products = $request->product_id;
                for ($i = 0; $i < count($products); $i++) {
                    $productId = $request->product_id[$i];
                    $name = $request->product_name[$i];
                    $qty = $request->product_quantity[$i];
                    $purchaseDetail = new PurchaseDetails();
                    $purchaseDetail->purchase_id = $purchase->id;
                    $purchaseDetail->admin_id = $purchase->admin_id;
                    $purchaseDetail->product_id = $productId;
                    $purchaseDetail->product_name = $name;
                    $purchaseDetail->qty =  $qty;
                    $purchaseDetail->weight_size = $request->weight_size[$i];
                    $purchaseDetail->unit = $request->unit[$i];
                    $purchaseDetail->hs_code = $request->hs_code[$i];
                    $purchaseDetail->unit_price = $request->unit_price[$i];
                    $purchaseDetail->govt_price = $request->govt_price[$i];
                    $purchaseDetail->insurance_before = $request->insurance_before[$i];
                    $purchaseDetail->insurance_before_value = $request->insurance_before_value[$i];
                    $purchaseDetail->clearing_before = $request->clearing_before[$i];
                    $purchaseDetail->clearing_before_value = $request->clearing_before_value[$i];
                    $purchaseDetail->convert_rate = $request->convert_rate[$i];
                    $purchaseDetail->duty_assessment_value = $request->duty_assessment_value[$i];
                    $purchaseDetail->cd = $request->cd[$i];
                    $purchaseDetail->cd_value = $request->cd_value[$i];
                    $purchaseDetail->rd = $request->rd[$i];
                    $purchaseDetail->rd_value = $request->rd_value[$i];
                    $purchaseDetail->cd_rd_total = $request->cd_rd_total[$i];
                    $purchaseDetail->sd = $request->sd[$i];
                    $purchaseDetail->sd_value = $request->sd_value[$i];
                    $purchaseDetail->vat = $request->vat[$i];
                    $purchaseDetail->vat_value = $request->vat_value[$i];
                    $purchaseDetail->ait = $request->ait[$i];
                    $purchaseDetail->ait_value = $request->ait_value[$i];
                    $purchaseDetail->at = $request->at[$i];
                    $purchaseDetail->at_value = $request->at_value[$i];
                    $purchaseDetail->atv = $request->atv[$i];
                    $purchaseDetail->atv_value = $request->atv_value[$i];
                    $purchaseDetail->total_duty = $request->total_duty[$i];
                    $purchaseDetail->insurance_after = $request->insurance_after[$i];
                    $purchaseDetail->insurance_after_value = $request->insurance_after_value[$i];
                    $purchaseDetail->bank_charge = $request->bank_charge[$i];
                    $purchaseDetail->bank_charge_value = $request->bank_charge_value[$i];
                    $purchaseDetail->clearing_after = $request->clearing_after[$i];
                    $purchaseDetail->clearing_after_value = $request->clearing_after_value[$i];
                    $purchaseDetail->carrying_charge = $request->carrying_charge[$i];
                    $purchaseDetail->carrying_value = $request->carrying_value[$i];
                    $purchaseDetail->lc_value = $request->lc_value[$i];
                    $purchaseDetail->other_cost = $request->other_cost[$i];
                    $purchaseDetail->purchase_price = $request->purchase_price[$i];
                    $purchaseDetail->save();


                    $checkStock = WarehouseStock::whereproduct_id($productId)->wherewarehouse_id($warehouse)->first();
                    if ($checkStock) {
                          $warehouseStock=$checkStock;
                          $warehouseStock->stock_qty += $qty;
                    }else{
                        $product=Product::find($productId);
                        $warehouseStock=new WarehouseStock();
                        $warehouseStock->stock_qty= $qty;
                        $warehouseStock->last_sale_price =$product->sale_price;
                        $warehouseStock->discount = $product->discount;
                        $warehouseStock->expire_date = $product->expire_date;
                        
                       }
                        
                        $warehouseStock->product_id = $productId;
                        $warehouseStock->warehouse_id = $warehouse;
                        $warehouseStock->product_name =  $name;
                        $warehouseStock->hs_code = $request->hs_code[$i];
                        $warehouseStock->last_purchase_price = $request->purchase_price[$i];
                        $warehouseStock->last_purchase_vat = $request->vat[$i];
                        $warehouseStock->save();
                    } 
                }

            if ((Auth::user()->user_type === 'Employee')) {
                $data = [
                    'message' => 'Your Staff ' . Auth::user()->name . '  Create A Invoice ' . $purchase->invoice_no,

                ];
                User::find(Auth::user()->admin_id)->notify(new Usernotification($data));
            }

            DB::commit();
            if ($request->has('quotation')) {
                Toastr::success("Requisition  Created Successfully  Done. Add  Another Quotation", "Success");
                return redirect()->back();
            } else {
                Toastr::success("Requisition Created Successfully", "Success");
                return redirect()->route(request()->segment(1) . '.requisitions.index');
            }
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
        //     Toastr::error($response['message'], "Error");
        //     return back();
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category   $purchase
     * @return \Illuminate\Http\Response
     */
   
    public function reject($id)
    {
        $purchase = Requisition::findOrFail(decrypt($id));
        $purchase->status = 'Reject';
        if ($purchase->save()) {
            Toastr::warning("Requisition Reject", "Warning");
                return redirect()->route(request()->segment(1) . '.purchase-receive.index');
        }
        return 0;
    }





   
}
