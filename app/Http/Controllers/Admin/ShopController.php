<?php

namespace App\Http\Controllers\Admin;
use PDF;
use App\Models\Shop;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Helpers\ErrorTryCatch;
use Illuminate\Validation\Rule;
use App\Models\ShopCurrentStock;
use Sohibd\Laravelslug\Generate;
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
            if ($this->User->status == 0) {
                $request->session()->flush();
                Toastr::error('Your Account was De active Please Contact with Support Center', "Error");
                return redirect('login');
            }
            return $next($request);
        });


    }
    public function index(Request $request)
    {

        try {
            $User = $this->User;
             $data = Shop::with('user','shopcurrentstock')->whereadmin_id($this->User->id)->latest();

            if ($request->ajax()) {

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) use ($User) {
                        $btn = '<a href=' . route(request()->segment(1) . '.shops.show', (encrypt($data->id))) . ' class="btn btn-success btn-sm waves-effect" style="width:30px; padding: 5px"><i class="fa fa-eye"></i></a>';
                        $btn .= '<a href=' . route(request()->segment(1) . '.shopPdf', (encrypt($data->id))) . ' class="btn btn-info btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px"><i class="fas fa-file-pdf"></i></a>';
                       $btn .= '<a href=' . route(request()->segment(1) . '.shops.edit', (encrypt($data->id))) . ' class="btn btn-warning btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px"><i class="fa fa-edit"></i></a>';
                      return $btn;
                    })
                    ->addColumn('status', function ($data) {
                        if ($data->status == 0) {
                            return '<div class="form-check form-switch"><input type="checkbox" id="flexSwitchCheckDefault" onchange="updateStatus(this)" class="form-check-input"  value=' . $data->id . ' /></div>';
                        } else {
                            return '<div class="form-check form-switch"><input type="checkbox" id="flexSwitchCheckDefault" checked="" onchange="updateStatus(this)" class="form-check-input"  value=' . $data->id . ' /></div>';
                        }
                    })
                    ->addColumn('stock', function ($data) {

                            return '<span class="badge badge-success badge-sm">' . $data->shopcurrentstock->sum('stock_qty') . '</span>';


                    })
                   ->rawColumns(['action', 'status','stock'])
                    ->make(true);
            }
            $breadcrumbs = [
                ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
                ['link' => route(request()->segment(1) . '.shops.index'), 'name' => "Shop"],
                ['name' => 'List'],
            ];

            return view('backend.admin.shops.index',compact('breadcrumbs'));
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
        if(Helper::shopCount(Auth::user()->id)<(Helper::checkPackage(Auth::user()->package_id)->shop)){
        $breadcrumbs = [
            ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
            ['link' => route(request()->segment(1) . '.shops.index'), 'name' => "Shop"],
            ['name' => 'Create'],
        ];
        return view('backend.admin.shops.create',compact('breadcrumbs'));
    }
        else{
            Toastr::error('Please Update Your package', "Error");
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Helper::shopCount(Auth::user()->id)<(Helper::checkPackage(Auth::user()->package_id)->shop)){
            $this->validate($request,
            [
              'shop_phone' => 'required|min:9|max:11',
              'shop_address' => 'required|min:1|max:198',
              'status' => 'required|min:0|max:190',
                'shop_name' => ['required','min:1',
                'max:198', Rule::unique('shops')->where(function ($query) {
                        return $query->where('admin_id', Auth::id());
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
            $shop->slug = Generate::Slug($request->shop_name);
            $shop->shop_phone = $request->shop_phone;
            $shop->shop_email = $request->shop_email;
            $shop->shop_address = $request->shop_address;
            $shop->admin_id = $this->User->id;
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
            Toastr::error('Please Update Your package', "Error");
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
                $shop = Shop::with('user')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $shop =Shop::with('user')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $shop =  Shop::with('user')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }
            $shopCurrentStocks=ShopCurrentStock::whereshop_id($shop->id)->get();
   
            return view('backend.admin.shops.show', compact('shop','shopCurrentStocks'));
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
           $data = Shop::whereadmin_id(Auth::id())->findOrFail(decrypt($id));
            return view('backend.admin.shops.edit')->with('shop', $data);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,
        [
          'shop_phone' => 'required|min:9|max:11',
          'shop_address' => 'required|min:1|max:198',
          'status' => 'required|min:0|max:190',
            'shop_name' => ['required','min:1',
            'max:198', Rule::unique('shops')->ignore($id, 'id')->where(function ($query) {
                    return $query->where('admin_id', Auth::id());
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
            $shop = Shop::find($id);
            $shop->shop_name = $request->shop_name;
            $shop->slug = Generate::Slug($request->shop_name);
            $shop->shop_phone = $request->shop_phone;
            $shop->shop_email = $request->shop_email;
            $shop->shop_address = $request->shop_address;
            $shop->admin_id = $this->User->id;
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

    public function shopPdf($id)
    {
        try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $shop = Shop::with('user')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $shop =Shop::with('user')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $shop =  Shop::with('user')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }
            $shopCurrentStocks=ShopCurrentStock::whereshop_id($shop->id)->get();
            $pdf = PDF::loadView('backend.admin.shops.pdf', compact('shop','shopCurrentStocks'));
            return $pdf->stream('shop_stock_' . now() . '.pdf');
            
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }

        
    }

}
