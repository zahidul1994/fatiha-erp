<?php

namespace App\Http\Controllers\Common;
use App\Helpers\Helper;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\ErrorTryCatch;
use Illuminate\Validation\Rule;
use Sohibd\Laravelslug\Generate;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use App\Models\ShopCurrentStock;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
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

        $this->middleware('permission:product-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit', 'update', 'updateStatus']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {

        try {
            $User = $this->User;

            if ($User->user_type == 'Superadmin') {
                $data = Product::with('brand','shopcurrentstock')->select('product_name', 'brand_id',  'unit', 'discount', 'purchase_price', 'sale_price', 'admin_id', 'id', 'status', 'path', 'photo', 'hs_code')->latest();
            } elseif ($User->user_type == 'Admin') {
                $data = Product::with('brand', 'shopcurrentstock')->whereadmin_id($this->User->id)->select('product_name', 'brand_id', 'unit', 'discount', 'purchase_price', 'sale_price', 'admin_id', 'id', 'status', 'path', 'photo', 'hs_code')->latest();
            } else {
                $data = Product::with('brand', 'shopcurrentstock')->whereadmin_id($this->User->admin_id)->select('product_name', 'brand_id', 'unit', 'discount', 'purchase_price', 'sale_price', 'admin_id', 'id', 'status', 'path', 'photo', 'hs_code')->latest();
            }
            if ($request->ajax()) {

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) use ($User) {
                        $btn = '<a href=' . route(request()->segment(1) . '.products.show', (encrypt($data->id))) . ' class="btn btn-success btn-sm waves-effect" style="width:30px; padding: 5px"><i class="fa fa-eye"></i></a>';
                        $btn .= '<a href=' . route(request()->segment(1) . '.products.edit', (encrypt($data->id))) . ' class="btn btn-info btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px"><i class="fa fa-edit"></i></a>';
                        $btn .= '<a href=' . route(request()->segment(1) . '.productDuplicate', (encrypt($data->id))) . ' class="btn  btn-primary btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px"><i class="fa fa-clone"></i></a>';
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
                        return '<a title="Click for View" data-lightbox="roadtrip" href="' . url($data->path . '/' . $data->photo) . '"><img id="demo-test-gallery" class="border-radius-lg shadow demo-gallery" src="' . url($data->path . '/' . $data->photo) . '" height="40px" width="40px"  />';
                    })
                    ->addColumn('stock', function ($data) {
                     return $data->shopcurrentstock->sum('stock_qty');

                    })
                    ->rawColumns(['image', 'action', 'status', 'stock'])
                    ->make(true);
            }
            $breadcrumbs = [
                ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
                ['link' => route(request()->segment(1) . '.products.index'), 'name' => "Product"],
                ['name' => 'List'],
            ];
            return view('backend.common.products.index', compact('breadcrumbs'));
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }
    public function brandProducts(Request $request, $brandId)
    {

        try {

            $User = $this->User;

            if ($User->user_type == 'Superadmin') {
                $data = Product::with('brand', 'category')->where('brand_id', decrypt($brandId))->latest();
            } elseif ($User->user_type == 'Admin') {

                $data =  Product::with('brand', 'category')->whereadmin_id(Auth::id())->where('brand_id', decrypt($brandId))->latest();
            } else {

                $data =  Product::with('brand', 'category')->whereemployee_id($User->id)->where('brand_id', decrypt($brandId))->latest();
            }
            if ($request->ajax()) {

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) use ($User) {
                        $btn = '<a href=' . route(request()->segment(1) . '.products.show', (encrypt($data->id))) . ' class="btn btn-success btn-sm waves-effect" style="margin-left: 5px"><i class="fa fa-eye"></i></a>';
                        $btn .= '<a href=' . route(request()->segment(1) . '.products.edit', (encrypt($data->id))) . ' class="btn btn-info btn-sm waves-effect" style="margin-left: 5px"><i class="fa fa-edit"></i></a>';
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
                        return '<a title="Click for View" data-lightbox="roadtrip" href="' . url($data->path . '/' . $data->photo) . '"><img id="demo-test-gallery" class="border-radius-lg shadow demo-gallery" src="' . url($data->path . '/' . $data->photo) . '" height="40px" width="40px"  />';
                    })
                    ->addColumn('stock', function ($data) {
                        $stock = $data->shopcurrentstock->sum('stock_qty');
                        if ($data->low_quantity < $stock) {
                            return '<span class="badge badge-success badge-sm">' .  $stock . '</span>';
                        } else {
                            return '<span class="badge badge-danger badge-sm">' .  $stock . '</span>';
                        }
                    })
                    ->rawColumns(['image', 'action', 'status', 'stock'])
                    ->make(true);
            }
            $breadcrumbs = [
                ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
                ['link' => route(request()->segment(1) . '.products.index'), 'name' => "Product"],
                ['name' => 'Brand Product List'],
            ];
            return view('backend.common.products.brand_products', compact('breadcrumbs'));
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
            ['link' => route(request()->segment(1) . '.products.index'), 'name' => "Product"],
            ['name' => 'Create'],
        ];
        return view('backend.common.products.create', compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        if (Auth::user()->user_type == "Admin") {
            $adminId = Auth::id();
            $employeeId = NULL;
        } else {
            $adminId = Auth::user()->admin_id;
            $employeeId = Auth::id();
        }
        $productFullName = $request->product_name . ' ' . $request->weight_size . ' ' . $request->unit . ' ( ' . Helper::getBrandName($request->brand_id)->brand_name . ' )';
        $checkName = Product::whereadmin_id($adminId)->whereproduct_full_name($productFullName)->exists();
        if ($checkName) {
            return redirect()->back()
                ->withErrors([
                    'product_name' => "This product Name Already Taken, Rename Product name or size/brand/Unit ",
                ]);
        }
        if ($request->hasfile('photo')) {
            if (!is_dir(storage_path() . "/app/public/files/shares/uploads/" .  $adminId . "/thumbs/")) {
                mkdir(storage_path() .  "/app/public/files/shares/uploads/" .  $adminId . "/thumbs/", 0777, true);
            }

            $ex = $request->photo->extension();
            $rand = uniqid(Generate::Slug(Str::limit($request->product_name, 40)));
            $name = $rand . "." . $ex;
            $request->photo->move(storage_path('/app/public/files/shares/uploads/' .  $adminId), $name, 60);

            $resizedImage_thumbs = Image::make(storage_path() . '/app/public/files/shares/uploads/' .  $adminId . '/' . $name)->resize(35, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $resizedImage_thumbs->save(storage_path() . '/app/public/files/shares/uploads/' .  $adminId . '/thumbs/' . $name, 60);
            $path = 'storage/files/shares/uploads/' .  $adminId;
        } else {
            $path = Helper::defaultImagePath();
            $name = Helper::defaultImageName();
        }

        $this->validate(
            $request,
            [
               
                'weight_size' => 'required|min:1',
                'unit' => 'required|min:1|max:300',
                'brand_id' => 'required|min:1|max:190',
                'purchase_price' => 'required|min:1|max:99999999',
                'sale_price' => 'required|min:1|max:99999999',
                'vat' => 'required',
                'discount' => 'required',
                // 'photo' => 'image|mimes:jpeg,png,jpg,gif,webp|max:800',
                'hs_code' => [
                    'required', 'min:1',
                    'max:20', 'alpha_dash', Rule::unique('products')->where(function ($query) use ($adminId) {
                        return $query->where('admin_id',  $adminId);
                    })
                ]
            ],

            [
                'product_name.unique' => "The Product name must be unique",
                'product_name.required' => "The Product name field is required",
                'product_name.min' => "The Product name Minimum Length 1",
                'product_name.max' => "The Product name Maximum Length 190",
               
                'purchase_price.required' => "The  Purchase Price name field is required",
                'purchase_price.min' => "The Purchase Price Minimum Length 1",
                'purchase_price.max' => "The Purchase Price  Maximum Length 99999999",
                'sale_price.required' => "The Sale  Price name field is required",
                'sale_price.min' => "The Sale Price  Minimum Length 1",
                'sale_price.max' => "The Sale Price Maximum Length 100000",


            ]
        );
        try {
            DB::beginTransaction();
            $product = new Product();
            $product->product_name = $request->product_name;
            $product->product_full_name = $productFullName;
            $product->brand_id = $request->brand_id;
            $product->unit = $request->unit;
            $product->weight_size = $request->weight_size;
            $product->hs_code = $request->hs_code;
            $product->slug = Generate::Slug($productFullName);
            $product->rack_number = $request->rack_number;
            $product->made_in = $request->made_in;
           $product->vat = $request->vat;
            $product->discount = $request->discount;
            $product->unit_price = $request->unit_price ?: 0;
            $product->govt_price = $request->govt_price ?: 0;
            $product->insurance_before = $request->insurance_before ?: 0;
            $product->insurance_before_value = $request->insurance_before_value ?: 0;
            $product->clearing_before = $request->clearing_before ?: 0;
            $product->clearing_before_value = $request->clearing_before_value ?: 0;
            $product->convert_rate = $request->convert_rate ?: 0;
            $product->duty_assessment_value = $request->duty_assessment_value ?: 0;
            $product->cd = $request->cd ?: 0;
            $product->cd_value = $request->cd_value ?: 0;
            $product->rd = $request->rd ?: 0;
            $product->rd_value = $request->rd_value ?: 0;
            $product->cd_rd_total = $request->cd_rd_total ?: 0;
            $product->sd = $request->sd ?: 0;
            $product->sd_value = $request->sd_value ?: 0;
            $product->vat = $request->vat ?: 0;
            $product->vat_value = $request->vat_value ?: 0;
            $product->ait = $request->ait ?: 0;
            $product->ait_value = $request->ait_value ?: 0;
            $product->at = $request->at ?: 0;
            $product->at_value = $request->at_value ?: 0;
            $product->atv = $request->atv ?: 0;
            $product->atv_value = $request->atv_value ?: 0;
            $product->total_duty = $request->total_duty ?: 0;
            $product->insurance_after = $request->insurance_after ?: 0;
            $product->insurance_after_value = $request->insurance_after_value ?: 0;
            $product->bank_charge = $request->bank_charge ?: 0;
            $product->bank_charge_value = $request->bank_charge_value ?: 0;
            $product->clearing_after = $request->clearing_after ?: 0;
            $product->clearing_after_value = $request->clearing_after_value ?: 0;
            $product->carrying_charge = $request->carrying_charge ?: 0;
            $product->carrying_value = $request->carrying_value ?: 0;
            $product->lc_value = $request->lc_value ?: 0;
            $product->other_cost = $request->other_cost ?: 0;
            $product->purchase_price = $request->purchase_price;
            $product->average_price = $request->purchase_price;
            $product->sale_price = $request->sale_price;
            $product->low_quantity = $request->low_quantity ?: 0;
            $product->expire_date = $request->expire_date;
            $product->created_user_id = $this->User->id;
            $product->updated_user_id = $this->User->id;
            $product->sku = trim(Str::limit(Str::upper($request->product_name), 3, '')) . $request->weight_size . trim(Str::limit(Str::upper($request->unit), 2, ''));
            $product->admin_id = $adminId;
            $product->employee_id = $employeeId;
            $product->description = $request->description;
            $product->status = $request->status;
            $product->path = $path;
            $product->photo = $name;
            $product->save();
            DB::commit();
            if ($request->has('saveandback')) {
                Toastr::success("Product Created Successfully  Done. Add  Another Product", "Success");
                return redirect()->back();
            } else {
                Toastr::success("Product Created Successfully", "Success");
                return redirect()->route(request()->segment(1) . '.products.index');
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
     * @param  \App\Models\Category   $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $breadcrumbs = [
            ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
            ['link' => route(request()->segment(1) . '.products.index'), 'name' => "Product"],
            ['name' => 'Show'],
        ];
        try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $data = Product::with('brand')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $data = Product::with('brand')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $data = Product::with('brand')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }
            // dd($data);
            return view('backend.common.products.show', compact('breadcrumbs'))->with('product', $data);
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category   $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $data = Product::with('brand')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $data = Product::with('brand')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $data = Product::with('brand')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }
            return view('backend.common.products.edit')->with('product', $data);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }
    public function duplicateProduct($id)
    {

        try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $data = Product::with('brand', 'category')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $data = Product::with('brand', 'category')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $data = Product::with('brand', 'category')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }
            return view('backend.common.products.duplicate')->with('product', $data);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }


    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (Auth::user()->user_type == "Admin") {
            $adminId = Auth::id();
            $employeeId = NULL;
        } else {
            $adminId = Auth::user()->admin_id;
            $employeeId = Auth::id();
        }
        $productFullName = $request->product_name . ' ' . $request->weight_size . ' ' . $request->unit . ' ( ' . Helper::getBrandName($request->brand_id)->brand_name . ' )';
        $checkName = Product::whereadmin_id($adminId)->whereproduct_full_name($productFullName)->whereNot('id', $id)->exists();
        if ($checkName) {
            return redirect()->back()
                ->withErrors([
                    'product_name' => "This product Name Already Taken, Rename Product name or size/brand/Unit ",
                ]);
        }
        if ($request->hasfile('photo')) {
            if (!is_dir(storage_path() . "/app/public/files/shares/uploads/" .  $adminId . "/thumbs/")) {
                mkdir(storage_path() .  "/app/public/files/shares/uploads/" .  $adminId . "/thumbs/", 0777, true);
            }

            $ex = $request->photo->extension();
            $rand = uniqid(Generate::Slug(Str::limit($request->product_name, 40)));
            $name = $rand . "." . $ex;
            $request->photo->move(storage_path('/app/public/files/shares/uploads/' .  $adminId), $name, 60);

            $resizedImage_thumbs = Image::make(storage_path() . '/app/public/files/shares/uploads/' .  $adminId . '/' . $name)->resize(35, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $resizedImage_thumbs->save(storage_path() . '/app/public/files/shares/uploads/' .  $adminId . '/thumbs/' . $name, 60);
            $path = 'storage/files/shares/uploads/' .  $adminId;
        } else {
            $path =  $product->path;
            $name = $product->photo;
        }

        $this->validate(
            $request,
            [
                
                'weight_size' => 'required|min:1',
                'unit' => 'required|min:1|max:300',
                'brand_id' => 'required|min:1|max:190',
                'purchase_price' => 'required|min:1|max:99999999',
                'sale_price' => 'required|min:1|max:99999999',
                'vat' => 'required',
                'discount' => 'required',
                // 'photo' => 'image|mimes:jpeg,png,jpg,gif,webp|max:800',
                'hs_code' => [
                    'required', 'min:1',
                    'max:20', 'alpha_dash', Rule::unique('products')->ignore($id, 'id')->where(function ($query) use ($adminId) {
                        return $query->where('admin_id',  $adminId);
                    })
                ]
            ],

            [
                'product_name.unique' => "The Product name must be unique",
                'product_name.required' => "The Product name field is required",
                'product_name.min' => "The Product name Minimum Length 1",
                'product_name.max' => "The Product name Maximum Length 190",
                'purchase_price.required' => "The  Purchase Price name field is required",
                'purchase_price.min' => "The Purchase Price Minimum Length 1",
                'purchase_price.max' => "The Purchase Price  Maximum Length 99999999",
                'sale_price.required' => "The Sale  Price name field is required",
                'sale_price.min' => "The Sale Price  Minimum Length 1",
                'sale_price.max' => "The Sale Price Maximum Length 100000",


            ]
        );
        try {
            DB::beginTransaction();
            $product->product_name = $request->product_name;
            $product->product_full_name = $productFullName;
            $product->brand_id = $request->brand_id;
            $product->unit = $request->unit;
            $product->weight_size = $request->weight_size;
            $product->hs_code = $request->hs_code;
            $product->slug = Generate::Slug($productFullName);
            $product->rack_number = $request->rack_number;
            $product->made_in = $request->made_in;
           $product->vat = $request->vat;
            $product->discount = $request->discount;
            $product->unit_price = $request->unit_price ?: 0;
            $product->govt_price = $request->govt_price ?: 0;
            $product->insurance_before = $request->insurance_before ?: 0;
            $product->insurance_before_value = $request->insurance_before_value ?: 0;
            $product->clearing_before = $request->clearing_before ?: 0;
            $product->clearing_before_value = $request->clearing_before_value ?: 0;
            $product->convert_rate = $request->convert_rate ?: 0;
            $product->duty_assessment_value = $request->duty_assessment_value ?: 0;
            $product->cd = $request->cd ?: 0;
            $product->cd_value = $request->cd_value ?: 0;
            $product->rd = $request->rd ?: 0;
            $product->rd_value = $request->rd_value ?: 0;
            $product->cd_rd_total = $request->cd_rd_total ?: 0;
            $product->sd = $request->sd ?: 0;
            $product->sd_value = $request->sd_value ?: 0;
            $product->vat = $request->vat ?: 0;
            $product->vat_value = $request->vat_value ?: 0;
            $product->ait = $request->ait ?: 0;
            $product->ait_value = $request->ait_value ?: 0;
            $product->at = $request->at ?: 0;
            $product->at_value = $request->at_value ?: 0;
            $product->atv = $request->atv ?: 0;
            $product->atv_value = $request->atv_value ?: 0;
            $product->total_duty = $request->total_duty ?: 0;
            $product->insurance_after = $request->insurance_after ?: 0;
            $product->insurance_after_value = $request->insurance_after_value ?: 0;
            $product->bank_charge = $request->bank_charge ?: 0;
            $product->bank_charge_value = $request->bank_charge_value ?: 0;
            $product->clearing_after = $request->clearing_after ?: 0;
            $product->clearing_after_value = $request->clearing_after_value ?: 0;
            $product->carrying_charge = $request->carrying_charge ?: 0;
            $product->carrying_value = $request->carrying_value ?: 0;
            $product->lc_value = $request->lc_value ?: 0;
            $product->other_cost = $request->other_cost ?: 0;
            $product->purchase_price = $request->purchase_price;
            $product->average_price = $request->purchase_price;
            $product->sale_price = $request->sale_price;
            $product->low_quantity = $request->low_quantity ?: 0;
            $product->expire_date = $request->expire_date;
            $product->sku = trim(Str::limit(Str::upper($request->product_name), 3, '')) . $request->weight_size . trim(Str::limit(Str::upper($request->unit), 2, ''));
            $product->admin_id = $adminId;
            $product->employee_id = $employeeId;
            $product->description = $request->description;
            $product->status = $request->status;
            $product->path = $path;
            $product->photo = $name;
            $product->save();
            DB::commit();
            if ($product->save()) {
                Toastr::success("Product Update Successfully", "Success");
                return redirect()->route(request()->segment(1) . '.products.index');
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
     * @param  \App\Models\Category   $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product  $product)
    {
        //
    }
    public function updateStatus(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->status = $request->status;
        if ($product->save()) {
            return 1;
        }
        return 0;
    }
    public function checkProductName($id)
    {
        if (Auth::user()->user_type == "Admin") {
            $product = Product::whereadmin_id(Auth::id())->whereproduct_name($id)->first();
        } else {
            $product = Product::whereadmin_id(Auth::user()->admin_id)->whereproduct_name($id)->first();
        }
        if ($product) {
            return response()->json(['success' => false, 'message' => 'duplicate']);
        } else {
            return response()->json(['success' => true, 'message' => 'no duplicate']);
        }
    }
    public function checkHscode($id)
    {
        if (Auth::user()->user_type == "Admin") {
            $product = Product::whereadmin_id(Auth::id())->wherehs_code($id)->first();
        } else {
            $product = Product::whereadmin_id(Auth::user()->admin_id)->wherehs_code($id)->first();
        }
        if ($product) {
            return response()->json(['success' => false, 'message' => 'duplicate']);
        } else {
            return response()->json(['success' => true, 'message' => 'no duplicate']);
        }
    }

    //for ui item hs_code data

    public function findProduct(Request $request)
    {

        if ($request->has('term')) {
            if (Auth::user()->user_type == 'Superadmin') {
                $data = Product::wherestatus(1)->where(function ($query) use ($request) {
                    $query->where('product_full_name', 'like', '%' . $request->term . '%')->orWhere('hs_code', 'like', '%' . $request->term . '%');
                })->select('id', 'product_full_name', 'purchase_price', 'sale_price', 'hs_code', 'vat', 'sku', 'expire_date', 'average_price')->inRandomOrder()->take(20)->get();
            } elseif (Auth::user()->user_type == 'Admin') {
                $data = Product::whereadmin_id(Auth::id())->wherestatus(1)->where(function ($query) use ($request) {
                    $query->where('product_full_name', 'like', '%' . $request->term . '%')->orWhere('hs_code', 'like', '%' . $request->term . '%');
                })->select('id', 'product_full_name', 'purchase_price', 'sale_price', 'hs_code', 'vat', 'sku', 'expire_date', 'average_price')->inRandomOrder()->take(20)->get();
            } else {

                $data = Product::whereadmin_id(Auth::user()->admin_id)->wherestatus(1)->where(function ($query) use ($request) {
                    $query->where('product_full_name', 'like', '%' . $request->term . '%')->orWhere('hs_code', 'like', '%' . $request->term . '%');
                })->select('id', 'product_full_name', 'purchase_price', 'sale_price', 'hs_code', 'vat', 'sku', 'expire_date', 'average_price')->inRandomOrder()->take(20)->get();
            }
            $results = array();
            foreach ($data as  $v) {
                $results[] = ['id' => $v->id, 'value' => $v->product_full_name . ' (' . $v->hs_code . ')', 'price' => $v->purchase_price, 'saleprice' => $v->sale_price, 'averageprice' => $v->average_price, 'tax' => $v->vat, 'sku' => $v->sku, 'hs_code' => $v->hs_code, 'date' => $v->expire_date];
            }

            return response()->json($results);
        }
    }

    public function productBulkUpdate()
    {
        $breadcrumbs = [
            ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
            ['link' => route(request()->segment(1) . '.products.index'), 'name' => "Product"],
            ['name' => 'Create'],
        ];
        return view('backend.common.products.bulk_update', compact('breadcrumbs'));
    }


    public function productBulkUpdateStore(Request $request)
    {

        $this->validate(
            $request,
            [
                'product_id.*' => 'required',
                'purchase_price.*' => 'required',
                'sale_price.*' => 'required',

            ]
        );
         try {
            DB::beginTransaction();
            $Products = $request->product_id;
            for ($i = 0; $i < count($Products); $i++) {
                $product = Product::find($request->product_id[$i]);
                $product->purchase_price = $request->purchase_price[$i];
                $product->sale_price = $request->sale_price[$i];
                $product->expire_date = $request->expire_date[$i];
                if (Auth::user()->user_type == "Admin") {
                    $adminId = Auth::id();
                    $employeeId = $product->employee_id;
                } else {
                    $adminId = Auth::user()->admin_id;
                    $employeeId = Auth::id();
                }
                $product->admin_id = $adminId;
                $product->employee_id = $employeeId;
                $product->save();
            }

            if($request->has('shop_sale_price_update')){
            $productPriceUpdates = $request->shop_sale_price_update;
            for ($i = 0; $i < count($productPriceUpdates); $i++) {
                $findProduct = Product::find($request->shop_sale_price_update[$i]);
                ShopCurrentStock::where('product_id', $findProduct->id)->update([
                    'last_sale_price'=>$findProduct->sale_price
                    ]);

            }
        }
            DB::commit();
            Toastr::success("Products Update Successfully", "Success");
            return redirect()->route(request()->segment(1) . '.products.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }
}
