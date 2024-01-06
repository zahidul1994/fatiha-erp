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

class RequisitionController extends Controller
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
                $data = Requisition::with('user', 'supplier')->whereadmin_id($this->User->id)->latest();
            } else {
                $data = Requisition::with('user', 'supplier')->whereadmin_id(Auth::user()->admin_id)->whereemployee_id($User->id)->latest();
            }
            if ($request->ajax()) {
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) use ($User) {
                        $btn = '<a href=' . route(request()->segment(1) . '.requisitions.show', (encrypt($data->id))) . ' class="btn btn-success btn-sm waves-effect" style="width:30px; padding: 5px"><i class="fa fa-eye"></i></a>';
                        $btn .= '<a href=' . route(request()->segment(1) . '.workOrderPdf', (encrypt($data->id))) . ' class="btn btn-info btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px"><i class="fas fa-file-pdf"></i></a>';
                        $btn .= '<a href=' . route(request()->segment(1) . '.requisitions.edit', (encrypt($data->id))) . ' class="btn btn-warning btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px"><i class="fa fa-edit"></i></a>';
                        return $btn;
                    })


                    ->rawColumns(['action'])
                    ->make(true);
            }
            $breadcrumbs = [
                ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
                ['link' => route(request()->segment(1) . '.requisitions.index'), 'name' => "Requisition"],
                ['name' => 'List'],
            ];
            return view('backend.common.requisitions.index', compact('breadcrumbs'));
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
            ['link' => route(request()->segment(1) . '.requisitions.index'), 'name' => "Requisition"],
            ['name' => 'Create'],
        ];

        $workOrders = WorkOrder::wherestatus('WorkOrder')->whererequisition_status('No')->pluck('invoice_no', 'id');

        return view('backend.common.requisitions.create', compact('breadcrumbs', 'workOrders'));
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
                'supplier_id' => 'required',
                'total_quantity' => 'required|min:1',
                'product_quantity.*' => 'required',
                'product_name.*' => 'required',
            ]
        );

        try {
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
     * @param  \App\Models\Category   $requisition
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $requisition = Requisition::with('user', 'supplier', 'requisitiondetails')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $requisition = Requisition::with('user', 'supplier', 'requisitiondetails')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $requisition = Requisition::with('user', 'supplier', 'requisitiondetails')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }

            return view('backend.common.requisitions.show', compact('requisition'));
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category   $requisition
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $data = Requisition::with('user', 'supplier', 'requisitiondetails')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $data = Requisition::with('user', 'supplier', 'requisitiondetails')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $data = Requisition::with('user', 'supplier', 'requisitiondetails')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }

            return view('backend.common.requisitions.edit')->with('requisition', $data);
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
                'supplier_id' => 'required',
                'total_quantity' => 'required|min:1',
                'product_quantity.*' => 'required',
                'product_name.*' => 'required',
            ]
        );

        try {
            DB::beginTransaction();
            $supplier = $request->supplier_id;
            $requisition = Requisition::find($id);
            if (Auth::user()->user_type == 'Admin') {
                $requisition->admin_id  = Auth::id();
            } else {
                $requisition->admin_id  = Auth::user()->admin_id;
                $requisition->employee_id  = Auth::id();
            }
            $requisition->supplier_id = $supplier;
            $requisition->date = $request->date;
            $requisition->total_quantity = $request->total_quantity;
            $requisition->description = $request->description;
            $requisition->updated_user_id = $this->User->id;
            $requisition->save();
            if ($requisition) {
                $products = $request->product_id;
                for ($i = 0; $i < count($products); $i++) {
                    $productId = $request->product_id[$i];
                    $name = $request->product_name[$i];
                    $qty = $request->product_quantity[$i];
                    $checkOrder = RequisitionDetails::whererequisition_id($id)->whereproduct_id($productId)->first();
                    if ($checkOrder) {
                        $requisitionDetail = RequisitionDetails::find($checkOrder->id);
                    } else {
                        $requisitionDetail = new RequisitionDetails();
                    }
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
                    'message' => 'Your Staff ' . Auth::user()->name . '  Update A Invoice ' . $requisition->invoice_no,

                ];
                User::find(Auth::user()->admin_id)->notify(new Usernotification($data));
            }

            DB::commit();
            if ($request->has('requisition')) {
                Toastr::success("Requisition Update Successfully  Done. Add  Another Requisition", "Success");
                return redirect()->back();
            } else {
                Toastr::success("Requisition Update Successfully", "Success");
                return redirect()->route(request()->segment(1) . '.requisitions.index');
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
     * @param  \App\Models\Category   $requisition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requisition  $requisition)
    {
        //
    }
    public function updateStatus(Request $request)
    {
        $requisition = Requisition::findOrFail($request->id);
        $requisition->status = $request->status;
        if ($requisition->save()) {
            return 1;
        }
        return 0;
    }





    public function workOrderPdf($id)
    {

        try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $requisition = Requisition::with('user', 'suppllier', 'workorderdetails')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $requisition = Requisition::with('user', 'suppllier', 'workorderdetails')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $requisition = Requisition::with('user', 'suppllier', 'workorderdetails')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }
            // dd($requisition);
            $pdf = PDF::loadView('backend.common.requisitions.pdf', compact('requisition'));
            return $pdf->stream('work_order_invoice_' . now() . '.pdf');
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }
}
