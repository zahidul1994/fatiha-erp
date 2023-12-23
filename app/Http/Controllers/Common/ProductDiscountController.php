<?php

namespace App\Http\Controllers\Common;
use PDF;
use Illuminate\Http\Request;
use App\Helpers\ErrorTryCatch;
use App\Models\ProductDiscount;
use App\Models\ShopCurrentStock;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class ProductDiscountController extends Controller
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

        $this->middleware('permission:product-discount-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:product-discount-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-discount-edit', ['only' => ['edit', 'update', 'updateStatus']]);
        $this->middleware('permission:product-discount-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {

    try {
        $User = $this->User;

        if ($User->user_type == 'Superadmin') {
            $data = ProductDiscount::with('user')->latest();
        } elseif ($User->user_type == 'Admin') {
            $data = ProductDiscount::with('user','shop')->whereadmin_id($this->User->id)->latest();
        } else {
            $data = ProductDiscount::with('user','shop')->whereshop_id($this->User->shop_id)->whereadmin_id($this->User->admin_id)->latest();
        }
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) use ($User) {
                    $btn = '';
                    if ($User->can('product-discount-list')) {
                        $btn = '<a href=' . route(request()->segment(1) . '.product-discounts.show', (encrypt($data->id))) . ' class="btn btn-info btn-sm waves-effect" style="width:30px; padding: 5px"><i class="fa fa-eye"></i></a>';
                        $btn .= '<a href=' . route(request()->segment(1) . '.productDiscountPdf', (encrypt($data->id))) . ' class="btn btn-success btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px"><i class="fas fa-file-pdf"></i></a>';
                        $btn .= '<a href=' . route(request()->segment(1) . '.product-discounts.edit', (encrypt($data->id))) . ' class="btn btn-danger btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px" onclick="return confirm(`Are you sure to delete discount ?`)"><i class="fa fa-trash"></i></a>';
                    }
                    $btn .= '</span>';
                    return $btn;
                })


                ->rawColumns(['action'])
                ->make(true);
        }
        $breadcrumbs = [
            ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
            ['link' => route(request()->segment(1) . '.product-discounts.index'), 'name' => "ProductDiscount"],
            ['name' => 'List'],
        ];

        return view('backend.common.product_discounts.index', compact('breadcrumbs'));
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
            ['link' => route(request()->segment(1) . '.product-discounts.index'), 'name' => "ProductDiscount"],
            ['name' => 'Create'],
        ];
        return view('backend.common.product_discounts.create', compact('breadcrumbs'));
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

                'title' => 'required|min:1|max:198',
                'shop_id' => 'required',
                'product_new_discount' => 'required',
                'product_ids.*' => 'required',

            ]
        );

         try {
            DB::beginTransaction();
            $discount = new ProductDiscount();
            $discount->title = $request->title;
            $discount->shop_id =$request->shop_id;
            $discount->product_new_discount =$request->product_new_discount;
            $discount->product_ids =json_encode($request->product_ids);
            $discount->brand_id =  $request->brand_id;
            $discount->category_id =  $request->category_id;
            $discount->admin_id =  $adminId;
            $discount->employee_id =  $employeeId;
            $discount->created_user_id = $this->User->id;
            $discount->updated_user_id = $this->User->id;
            $discount->save();
            if($discount){
                $productIds=ShopCurrentStock::whereshop_id($request->shop_id)->whereIn('product_id',$request->product_ids)->get();
                foreach($productIds as $product){
                   $shopUpdate= ShopCurrentStock::find($product->id);
                   $shopUpdate->old_discount=$shopUpdate->discount;
                   $shopUpdate->discount=$request->product_new_discount;
                   $shopUpdate->save();
                }
            }
            DB::commit();
            Toastr::success("Product Discount Created Successfully", "Success");
            return redirect()->route(request()->segment(1) . '.product-discounts.index');

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
                $productDiscount = ProductDiscount::with('shop', 'user')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $productDiscount = ProductDiscount::with('shop', 'user')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $productDiscount = ProductDiscount::with('shop', 'user')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }
            $discountProducts=ShopCurrentStock::whereshop_id($productDiscount->shop_id)->whereIn('product_id',json_decode($productDiscount->product_ids))->get();

            return view('backend.common.product_discounts.show', compact('productDiscount','discountProducts'));
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
                $productDiscount = ProductDiscount::findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $productDiscount = ProductDiscount::whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $productDiscount = ProductDiscount::whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }
            $discountProducts=ShopCurrentStock::whereshop_id($productDiscount->shop_id)->whereIn('product_id',json_decode($productDiscount->product_ids))->get();

                foreach($discountProducts as $product){
                   $shopUpdate= ShopCurrentStock::find($product->id);
                   $shopUpdate->discount=$shopUpdate->old_discount;
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

    public function getProductForDiscount(Request $request)
    {
        $brand = $request->brand;
        $shop = $request->shop;
        $category = $request->category;
        $data = ShopCurrentStock::select('shop_current_stocks.*')->join('products', 'products.id', '=', 'shop_current_stocks.product_id')->where('shop_current_stocks.shop_id', $shop);
        if ($brand) {
            $data->where('products.brand_id', $brand);
        }

        if ($category) {
            $data->where('products.category_id', $category);
        }

        $result = $data->select('products.id', 'products.barcode', 'products.product_full_name', 'products.photo', 'products.path')->get();
        return  response()->json($result);
    }

    public function productDiscountPdf($id)
    {
         try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $productDiscount = ProductDiscount::with('shop', 'user')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $productDiscount = ProductDiscount::with('shop', 'user')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $productDiscount = ProductDiscount::with('shop', 'user')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }
            $discountProducts=ShopCurrentStock::whereshop_id($productDiscount->shop_id)->whereIn('product_id',json_decode($productDiscount->product_ids))->get();
            $pdf = PDF::loadView('backend.common.product_discounts.pdf', compact('productDiscount','discountProducts'));
            return $pdf->stream('product_discount_' . now() . '.pdf');
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }





}
