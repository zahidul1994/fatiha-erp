<?php

namespace App\Http\Controllers\Common;
use PDF;
use App\Helpers\Helper;
use App\Models\Supplier;
use App\Models\SupplierDue;
use Illuminate\Http\Request;
use App\Helpers\ErrorTryCatch;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class SupplierController extends Controller
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

        $this->middleware('permission:supplier-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:supplier-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:supplier-edit', ['only' => ['edit', 'update', 'updateStatus']]);
        $this->middleware('permission:supplier-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {

        try {
            $User = $this->User;

            if ($User->user_type == 'Superadmin') {
                $data = Supplier::with('user', 'supplierdue')->latest();
            } elseif ($User->user_type == 'Admin') {
                $data = Supplier::with('user', 'supplierdue')->whereadmin_id($this->User->id)->latest();
            } else {
                $data = Supplier::with('user', 'supplierdue')->whereadmin_id($this->User->admin_id)->latest();
            }
            if ($request->ajax()) {

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) use ($User) {
                        $btn = '';
                            $btn = '<a href=' . route(request()->segment(1) . '.suppliers.show', (encrypt($data->id))) . ' class="btn btn-info btn-sm waves-effect" style="width:30px; padding: 5px"><i class="fa fa-eye"></i></a>';

                        $btn .= '<a href=' . route(request()->segment(1) . '.supplierPdf', (encrypt($data->id))) . ' class="btn btn-success btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px"><i class="fas fa-file-pdf"></i></a>';
                        if ($User->can('supplier-edit')) {
                        $btn .= '<a href=' . route(request()->segment(1) . '.suppliers.edit', (encrypt($data->id))) . ' class="btn btn-warning btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px"><i class="fa fa-edit"></i></a>';
                       }
                            $btn .= '</span>';
                        return $btn;
                    })
                    ->addColumn('status', function ($data) {
                        if ($data->status == 0) {
                            return '<div class="form-check form-switch"><input type="checkbox" id="flexSwitchCheckDefault" onchange="updateStatus(this)" class="form-check-input"  value=' . $data->id . ' /></div>';
                        } else {
                            return '<div class="form-check form-switch"><input type="checkbox" id="flexSwitchCheckDefault" checked="" onchange="updateStatus(this)" class="form-check-input"  value=' . $data->id . ' /></div>';
                        }
                    })

                    ->rawColumns(['action', 'status'])
                    ->make(true);
            }
            $breadcrumbs = [
                ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
                ['link' => route(request()->segment(1) . '.suppliers.index'), 'name' => "Supplier"],
                ['name' => 'List'],
            ];

            return view('backend.common.suppliers.index', compact('breadcrumbs'));
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
            ['link' => route(request()->segment(1) . '.suppliers.index'), 'name' => "Supplier"],
            ['name' => 'Create'],
        ];
        return view('backend.common.suppliers.create', compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->User->user_type == 'Admin') {
            $this->validate(
                $request,
                [

                    'supplier_phone' => 'required|min:9|max:30',
                    'address' => 'required|min:1|max:198',
                    'email' => 'max:198',
                    'supplier_name' => [
                        'required', 'min:1',
                        'max:198', Rule::unique('suppliers')->where(function ($query) {
                            return $query->where('admin_id', Auth::user()->id);
                        })
                    ]
                ],
                [
                    'supplier_name.unique' => "The Supplier name field need to be unique",
                    'supplier_name.required' => "The Supplier name field is required",
                    'supplier_name.min' => "The Supplier name Minimum field length 1",
                    'supplier_name.max' => "The Supplier name Maximum field length 100",
                    'supplier_phone.required' => "The Supplier phone field is required",
                    'supplier_phone.min' => "The Supplier phone Minimum field length 1",
                    'supplier_phone.max' => "The Supplier phone Maximum field length 100",




                ]
            );
        } else {
            $this->validate(
                $request,
                [
                    'supplier_phone' => 'required|min:9|max:30',
                    'address' => 'required|min:1|max:198',
                    'email' => 'max:198',
                    'supplier_name' => [
                        'required', 'min:1',
                        'max:198', Rule::unique('suppliers')->where(function ($query) {
                            return $query->where('admin_id', Auth::user()->admin_id);
                        })
                    ]
                ],
                [
                    'supplier_name.unique' => "The Supplier name field need to be unique",
                    'supplier_name.required' => "The Supplier name field is required",
                    'supplier_name.min' => "The Supplier name Minimum field length 1",
                    'supplier_name.max' => "The Supplier name Maximum field length 100",
                    'supplier_phone.required' => "The Supplier phone field is required",
                    'supplier_phone.min' => "The Supplier phone Minimum field length 1",
                    'supplier_phone.max' => "The Supplier phone Maximum field length 100",



                ]
            );
        }

        try {
            DB::beginTransaction();
            $supplier = new Supplier();
            $supplier->supplier_name = $request->supplier_name;
            $supplier->supplier_phone = $request->supplier_phone;
            $supplier->supplier_email = $request->supplier_email;
            $supplier->address = $request->address;
            $supplier->description = $request->description;
            if ($this->User->user_type == "Admin") {
                $supplier->admin_id = $this->User->id;
                $prefix = Helper::getAdmin(Auth::id())->invoice_slug;
            } else {
                $supplier->admin_id = $this->User->admin_id;
                $supplier->employee_id = $this->User->id;
                $prefix = Helper::getAdmin(Auth::user()->admin_id)->invoice_slug;
            }
            $supplier->created_user_id = $this->User->id;
            $supplier->updated_user_id = $this->User->id;
            $supplier->total_due = $request->due?:0;
            $supplier->total_paid = $request->paid?:0;
            $supplier->total_balance =  $supplier->total_due-$supplier->total_paid;
            $supplier->save();
            $paid = $request->paid;
            $due = $request->due;
            if(!is_null($paid) || !is_null($due)){
            $supplierdue = new SupplierDue();
            $supplierdue->invoice_no = IdGenerator::generate(['table' => 'supplier_dues', 'field' => 'invoice_no', 'length' => 8, 'prefix' => $prefix, 'reset_on_prefix_change' => true]);
            $supplierdue->supplier_id = $supplier->id;
            $supplierdue->payment_method = 'Cash';
            $supplierdue->paid = $paid;
            $supplierdue->due = $due;
            $supplierdue->note = 'Supplier Previous Summations';
            if ($this->User->user_type == "Admin") {
                $supplierdue->admin_id = $this->User->id;
            } else {
                $supplierdue->admin_id = $this->User->admin_id;
                $supplierdue->employee_id = $this->User->id;
            }
            $supplierdue->created_user_id = $this->User->id;
            $supplierdue->updated_user_id = $this->User->id;
            $supplierdue->save();
           }
            DB::commit();
            Toastr::success("Supplier Created Successfully", "Success");
            return redirect()->route(request()->segment(1) . '.suppliers.index');
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
            if ($User->user_type == 'Superadmin') {
                $supplier = Supplier::with('supplierdue')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $supplier = Supplier::with('supplierdue')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $supplier = Supplier::with('supplierdue')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }

            return view('backend.common.suppliers.show', compact('supplier'));
    } catch (\Exception $e) {
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
                $data = Supplier::findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $data = Supplier::whereadmin_id($User->id)->findOrFail(decrypt($id));
            } else {
                $data = Supplier::whereadmin_id($User->admin_id)->findOrFail(decrypt($id));
            }


            return view('backend.common.suppliers.edit')->with('supplier', $data);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }


    public function update(Request $request, $id)
    {
        if ($this->User->user_type == 'Admin') {
            $this->validate(
                $request,
                [
                    'supplier_phone' => 'required|min:9|max:30',
                    'address' => 'required|min:1|max:198',
                    'email' => 'max:198',
                    'status' => 'required|min:0|max:100',
                    'supplier_name' => [
                        'required', 'min:1',
                        'max:198', Rule::unique('suppliers')->ignore($id, 'id')->where(function ($query) {
                            return $query->where('admin_id', Auth::user()->id);
                        })
                    ]
                ],
                [
                    'supplier_name.unique' => "The Supplier name field need to be unique",
                    'supplier_name.required' => "The Supplier name field is required",
                    'supplier_name.min' => "The Supplier name Minimum field length 1",
                    'supplier_name.max' => "The Supplier name Maximum field length 100",
                    'supplier_phone.required' => "The Supplier phone field is required",
                    'supplier_phone.min' => "The Supplier phone Minimum field length 1",
                    'supplier_phone.max' => "The Supplier phone Maximum field length 100",



                ]
            );
        } else {
            $this->validate(
                $request,
                [
                    'supplier_phone' => 'required|min:9|max:30',
                    'address' => 'required|min:1|max:198',
                    'email' => 'email|max:198',
                    'supplier_name' => [
                        'required', 'min:1',
                        'max:198', Rule::unique('suppliers')->ignore($id, 'id')->where(function ($query) {
                            return $query->where('admin_id', Auth::user()->admin_id);
                        })
                    ]
                ],
                [
                    'supplier_name.unique' => "The Supplier name field need to be unique",
                    'supplier_name.required' => "The Supplier name field is required",
                    'supplier_name.min' => "The Supplier name Minimum field length 1",
                    'supplier_name.max' => "The Supplier name Maximum field length 100",
                    'supplier_phone.required' => "The Supplier phone field is required",
                    'supplier_phone.min' => "The Supplier phone Minimum field length 1",
                    'supplier_phone.max' => "The Supplier phone Maximum field length 100",

                ]
            );
        }

        try {
            DB::beginTransaction();
            $supplier = Supplier::find($id);
            $supplier->supplier_name = $request->supplier_name;
            $supplier->supplier_phone = $request->supplier_phone;
            $supplier->supplier_email = $request->supplier_email;
            $supplier->address = $request->address;
            $supplier->description = $request->description;
            if ($this->User->user_type == "Admin") {
                $supplier->admin_id = $this->User->id;
            } else {
                $supplier->admin_id = $this->User->admin_id;
                $supplier->employee_id = $this->User->id;
            }
            $supplier->updated_user_id = $this->User->id;
            $supplier->status = $request->status;
            $supplier->save();
            DB::commit();
            Toastr::success("Supplier Update Successfully", "Success");
            return redirect()->route(request()->segment(1) . '.suppliers.index');
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
    public function destroy(Supplier  $category)
    {
        //
    }
    public function updateStatus(Request $request)
    {
        $category = Supplier::findOrFail($request->id);
        $category->status = $request->status;
        $category->updated_user_id = Auth::id();
        if ($category->save()) {
            return 1;
        }
        return 0;
    }

    public function supplierPdf($id)
    {
        try {

            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $supplier = Supplier::with('supplierdue')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $supplier = Supplier::with('supplierdue')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $supplier = Supplier::with('supplierdue')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }
            $pdf = PDF::loadView('backend.common.suppliers.pdf', compact('supplier'));
            return $pdf->stream('supplier_' . now() . '.pdf');

    } catch (\Exception $e) {
        $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
        Toastr::error($response['message'], "Error");
        return back();
    }
    }





}
