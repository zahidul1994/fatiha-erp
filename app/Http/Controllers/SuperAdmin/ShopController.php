<?php

namespace App\Http\Controllers\Superadmin;
use App\Models\Shop;
use App\Models\User;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Helpers\ErrorTryCatch;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
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
             $data = Shop::with('user')->latest();
            
            if ($request->ajax()) {

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data){
                       $btn = '<a href=' . route(request()->segment(1) . '.shops.edit', (encrypt($data->id))) . ' class="btn btn-info btn-sm waves-effect" style="margin-left: 5px"><i class="fa fa-edit"></i></a>';
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
                ['link' => route(request()->segment(1) . '.shops.index'), 'name' => "Shop"],
                ['name' => 'List'],
            ];

            return view('backend.superadmin.shops.index',compact('breadcrumbs'));
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
            ['link' => route(request()->segment(1) . '.shops.index'), 'name' => "Shop"],
            ['name' => 'Create'],
        ];
        return view('backend.superadmin.shops.create',compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $adminId=$request->admin_id;
        if(Helper::branchCount($adminId)<(Helper::checkPackage(User::whereid($adminId)->first()->package)->shop)){
            $this->validate($request,
            [
              'shop_phone' => 'required|min:9|max:11',
              'shop_address' => 'required|min:9|max:198',
              'status' => 'required|min:0|max:190',
                'shop_name' => ['required','min:1',
                'max:198', Rule::unique('shops')->where(function ($query)use($adminId) {
                        return $query->where('admin_id', $adminId);
                    })
                ]               
                ],
            [
                'shop_name.unique' => "The Shop name field need to be unique",
                'shop_name.required' => "The Shop name field is required",
                'shop_name.min' => "The Shop Minimum field length 1",
                'shop_name.max' => "The Shop Maximum field length 100",
            ]);
        try {
            DB::beginTransaction();
            $shop = new Shop();
            $shop->shop_name = $request->shop_name;
            $shop->shop_phone = $request->shop_phone;
            $shop->shop_email = $request->shop_email;
            $shop->shop_address = $request->shop_address;
            $shop->admin_id = $adminId;
            $shop->created_user_id = $this->User->id;
            $shop->updated_user_id = $this->User->id;
            $shop->status = $request->status;
            $shop->save();
            DB::commit();
            Toastr::success("Shop Created Successfully", "Success");
            return redirect()->route(request()->segment(1) . '.shops.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }

        }
        else{
            Toastr::error('Please Update This Admin  package', "Error");
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
           
            
                $data = Shop::findOrFail(decrypt($id));
            
                
            return view('backend.superadmin.shops.edit')->with('shop', $data);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }


    public function update(Request $request, $id)
    { 
        $shop = Shop::find($id);
       $this->validate($request,
        [
          'shop_phone' => 'required|min:9|max:11',
          'shop_address' => 'required|min:9|max:198',
          'status' => 'required|min:0|max:190',
            'shop_name' => ['required','min:1',
            'max:198', Rule::unique('shops')->ignore($id, 'id')->where(function ($query)use($shop) {
                    return $query->where('admin_id', $shop->admin_id);
                })
            ]               
            ],
        [
            'shop_name.unique' => "The Shop name field need to be unique",
            'shop_name.required' => "The Shop name field is required",
            'shop_name.min' => "The Shop Minimum field length 1",
            'shop_name.max' => "The Shop Maximum field length 100",
        ]);
        try {
            DB::beginTransaction();
           
            $shop->shop_name = $request->shop_name;
            $shop->shop_phone = $request->shop_phone;
            $shop->shop_email = $request->shop_email;
            $shop->shop_address = $request->shop_address;
            $shop->updated_user_id = $this->User->id;
            $shop->status = $request->status;
           $shop->save();
            DB::commit();
           Toastr::success("Shop Update Successfully", "Success");
            return redirect()->route(request()->segment(1) . '.shops.index');
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
    public function destroy(Shop  $category)
    {
        //
    }
    public function updateStatus(Request $request)
    {
        $category = Shop::findOrFail($request->id);
        $category->status = $request->status;
        $category->updated_user_id = Auth::id();
        if ($category->save()) {
            return 1;
        }
        return 0;
    }
}
