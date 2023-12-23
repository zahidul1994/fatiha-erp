<?php
namespace App\Http\Controllers\Superadmin;
use App\Models\User;
use App\Models\Setup;
use App\Models\Wallet;
use App\Helpers\Helper;
use Illuminate\Support\Str;
use App\Jobs\SendSmsmessage;
use Illuminate\Http\Request;
use App\Helpers\ErrorTryCatch;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\ProspectiveCustomer;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Notifications\Usernotification;


class ProspectiveCustomerController extends Controller
{

    public function index(Request $request)
    {

        try {

            $data = ProspectiveCustomer::latest();
            if ($request->ajax()) {
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) {
                        $btn = '';
                        $btn = '<a href=' . route(request()->segment(1) . '.prospective-customers.show', (encrypt($data->id))) . ' class="btn btn-success btn-sm waves-effect"  style="width:30px; padding: 5px"><i class="fa fa-eye"></i></a> <a href=' . route(request()->segment(1) . '.prospective-customers.edit', (encrypt($data->id))) . ' role="button" class="btn btn-sm bg-gradient-info"  style="width:30px; padding: 5px"><i class="fa fa-edit"></i></a>';
                        $btn .= '</span>';
                        return $btn;
                    })
                    ->addColumn('status', function ($data) {
                        if ($data->status==1) {
                            return '<button data-bs-toggle="tooltip" data-bs-placement="top" title="Customer" data-container="body" data-animation="true" class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-check" aria-hidden="true"></i></button>';
                        } elseif ($data->status==2) {
                            return '<button data-bs-toggle="tooltip" data-bs-placement="top" title="Reject" data-container="body" class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-times" aria-hidden="true"></i></button>';
                        } else {
                            return '<button data-bs-toggle="tooltip" data-bs-placement="top" title="Pending" data-container="body" class="btn btn-icon-only btn-rounded btn-outline-dark mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-undo" aria-hidden="true"></i></button>';
                        }
                    })

                    ->rawColumns(['action', 'status'])
                    ->make(true);
            }
            $breadcrumbs = [
                ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
                ['link' => route(request()->segment(1) . '.prospective-customers.index'), 'name' => "Customer"],
                ['name' => 'List'],
            ];
            return view('backend.superadmin.prospective_customers.index', compact('breadcrumbs'));
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
            ['link' => route(request()->segment(1) . '.prospective-customers.index'), 'name' => "Prospective Customer List"],
            ['name' => 'Create'],
        ];


        return view('backend.superadmin.prospective_customers.create', compact('breadcrumbs'));

    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:1|max:198',
            'email' => 'required|email|min:5|max:288|unique:prospective_customers',
            'phone' => 'required|max:60|unique:prospective_customers',

        ]);
        $customer = new ProspectiveCustomer();
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->refer_code = $request->refer_code;
        $customer->save();
        Toastr::success("Prospective Customer Created Successfully", "Success");
        return redirect()->route(request()->segment(1) . '.prospective-customers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = ProspectiveCustomer::find(decrypt($id));

        return view('backend.superadmin.prospective_customers.show', compact('customer'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $breadcrumbs = [
            ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
            ['link' => route(request()->segment(1) . '.prospective-customers.index'), 'name' => "Prospective Customer List"],
            ['name' => 'Edit'],
        ];

        $customer = ProspectiveCustomer::find(decrypt($id));
       if($customer->status==1){
        Toastr::success("Prospective Customer Already Our Client", "Success");
        return redirect()->route(request()->segment(1) . '.prospective-customers.index');
       }
        return view('backend.superadmin.prospective_customers.edit', compact('customer', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:1|max:198',
            'email' => 'required|email|min:5|max:288|unique:prospective_customers,email,'.$id,
            'phone' => 'required|max:60|unique:prospective_customers,phone,'.$id,

        ]);
        $customer = ProspectiveCustomer::find($id);
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->refer_code = $request->refer_code;
        $customer->comment = $request->comment;
        $customer->status = $request->status;
        $customer->superadmin_id = Auth::id();
        $customer->status = $request->status;
        $customer->save();
        if($customer->status==1 && $customer->refer_code!==null){
         $check=User::whererefer_id($customer->refer_code)->wherestatus(1)->first();
         if($check){
            $setting=Helper::setting();
            $cashpayment = new Wallet();
            $cashpayment->superadmin_id = Auth::id();
            $cashpayment->admin_id =$check->id;
            $cashpayment->credit =  $setting->refer_amount;
            $cashpayment->payment_id =1;
            $cashpayment->status =1;
            $cashpayment->type = 'refer';
            $cashpayment->created_user_id = Auth::id();
            $cashpayment->updated_user_id =  Auth::id();
            $cashpayment->note = 'Refer Joining Bonus';
           $cashpayment->save();
                $data = [
                    'message' => 'Your Are Earn  ' . $setting->refer_amount .' '.  $setting->currency_name . ' For Refer  ' . $customer->name.' Check Your Wallet',

                ];
                User::find($check->id)->notify(new Usernotification($data));

                

         }

        }
       Toastr::success("Prospective Customer Update Successfully", "Success");
       return redirect()->route(request()->segment(1) . '.prospective-customers.index');


    }

    public function destroy($id)
    {
        ProspectiveCustomer::find($id)->delete();
        return redirect()->route('prospective-customers.index')
            ->with('success', 'Prospective Customer deleted successfully');
    }


    public function sendSms(Request $request){

   $data = [
          'message' =>$request->smsmessage,
          'name'=>$request->name,
          'phone'=>$request->phonenumber,
        ];

        SendSmsmessage::dispatch($data);

         return response()->json(['success' => true]);

          }
          public function adminSetupUpdate($id)
          {
              $setup = Setup::whereadmin_id($id)->firstOrFail();
              return view('backend.superadmin.admins.setup', compact('setup'));
          }




}
