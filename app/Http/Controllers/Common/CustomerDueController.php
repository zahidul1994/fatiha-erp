<?php

namespace App\Http\Controllers\Common;

use PDF;
use App\Helpers\Helper;
use App\Models\Customer;
use App\Models\CustomerDue;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\ErrorTryCatch;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class CustomerDueController extends Controller
{
    private $User;
    function __construct()
    {

        $this->middleware(function ($request, $next) {
            $this->User = Auth::user();
            if ($this->User->status == 0) {
                $request->session()->flush();
                Toastr::error('Your Account was Deactive Please Contact with Support Center', "Error");
                return redirect('login');
            }
            return $next($request);
        });

        $this->middleware('permission:customer-due-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:customer-due-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:customer-due-edit', ['only' => ['edit', 'update', 'updateStatus']]);
        $this->middleware('permission:customer-due-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {

        try {
            $User = $this->User;

            if ($User->user_type == 'Superadmin') {
                $data = CustomerDue::with('user', 'customer')->latest();
            } elseif ($User->user_type == 'Admin') {
                $data = CustomerDue::with('user', 'customer')->whereadmin_id($this->User->id)->latest();
            } else {
                $data = CustomerDue::with('user', 'customer')->whereadmin_id($this->User->admin_id)->latest();
            }
            if ($request->ajax()) {

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) use ($User) {
                        $btn = '';
                        if ($User->can('customer-due-edit')) {
                            $btn = '<a href=' . route(request()->segment(1) . '.customer-due.edit', (encrypt($data->id))) . ' class="btn btn-info btn-sm waves-effect" style="width:30px; padding: 5px"><i class="fa fa-edit"></i></a>';
                        }
                        $btn .= '<a href=' . route(request()->segment(1) . '.customer-due.show', (encrypt($data->id))) . ' class="btn btn-success btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px"><i class="fa fa-eye"></i></a> <a href=' . route(request()->segment(1) . '.customerDuePdf', (encrypt($data->id))) . ' class="btn btn-primary btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px" target="_blank"><i class="fas fa-file-pdf"></i></a>';
                        $btn .= '</span>';
                        return $btn;
                    })


                    ->rawColumns(['action'])
                    ->make(true);
            }
            $breadcrumbs = [
                ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
                ['link' => route(request()->segment(1) . '.customer-due.index'), 'name' => "Customer Due"],
                ['name' => 'List'],
            ];

            return view('backend.common.customer_dues.index', compact('breadcrumbs'));
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
            ['link' => route(request()->segment(1) . '.customer-due.index'), 'name' => "Customer Due"],
            ['name' => 'Create'],
        ];
        if (Auth::user()->user_type == 'SuperAdmin') {
            $customers = Customer::wherestatus(1)->select(
                DB::raw("CONCAT(customer_name,' - ',customer_phone) AS name"),
                'id'
            )->pluck('name', 'id');
        } elseif (Auth::user()->user_type == 'Admin') {
            $customers = Customer::wherestatus(1)->whereadmin_id(Auth::id())->select(
                DB::raw("CONCAT(customer_name,' - ',customer_phone) AS name"),
                'id'
            )->pluck('name', 'id');
        } else {
            $customers = Customer::wherestatus(1)->whereadmin_id(Auth::user()->admin_id)->select(
                DB::raw("CONCAT(customer_name,' - ',customer_phone) AS name"),
                'id'
            )->pluck('name', 'id');
        }
        return view('backend.common.customer_dues.create', compact('breadcrumbs', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'customer_id' => 'required',
            'payment_method' => 'required',
            'paid' => 'required|numeric|between:1,99999999',
            'note' => 'max:330',

        ]);

        try {
            DB::beginTransaction();

            $customerdue = new CustomerDue();
            $customerdue->customer_id = $request->customer_id;
            $customerdue->paid = $request->paid;
            $customerdue->payment_method = $request->payment_method;
            $customerdue->phone_number = $request->phone_number;
            $customerdue->transaction_number = $request->transaction_number;
            if ($this->User->user_type == "Admin") {
                $customerdue->admin_id = $this->User->id;
                $prefix = Helper::getAdmin(Auth::id())->invoice_slug;
            } else {
                $customerdue->admin_id = $this->User->admin_id;
                $customerdue->employee_id = $this->User->id;
                $prefix = Helper::getAdmin(Auth::user()->admin_id)->invoice_slug;
            }
            $customerdue->invoice_no = IdGenerator::generate(['table' => 'customer_dues', 'field' => 'invoice_no', 'length' => 8, 'prefix' => $prefix, 'reset_on_prefix_change' => true]);
            $customerdue->created_user_id = $this->User->id;
            $customerdue->updated_user_id = $this->User->id;
            $customerdue->bank_name = $request->bank_name;
            $customerdue->bank_account_number = $request->bank_account_number;
            $customerdue->note = $request->note;
            $customerdue->save();
            if($customerdue){
                $customer=Customer::find($request->customer_id);
                $customer->total_paid += $customerdue->paid;
                $customer->total_balance -= $customerdue->paid;
                $customer->save();
            }
            DB::commit();
            Toastr::success("Customer Due Created Successfully", "Success");
            return redirect()->route(request()->segment(1) . '.customer-due.index');
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
     * @param  \App\Models\Category   $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $User = $this->User;
            if ($User->user_type == 'Admin') {
                $customerDue = CustomerDue::with('admin', 'user', 'customer')->whereadmin_id(Auth::id())->findOrFail(decrypt($id));
            } else {
                $customerDue = CustomerDue::with('admin', 'user', 'customer')->findOrFail(decrypt($id));
            }
            return view('backend.common.customer_dues.show')->with('customerDue', $customerDue);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category   $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $data = CustomerDue::findOrFail(decrypt($id));
                $customers = Customer::wherestatus(1)->select(
                    DB::raw("CONCAT(customer_name,' - ',customer_phone) AS name"),
                    'id'
                )->pluck('name', 'id');
            } elseif ($User->user_type == 'Admin') {
                $data = CustomerDue::whereadmin_id($User->id)->findOrFail(decrypt($id));
                $customers = Customer::wherestatus(1)->whereadmin_id(Auth::id())->select(
                    DB::raw("CONCAT(customer_name,' - ',customer_phone) AS name"),
                    'id'
                )->pluck('name', 'id');
            } else {
                $data = CustomerDue::whereadmin_id($User->admin_id)->findOrFail(decrypt($id));
                $customers = Customer::wherestatus(1)->whereadmin_id(Auth::user()->admin_id)->select(
                    DB::raw("CONCAT(customer_name,' - ',customer_phone) AS name"),
                    'id'
                )->pluck('name', 'id');
            }
            if(!empty($data->sale_id) || !empty($data->sale_return_id)){
                Toastr::warning('You Can not Edit or Update This Invoice', "Error");
                return back();
            }
            return view('backend.common.customer_dues.edit', compact('customers'))->with('customer', $data);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }


    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'customer_id' => 'required',
            'payment_method' => 'required',
            'paid' => 'required|numeric|between:1,99999999',
            'note' => 'max:330',

        ]);



        try {
            DB::beginTransaction();
            $customerdue = CustomerDue::find($id);
            $oldPaid= $customerdue->paid;
            $newPaid= $request->paid;
            $customerdue->customer_id = $request->customer_id;
            $customerdue->paid = $request->paid;
            $customerdue->payment_method = $request->payment_method;
            $customerdue->phone_number = $request->phone_number;
            $customerdue->transaction_number = $request->transaction_number;
            if ($this->User->user_type == "Admin") {
                $customerdue->admin_id = $this->User->id;
            } else {
                $customerdue->admin_id = $this->User->admin_id;
                $customerdue->employee_id = $this->User->id;
            }

            $customerdue->updated_user_id = $this->User->id;
            $customerdue->bank_name = $request->bank_name;
            $customerdue->bank_account_number = $request->bank_account_number;
            $customerdue->note = $request->note;
            $customerdue->save();
            if($customerdue){
                if($oldPaid<$newPaid){
                    $supplier=Customer::find($customerdue->customer_id);
                    $supplier->total_paid += $newPaid-$oldPaid;
                    $supplier->total_balance -= $newPaid-$oldPaid;
                    $supplier->save();
                }
                else{
                    $supplier=Customer::find($customerdue->customer_id);
                    $supplier->total_paid -= $oldPaid-$newPaid;
                    $supplier->total_balance += $oldPaid-$newPaid;
                    $supplier->save();
                }
            }
            DB::commit();
            Toastr::success("Customer Due Updated Successfully", "Success");
            return redirect()->route(request()->segment(1) . '.customer-due.index');
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
     * @param  \App\Models\Category   $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerDue  $category)
    {
        //
    }
    public function customerDuePdf($id)
    {

        try {

            $customerDue = CustomerDue::with('admin', 'user', 'customer')->findOrFail(decrypt($id));
            $pdf = PDF::loadView('backend.common.customer_dues.pdf', compact('customerDue'));
            return $pdf->stream('customer-due_' . now() . '.pdf');
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }
}
