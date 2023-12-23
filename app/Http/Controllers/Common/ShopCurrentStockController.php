<?php
namespace App\Http\Controllers\Common;
use PDF;
use App\Models\ShopCurrentStock;
use Illuminate\Http\Request;
use App\Helpers\ErrorTryCatch;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;


class ShopCurrentStockController extends Controller
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

        $this->middleware('permission:shop-current-stock-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:shop-current-stock-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:shop-current-stock-edit', ['only' => ['edit', 'update','updateStatus']]);
        $this->middleware('permission:shop-current-stock-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {

        try {
            $User = $this->User;

            if ($User->user_type == 'Superadmin') {
                $data = ShopCurrentStock::with('shop')->latest();
            } elseif($User->user_type == 'Admin') {
                $data = ShopCurrentStock::with('shop')->whereadmin_id($this->User->id)->latest();
            } else {
                $data = ShopCurrentStock::with('shop')->whereshop_id($this->User->shop_id)->whereadmin_id($this->User->admin_id)->latest();

            }
            if ($request->ajax()) {

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) use ($User) {
                        $btn = '<a href=' . route(request()->segment(1) . '.shop-current-stocks.show', (encrypt($data->id))) . ' class="btn btn-success btn-sm waves-effect" style="width:30px; padding: 5px"><i class="fa fa-eye"></i></a>';
                        $btn .= '<a href=' . route(request()->segment(1) . '.shop-current-stocks.edit', (encrypt($data->id))) . ' class="btn btn-info btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px"><i class="fa fa-edit"></i></a>';
                        return $btn;
                    })
                    ->addColumn('stock', function ($data) {
                        $stockAlert= $data->product->low_quantity;
                        $stock= $data->stock_qty;
                        if( $stockAlert<$stock){
                         return '<span class="badge badge-success badge-sm">' .  $stock . '</span>';
                        }else{
                         return '<span class="badge badge-danger badge-sm">' .  $stock . '</span>';
                        }
                    })

                   ->rawColumns(['stock','action'])
                    ->make(true);
            }
            $breadcrumbs = [
                ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
                ['link' => route(request()->segment(1) . '.shop-current-stocks.index'), 'name' => "Shop Current Stock"],
                ['name' => 'List'],
            ];

            return view('backend.common.shop_current_stocks.index',compact('breadcrumbs'));
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }



    public function show($id)
    {
         try {
            $User = $this->User;
             if ($User->user_type == 'Admin') {
                $data = ShopCurrentStock::with('shop')->whereadmin_id($User->id)->findOrFail(decrypt($id));
            } else {
                $data = ShopCurrentStock::with('shop')->findOrFail(decrypt($id));
            }
            return view('backend.common.shop_current_stocks.show')->with('shopCurrentStock', $data);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }


    public function edit($id)
    {

        try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $data = ShopCurrentStock::findOrFail(decrypt($id));

            }
            elseif ($User->user_type == 'Admin') {
                $data = ShopCurrentStock::whereadmin_id($User->id)->findOrFail(decrypt($id));

            }
             else {
                $data = ShopCurrentStock::whereadmin_id($User->admin_id)->findOrFail(decrypt($id));

            }

            return view('backend.common.shop_current_stocks.edit')->with('shopCurrentStock', $data);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }


    public function update(Request $request, $id){

        $this->validate($request,[
                'discount' => 'required',
                'last_sale_price' => 'required|min:1|max:999999999',

            ]);



         try {
            DB::beginTransaction();
           $shopCurrentStock =ShopCurrentStock::find($id);
            $shopCurrentStock->discount = $request->discount;
            $shopCurrentStock->last_sale_price = $request->last_sale_price;
           $shopCurrentStock->expire_date = $request->expire_date;
           $shopCurrentStock->save();
            DB::commit();
            Toastr::success("ShopCurrentStock Updated Successfully", "Success");
            return redirect()->route(request()->segment(1) . '.shop-current-stocks.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }

    }

    public function destroy(ShopCurrentStock  $category)
    {
        //
    }

}
