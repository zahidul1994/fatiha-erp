<?php
namespace App\Http\Controllers\Superadmin;
use App\Models\User;
use App\Models\Setup;
use App\Helpers\Helper;
use App\Models\Package;
use App\Models\Profile;
use Illuminate\Support\Str;
use App\Jobs\SendSmsmessage;
use App\Mail\AdmininfoMail;
use Illuminate\Http\Request;
use App\Helpers\ErrorTryCatch;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class AdminController extends Controller
{
    private $User;
    function __construct()
    {

        $this->middleware(function ($request, $next) {
            $this->User = Auth::user();
            return $next($request);
        });

    }
    public function index(Request $request)
    {

        try {
            $User = $this->User;
            $data = User::with('package')->whereuser_type('Admin')->latest();
            if ($request->ajax()) {
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) {
                        $btn = '';
                        $btn = '<a href=' . route(request()->segment(1) . '.admins.edit', (encrypt($data->id))) . ' role="button" class="btn btn-sm bg-gradient-info"  style="width:30px; padding: 5px"><i class="fa fa-edit"></i></a> <a role="button" class="btn btn-sm  bg-gradient-info" href='.url(request()->segment(1) . '/admin-setup-update', (@$data->id)).' style="width:30px; padding: 5px;  margin-left:2px"><i class="fa fa-gear"></i></a> <a role="button" class="btn btn-sm  bg-gradient-primary" href='.url(request()->segment(1) . '/superadmin-login-as-admin', (encrypt(@$data->id))).' style="width:30px; padding: 5px;  margin-left:2px" title="Login As This Admin"><i class="fa fa-user"></i></a></a>';
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
                    ->addColumn('image', function ($data) {
                        return '<a title="Click for View" data-lightbox="roadtrip" href="' . asset($data->image) . '"><img id="demo-test-gallery" class="border-radius-lg shadow demo-gallery" src="' . asset($data->image) . '" height="40px" width="40px"  />';

                    })


                    ->rawColumns(['image', 'action', 'status'])
                    ->make(true);
            }
            $breadcrumbs = [
                ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
                ['link' => route(request()->segment(1) . '.admins.index'), 'name' => "Admin"],
                ['name' => 'List'],
            ];
            return view('backend.superadmin.admins.index', compact('breadcrumbs'));
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
        $allroles = Role::whereadmin_id(Auth::id())->select('id', 'name', 'admin_id')->get();
        $data = array();
        for ($i = 0; $i < count($allroles); $i++) {
            $data[] = array('name' => rtrim($allroles[$i]->name, $allroles[$i]->admin_id), 'id' => $allroles[$i]->name);
        }
        $Customroles = collect($data)->pluck('name', 'id');
        $breadcrumbs = [
            ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
            ['link' => route(request()->segment(1) . '.admins.index'), 'name' => "Admin List"],
            ['name' => 'Create'],
        ];

        $package = Package::pluck('package_name', 'id');
        return view('backend.superadmin.admins.create', compact('package', 'breadcrumbs'))->with('roles', $Customroles);

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
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|min:9|max:30|unique:users,phone',
            'password' => 'required|min:6|max:40',
            'invoice_slug' => 'required|min:1|max:3',
            'roles' => 'required',
            'image' => 'required',
            'package' => 'required',
            'package_start_date' => 'required',
            'gender' => 'required',
            'company_name' => 'required',
            'company_address' => 'required',

        ]);

        $checkSlugName = User::whereinvoice_slug($request->invoice_slug)->exists();
        if ($checkSlugName) {
            return redirect()->back()
                ->withErrors([
                    'invoice_slug' => "This Invoice Slug Already Taken",
                ]);
        }

        $referId = IdGenerator::generate(['table' => 'users', 'field' => 'refer_id', 'length' => 8, 'prefix' => Str::limit($request->name, 3,''), 'reset_on_prefix_change' => true]);
        $name = $request->name;
        $password = Hash::make($request->password);

        $package = $request->package;
        $date = $request->package_start_date;
        $user = new User();
        $user->name = $name;
        $user->user_type = "Admin";
        $user->email = $request->email;
        $user->invoice_slug = $request->invoice_slug;
        $user->refer_id = $referId;
        $user->package_id = $package;
        $user->email_verified_at = now();
        $user->phone = $request->phone;
        $user->status = $request->status;
        $user->image = $request->image;
        $user->account_expire_date = Helper::packageEndDate($package, $date);
        $user->ip_address = $request->ip();
        $user->password = $password;
        $user->created_user_id = Auth::id();
        $user->updated_user_id = Auth::id();
        if ($user->save()) {
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->gender = $request->gender;
            $profile->refer_code = $request->refer_code;
            $profile->package_start_date = $date;
            $profile->package_end_date = Helper::packageEndDate($package, $date);

        }

        $setup=new Setup();
        $setup->admin_id=$user->id;
        $setup->company_name = $request->company_name;
        $setup->printing_logo=$request->company_logo;
        $setup->company_logo = $request->company_logo;
        $setup->web_address = $request->web_address;
        $setup->office_phone=$user->phone;
        $setup->office_email=$user->email;
        $setup->company_address=$request->company_address;
        $setup->description = $request->description;
        $setup->save();
        $user->assignRole($request->input('roles'));
        $profile->save();

        $smsdata = [
            'message' => ' Your Account Opening, Please Check Your Email',
            'name' => $user->name,
            'phone' => $user->phone,


        ];

        SendSmsmessage::dispatch($smsdata);

        $data = [
            'name' => $user['name'],
            'email' => $user['email'],
            'phone' => $user['phone'],
            'subject' => 'SohiBD  Pos Login Information',
            'message' => 'Hello. You Can Login just Your email address and password Your Phone Number'
        ];


        Mail::to($user)->send(new AdmininfoMail($user));
        Toastr::success("User Created Successfully", "Success");
        return redirect()->route(request()->segment(1) . '.admins.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('backend.superadmin.admins.show', compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $allroles = Role::whereadmin_id(Auth::id())->select('name', 'admin_id')->get();

        $datas = array();
        for ($i = 0; $i < count($allroles); $i++) {
            $datas[] = array('name' => rtrim($allroles[$i]->name, $allroles[$i]->admin_id), 'adminid' => $allroles[$i]->name);
        }

        $Customroles = collect($datas)->pluck('name', 'adminid');


        $admin = User::with('setup')->join('profiles', 'profiles.user_id', '=', 'users.id')->select('users.*', 'profiles.gender', 'profiles.country', 'profiles.refer_code', 'profiles.package_start_date', 'profiles.package_end_date')->findOrFail(decrypt($id));
        $userRole = $admin->roles->all();
        $data = array();
        for ($i = 0; $i < count($userRole); $i++) {
            $data[] = array('name' => rtrim($userRole[$i]->name, @Auth::user()->id), 'adminid' => $userRole[$i]->name);
        }

        $userRoles=collect($data)->pluck('adminid','adminid');


        $breadcrumbs = [
            ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
            ['link' => route(request()->segment(1) . '.admins.index'), 'name' => "Admin List"],
            ['name' => 'Edit'],
        ];
        $package = Package::pluck('package_name', 'id');
        return view('backend.superadmin.admins.edit', compact('admin', 'breadcrumbs', 'package'))->with('roles', $Customroles)->with('userRole', $userRoles);
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
            'email' => 'required|email|unique:users,email,' . $id,
            'name' => 'required|min:3|max:100',
            'phone' => 'required|min:9|max:30|unique:users,phone,' . $id,
            'roles' => 'required',
            'package' => 'required',
            'package_start_date' => 'required',
            'gender' => 'required',
            'company_name' => 'required',
            'company_address' => 'required',

        ]);
        $checkSlugName = User::whereinvoice_slug($request->invoice_slug)->whereNot('id', $id)->exists();
        if ($checkSlugName) {
            return redirect()->back()
                ->withErrors([
                    'product_name' => "This Invoice Slug Already Taken",
                ]);
        }
        $user = User::find($id);
        $package = $request->package;
        $name = $request->name;
        $date = $request->package_start_date;
        $user->name = $name;
        $user->invoice_slug = $request->invoice_slug;
        $user->package_id = $package;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->status = $request->status;
        $user->account_expire_date = Helper::packageEndDate($package, $date);
        $user->image = $request->image;
        $user->ip_address = $request->ip();
        if (!empty($request->password)) {
            $this->validate($request, [
                'password' => 'required|min:6|max:40',

            ]);
            $user->password = Hash::make($request->password);
        }

        $user->updated_user_id = Auth::id();
        if ($user->save()) {
            $setup=Setup::whereadmin_id($user->id)->firstOrFail();
       $setup->company_name = $request->company_name;
        $setup->printing_logo=$user->company_logo;
        $setup->company_logo = $request->company_logo;
        $setup->web_address = $request->web_address;
        $setup->office_phone=$user->phone;
        $setup->office_email=$user->email;
        $setup->company_address=$request->company_address;
        $setup->description = $request->description;
        $setup->save();
            $profile = Profile::whereuser_id($user->id)->firstOrFail();
            $profile->gender = $request->gender;
            $profile->package_start_date = $date;
            $profile->package_end_date = Helper::packageEndDate($package, $date);
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $user->assignRole($request->input('roles'));
             $profile->save();
             if ($user->status == 0) {

                $data = [
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'phone' => $user['phone'],
                    'subject' => 'Your Account De-Active ',
                    'message' => 'Sohibd De-Active Your Admin Account. If Any Question Please Contact Us. Thank You.'
                ];

                User::find($user->id)->update(array('remember_token' => null));
                Mail::to($user)->send(new AdmininfoMail($data));
            }
            Toastr::success("Admin Update Successfully", "Success");
            return redirect()->route(request()->segment(1) . '.admins.index');

        } else {
            Toastr::warning("Admin Update Fail", "Success");
            return redirect()->route(request()->segment(1) . '.admins.index');
        }
    }
    public function updateStatus(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->status = $request->status;
        if ($user->save()) {
            return 1;
        }
        return 0;
    }
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('admins.index')
            ->with('success', 'User deleted successfully');
    }

    public function loginAsAdmin($id)
    {

        Session::put('superAdminId',encrypt(Auth::id()));
        User::find(Auth::id())->update(array('remember_token' => null));
        Auth::logout();
        $user=User::find(decrypt($id));
        Auth::login($user);
        return back();
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



    public function setupUpdate(Request $request, $id)
    {

        $this->validate(
            $request,
            [
                'company_name' => 'required|min:1|max:290',
                'sms_status' => 'required|min:1|max:290',
                'sms_text' => 'required|min:1|max:300',
                'currency_name' => 'required|min:1|max:300',
                'currency_icon' => 'required|min:1|max:300',
                'sms_user' => 'required|min:1|max:300',
                'api_key' => 'required|min:1|max:300',
                'api_secret' => 'required|min:1|max:300',
                'print_first_note' => 'required|min:1|max:300',

            ]
        );


      try {
             DB::beginTransaction();
             $setting = Setup::whereadmin_id($id)->firstOrFail();
            $setting->sms_user = $request->sms_user;
            $setting->sms_password = $request->sms_password;
            $setting->api_key = $request->api_key;
            $setting->api_secret = $request->api_secret;
            $setting->sender_id = $request->sender_id;
            $setting->company_name = $request->company_name;
            $setting->web_address = $request->web_address;
            $setting->sms_status = $request->sms_status;
            $setting->sms_text = $request->sms_text;
            $setting->bin_number = $request->bin_number;
            $setting->vat_number = $request->vat_number;
            $setting->currency_name = $request->currency_name;
            $setting->currency_icon = $request->currency_icon;
            $setting->print_first_note = $request->print_first_note;
            $setting->print_second_note = $request->print_second_note;
            $setting->office_phone = $request->office_phone;
            $setting->office_email = $request->office_email;
            $setting->company_address = $request->company_address;
            $setting->facebook = $request->facebook;
            $setting->twitter = $request->twitter;
            $setting->youtube = $request->youtube;
            $setting->instagram = $request->instagram;
            $setting->description = $request->description;
            $setting->save();
             DB::commit();
            Toastr::success('Setup Update Successfully', 'Success');
            return redirect()->route(request()->segment(1) . '.admins.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false,500,'Internal Server Error.',null);
            Toastr::error($response['message'], 'Error');
            return back();
        }
    }

}
