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

        try {

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
        $request->dd();

        $this->validate(
            $request,
            [
                'supplier_id' => 'required',
                'total_quantity' => 'required|min:1',
                'product_quantity.*' => 'required',
                'product_name.*' => 'required',
            ]
        );

        // try {
            DB::beginTransaction();
            $requisition = new Requisition();
            if (Auth::user()->user_type == 'Admin') {
                $requisition->admin_id  = Auth::id();
                $prefix = Helper::getAdmin(Auth::id())->invoice_slug;
            } else {
                $requisition->admin_id  = Auth::user()->admin_id;
                $requisition->employee_id  = Auth::id();
                $prefix = Helper::getAdmin(Auth::user()->admin_id)->invoice_slug;
            }
            $requisition->invoice_no = IdGenerator::generate(['table' => 'requisitions', 'field' => 'invoice_no', 'length' => 8, 'prefix' => $prefix, 'reset_on_prefix_change' => true]);
            $supplier = $request->supplier_id;
            $date = date('Y-m-d');
            $requisition->supplier_id = $supplier;
            $requisition->work_order_id = $request->work_order_id;
            $requisition->date = $request->date ?: $date;
            $requisition->total_quantity = $request->total_quantity;
            $requisition->description = $request->description;
            $requisition->created_user_id = $this->User->id;
            $requisition->updated_user_id = $this->User->id;
            $requisition->created_at =  $date . date('H:i:s');
            $requisition->save();
            if ($requisition) {
                if($requisition->work_order_id){
                    $order=WorkOrder::find($request->work_order_id);
                    $order->requisition_status='Yes';
                    $order->save();
                }
               
                $products = $request->product_id;
                for ($i = 0; $i < count($products); $i++) {
                    $productId = $request->product_id[$i];
                    $name = $request->product_name[$i];
                    $qty = $request->product_quantity[$i];
                    $requisitionDetail = new RequisitionDetails();
                    $requisitionDetail->requisition_id = $requisition->id;
                    $requisitionDetail->admin_id = $requisition->admin_id;
                    $requisitionDetail->product_id = $productId;
                    $requisitionDetail->product_name = $name;
                    $requisitionDetail->qty =  $qty;
                    $requisitionDetail->save();
                }
            }
            if ((Auth::user()->user_type === 'Employee')) {
                $data = [
                    'message' => 'Your Staff ' . Auth::user()->name . '  Create A Invoice ' . $requisition->invoice_no,

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
     * @param  \App\Models\Category   $requisition
     * @return \Illuminate\Http\Response
     */
   
    public function reject($id)
    {
        $requisition = Requisition::findOrFail(decrypt($id));
        $requisition->status = 'Reject';
        if ($requisition->save()) {
            Toastr::warning("Requisition Reject", "Warning");
                return redirect()->route(request()->segment(1) . '.requisition-receive.index');
        }
        return 0;
    }





   
}
