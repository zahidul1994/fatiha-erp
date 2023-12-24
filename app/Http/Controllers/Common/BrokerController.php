<?php

namespace App\Http\Controllers\Common;
use PDF;
use App\Helpers\Helper;
use App\Models\Broker;
use Illuminate\Http\Request;
use App\Helpers\ErrorTryCatch;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class BrokerController extends Controller
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

        $this->middleware('permission:broker-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:broker-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:broker-edit', ['only' => ['edit', 'update','updateStatus']]);
        $this->middleware('permission:broker-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {

        try {
            $User = $this->User;

            if ($User->user_type == 'Superadmin') {
                $data = Broker::with('user')->latest();
            } elseif($User->user_type == 'Admin') {
                $data = Broker::with('user')->whereadmin_id($this->User->id)->latest();
            } else {
                $data = Broker::with('user')->whereadmin_id($this->User->admin_id)->latest();

            }
            if ($request->ajax()) {

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) use ($User) {
                        $btn = '';
                        $btn = '<a href=' . route(request()->segment(1) . '.brokers.show', (encrypt($data->id))) . ' class="btn btn-info btn-sm waves-effect" style="width:30px; padding: 5px"><i class="fa fa-eye"></i></a>';

                    $btn .= '<a href=' . route(request()->segment(1) . '.customerPdf', (encrypt($data->id))) . ' class="btn btn-success btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px"><i class="fas fa-file-pdf"></i></a>';
                    if ($User->can('supplier-edit')) {
                    $btn .= '<a href=' . route(request()->segment(1) . '.brokers.edit', (encrypt($data->id))) . ' class="btn btn-warning btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px"><i class="fa fa-edit"></i></a>';
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
                ['link' => route(request()->segment(1) . '.brokers.index'), 'name' => "Broker"],
                ['name' => 'List'],
            ];

            return view('backend.common.brokers.index',compact('breadcrumbs'));
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
            ['link' => route(request()->segment(1) . '.brokers.index'), 'name' => "Broker"],
            ['name' => 'Create'],
        ];
        return view('backend.common.brokers.create',compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($this->User->user_type=='Admin'){
          $adminId=Auth::id();
        }
        else{
            $adminId=Auth::user()->admin_id;

        }
        $this->validate($request,
        [

            'broker_name' => 'required|min:1|max:30',
           'address' => 'required|min:1|max:198',
        //    'discount' => 'required',
            'broker_email' => 'max:198',
           'broker_phone' => ['required','min:9',
            'max:30.', Rule::unique('brokers')->where(function ($query)use($adminId){
                    return $query->where('admin_id', $adminId);
                })
            ]
            ],
        [

            'broker_phone.unique' => "The Broker phone field need to be unique",
            'broker_phone.required' => "The Broker phone field is required",
            'broker_phone.min' => "The Broker phone Minimum field length 9",
            'broker_phone.max' => "The Broker phone Maximum field length 30",
            'broker_name.required' => "The Broker name field is required",
            'broker_email.max' => "The Broker email Maximum field length 190",

        ]);
           try {
            DB::beginTransaction();
            $broker = new Broker();
            $broker->broker_name = $request->broker_name;
            $broker->broker_phone = $request->broker_phone;
            $broker->broker_email = $request->broker_email;
            $broker->address = $request->address;
            if($this->User->user_type=="Admin"){
            $broker->admin_id = $this->User->id;
            $prefix = Helper::getAdmin(Auth::id())->invoice_slug;
           }else{
            $broker->admin_id = $this->User->admin_id;
            $broker->employee_id = $this->User->id;
            $prefix = Helper::getAdmin(Auth::user()->admin_id)->invoice_slug;
           }

          $broker->card_number = IdGenerator::generate(['table' => 'brokers', 'field' => 'card_number', 'length' =>12, 'prefix' => $prefix, 'reset_on_prefix_change' => true]);
          $broker->created_user_id = $this->User->id;
           $broker->updated_user_id = $this->User->id;
           $broker->status = $request->status;
           $broker->save();
          
            DB::commit();
            Toastr::success("Broker Created Successfully", "Success");
            return redirect()->route(request()->segment(1) . '.brokers.index');
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
                $data = Broker::with('customerdue')->whereadmin_id($User->id)->findOrFail(decrypt($id));
            } else {
                $data = Broker::with('customerdue')->findOrFail(decrypt($id));
            }
            return view('backend.common.brokers.show')->with('broker', $data);
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
                $data = Broker::findOrFail(decrypt($id));
            }
            elseif ($User->user_type == 'Admin') {
                $data = Broker::whereadmin_id($User->id)->findOrFail(decrypt($id));
            }
             else {
                $data = Broker::whereadmin_id($User->admin_id)->findOrFail(decrypt($id));
            }
            return view('backend.common.brokers.edit')->with('broker', $data);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }


    public function update(Request $request, $id)
    {
        if($this->User->user_type=='Admin'){
               $adminId=Auth::id();
              }
              else{
                  $adminId=Auth::user()->admin_id;
              }

              $this->validate($request,[
                  'broker_name' => 'required|min:1|max:30',
                 'address' => 'required|min:1|max:198',
                'broker_email' => 'max:198',
                 'broker_phone' => ['required','min:9',
                  'max:198', Rule::unique('brokers')->ignore($id, 'id')->where(function ($query)use($adminId){
                        return $query->where('admin_id',  $adminId);
                    })
                  ]
                  ],
              [

                  'broker_phone.unique' => "The Broker phone field need to be unique",
                  'broker_phone.required' => "The Broker phone field is required",
                  'broker_phone.min' => "The Broker phone Minimum field length 9",
                  'broker_phone.max' => "The Broker phone Maximum field length 30",
                  'broker_name.required' => "The Broker name field is required",
                  'broker_email.max' => "The Broker email Maximum field length 190",

              ]);

        try {
            DB::beginTransaction();
            $broker = Broker::find($id);
            $broker->broker_name = $request->broker_name;
            $broker->broker_phone = $request->broker_phone;
            $broker->broker_email = $request->broker_email;
            $broker->address = $request->address;
            // $broker->discount = $request->discount;
            $broker->birth_date = $request->birth_date;
           if($this->User->user_type=="Admin"){
            $broker->admin_id = $this->User->id;
           }else{
            $broker->admin_id = $this->User->admin_id;
            $broker->employee_id = $this->User->id;
           }
           $broker->updated_user_id = $this->User->id;
           $broker->status = $request->status;
           $broker->save();
            DB::commit();
           Toastr::success("Broker Update Successfully", "Success");
            return redirect()->route(request()->segment(1) . '.brokers.index');
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
    public function destroy(Broker  $broker)
    {
        //
    }
    public function updateStatus(Request $request)
    {
        $category = Broker::findOrFail($request->id);
        $category->status = $request->status;
        $category->updated_user_id = Auth::id();
        if ($category->save()) {
            return 1;
        }
        return 0;
    }

    public function customerPdf($id)
    {
        try {
            $User = $this->User;
            if ($User->user_type == 'Admin') {
                $broker = Broker::with('customerdue')->whereadmin_id($User->id)->findOrFail(decrypt($id));
            } else {
                $broker = Broker::with('customerdue')->findOrFail(decrypt($id));
            }
            $pdf = PDF::loadView('backend.common.brokers.pdf', compact('broker'));
            return $pdf->stream('broker_' . now() . '.pdf');

        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }



}
