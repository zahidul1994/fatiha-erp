<?php

namespace App\Http\Controllers\Common;
use PDF;
use Illuminate\Http\Request;
use App\Helpers\ErrorTryCatch;
use App\Models\DamageProduct;
use App\Models\ShopCurrentStock;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DamageProductDetails;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class DamageProductController extends Controller
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

        $this->middleware('permission:damage-product-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:damage-product-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:damage-product-edit', ['only' => ['edit', 'update', 'updateStatus']]);
        $this->middleware('permission:damage-product-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {

    try {
        $User = $this->User;

        if ($User->user_type == 'Superadmin') {
            $data = DamageProduct::with('user')->latest();
        } elseif ($User->user_type == 'Admin') {
            $data = DamageProduct::with('user','shop')->whereadmin_id($this->User->id)->latest();
        } else {
            $data = DamageProduct::with('user','shop')->whereshop_id($this->User->shop_id)->whereadmin_id($this->User->admin_id)->latest();
        }
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) use ($User) {
                    $btn = '';
                    if ($User->can('damage-product-list')) {
                        $btn = '<a href=' . route(request()->segment(1) . '.damage-products.show', (encrypt($data->id))) . ' class="btn btn-info btn-sm waves-effect" style="width:30px; padding: 5px"><i class="fa fa-eye"></i></a>';
                        $btn .= '<a href=' . route(request()->segment(1) . '.damageProductPdf', (encrypt($data->id))) . ' class="btn btn-success btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px"><i class="fas fa-file-pdf"></i></a>';

                    }
                    $btn .= '</span>';
                    return $btn;
                })


                ->rawColumns(['action'])
                ->make(true);
        }
        $breadcrumbs = [
            ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
            ['link' => route(request()->segment(1) . '.damage-products.index'), 'name' => "Damage Product"],
            ['name' => 'List'],
        ];

        return view('backend.common.damage_products.index', compact('breadcrumbs'));
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
            ['link' => route(request()->segment(1) . '.damage-products.index'), 'name' => "Damage Product"],
            ['name' => 'Create'],
        ];
        return view('backend.common.damage_products.create', compact('breadcrumbs'));
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
            $adminId = Auth::id();
            $employeeId = NULL;
        } else {
            $adminId = Auth::user()->admin_id;
            $employeeId = Auth::id();
        }
        $this->validate(
            $request,
            [

                'shop_id' => 'required',
                'product_id.*' => 'required',
                'product_quantity.*' => 'required',
                'product_price.*' => 'required|numeric|between:1,99999999',
                'product_total_price' => 'required',

            ], [

                'shop_id.required' => "The Shop name field is required",
                'product_id.required' => "The  Product name field is required",
                'product_price.required' => "The  Product Price name field is required",
                'product_price.min' => "The Product Price Minimum Length 1",
                'product_price.max' => "The Product Price  Maximum Length 99999999",
                'product_quantity.required' => "The Product  Quantity name field is required",
                'product_total_price.required' => "The Product  Quantity name field is required",
            ]
        );

          try {
            DB::beginTransaction();
            $damage = new DamageProduct();
            $damage->date = $request->date;
            $damage->shop_id =$request->shop_id;
            $damage->total_vat =  $request->total_vat;
            $damage->grand_total =  $request->total_amount;
            $damage->admin_id =  $adminId;
            $damage->employee_id =  $employeeId;
            $damage->created_user_id = $this->User->id;
            $damage->updated_user_id = $this->User->id;
            $damage->note =  $request->note;
            $damage->save();
            if($damage){
                $damageProducts = $request->product_id;
                $totalDamageStock=0;
                for ($i = 0; $i < count($damageProducts); $i++) {
                    $productId = $request->product_id[$i];
                    $price = $request->product_price[$i];
                    $name = $request->product_name[$i];
                    $qty = $request->product_quantity[$i];
                    $total = $request->product_total_price[$i];
                    $productVat = $request->product_vat[$i];
                    $expireDate = $request->product_expire_date[$i];
                    $productVatAmount = $request->product_vat_amount[$i];
                    $totalDamageStock+=$qty;
                    $damageDetail = new DamageProductDetails();
                    $damageDetail->damage_product_id = $damage->id;
                    $damageDetail->admin_id = $damage->admin_id;
                    $damageDetail->product_id = $productId;
                    $damageDetail->product_name = $name;
                    $damageDetail->qty =  $qty;
                    $damageDetail->purchase_price = $price;
                    $damageDetail->vat_percent = $productVat;
                    $damageDetail->vat_amount = $productVatAmount;
                    $damageDetail->product_expire_date = $expireDate;
                    $damageDetail->total_price = $total;
                    $damageDetail->save();
                    if($damageDetail) {
                    $checkShop = ShopCurrentStock::whereproduct_id($productId)->whereshop_id($request->shop_id)->first();
                    $checkShop->stock_qty-= $qty;
                     $checkShop->save();
                    }
                    $damageupdate =DamageProduct::find($damage->id);
                    $damageupdate->total_damage_stock=$totalDamageStock;
                    $damageupdate->save();

                  }
            }
            DB::commit();
            Toastr::success("Damage Product Created Successfully", "Success");
            return redirect()->route(request()->segment(1) . '.damage-products.index');
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
                $damageProducts = DamageProduct::with('shop', 'user','damageproductdetails')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $damageProducts = DamageProduct::with('shop', 'user','damageproductdetails')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $damageProducts = DamageProduct::with('shop', 'user','damageproductdetails')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }

            return view('backend.common.damage_products.show', compact('damageProducts'));
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
            DB::beginTransaction();
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $productDiscount = DamageProduct::findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $productDiscount = DamageProduct::whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $productDiscount = DamageProduct::whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }
            $discountProducts=ShopCurrentStock::whereIn('product_id',json_decode($productDiscount->product_ids))->get();

                foreach($discountProducts as $product){
                   $shopUpdate= ShopCurrentStock::find($product->id);
                   $shopUpdate->damage=$shopUpdate->old_discount;
                   $shopUpdate->old_discount=$shopUpdate->last_purchase_discount;
                   $shopUpdate->save();
                }

            $productDiscount->delete();
             DB::commit();
            Toastr::success("Product Discount Delete Successfully", "Success");
            return redirect()->route(request()->segment(1) . '.product-discounts.index');

        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }


    public function destroy($id)
    {
        dd($id);
    }

    public function findDamageProduct(Request $request)
    {
        if ($request->has('term')) {
            if (Auth::user()->user_type == 'Superadmin') {
                $data = ShopCurrentStock::wherestatus(1)->whereshop_id($request->shop_id)->where(function ($query) use ($request) {
                    $query->where('product_name', 'like', '%' . $request->term . '%')->orWhere('barcode', 'like', '%' . $request->term . '%');
                })->inRandomOrder()->take(20)->get();
            } elseif (Auth::user()->user_type == 'Admin') {
                $data = ShopCurrentStock::whereadmin_id(Auth::id())->wherestatus(1)->whereshop_id($request->shop_id)->where(function ($query) use ($request) {
                    $query->where('product_name', 'like', '%' . $request->term . '%')->orWhere('barcode', 'like', '%' . $request->term . '%');
                })->inRandomOrder()->take(20)->get();
            } else {

                $data = ShopCurrentStock::whereadmin_id(Auth::user()->admin_id)->wherestatus(1)->whereshop_id($request->shop_id)->where(function ($query) use ($request) {
                    $query->where('product_name', 'like', '%' . $request->term . '%')->orWhere('barcode', 'like', '%' . $request->term . '%');
                })->inRandomOrder()->take(20)->get();
            }
            $results = array();
            foreach ($data as  $v) {
                $results[] = ['id' => $v->product_id, 'value' => $v->product->product_full_name, 'price' => $v->last_purchase_price, 'stock' => $v->stock_qty, 'vat' => $v->last_purchase_vat,'date' => $v->expire_date];
            }

            return response()->json($results);
        }
    }

    public function damageProductPdf($id)
    {
         try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $damageProducts = DamageProduct::with('shop', 'user','damageproductdetails')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $damageProducts = DamageProduct::with('shop', 'user','damageproductdetails')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $damageProducts = DamageProduct::with('shop', 'user','damageproductdetails')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }

            $pdf = PDF::loadView('backend.common.damage_products.pdf', compact('damageProducts'));
            return $pdf->stream('damage_product_'. now() . '.pdf');
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }



}
