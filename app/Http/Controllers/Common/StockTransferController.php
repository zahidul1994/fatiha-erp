<?php

namespace App\Http\Controllers\Common;

use PDF;
use App\Models\StockTransfer;
use Illuminate\Http\Request;
use App\Helpers\ErrorTryCatch;
use App\Models\ShopCurrentStock;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\StockTransferDetails;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Notifications\Usernotification;


class StockTransferController extends Controller
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

        $this->middleware('permission:stock-transfer-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:stock-transfer-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:stock-transfer-edit', ['only' => ['edit', 'update', 'updateStatus']]);
        $this->middleware('permission:stock-transfer-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {

         try {
        $User = $this->User;
        if ($User->user_type == 'Superadmin') {
            $data = StockTransfer::with('user','fromshop','toshop')->latest();
        } elseif ($User->user_type == 'Admin') {
            $data = StockTransfer::with('user','fromshop','toshop')->whereadmin_id($this->User->id)->latest();
        } else {
            $data = StockTransfer::with('user','fromshop','toshop')->whereadmin_id(Auth::user()->admin_id)->whereemployee_id($User->id)->latest();
        }
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) use ($User) {
                    $btn = '<a href=' . route(request()->segment(1) . '.stock-transfers.show', (encrypt($data->id))) . ' class="btn btn-success btn-sm waves-effect" style="width:50px; padding: 8px"><i class="fa fa-eye"></i></a>';
                    // $btn .= '<a href=' . route(request()->segment(1) . '.stock-transfers.edit', (encrypt($data->id))) . ' class="btn btn-info btn-sm waves-effect" style="width:50px; padding: 8px;  margin-left:2px"><i class="fa fa-edit"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $breadcrumbs = [
            ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
            ['link' => route(request()->segment(1) . '.stock-transfers.index'), 'name' => "Stock Transfer"],
            ['name' => 'List'],
        ];
        return view('backend.common.stock_transfers.index', compact('breadcrumbs'));
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
            ['link' => route(request()->segment(1) . '.stock-transfers.index'), 'name' => "Stock Transfer"],
            ['name' => 'Create'],
        ];
        return view('backend.common.stock_transfers.create', compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
                'from_shop_id' => 'required',
                'to_shop_id' => 'required',
                'product_id.*' => 'required',
                'current_qty.*' => 'required',
                'transfer_qty.*' => 'required|numeric|between:1,99999999',
                'current_stock_id.*' => 'required|numeric|between:1,99999999',
            ]
        );

         try {
            DB::beginTransaction();
            $stockTransfer = new StockTransfer();
            $fromShop = $request->from_shop_id;
            $toShop = $request->to_shop_id;
            $date = date('Y-m-d');
            $stockTransfer->from_shop_id = $fromShop;
            $stockTransfer->to_shop_id =  $toShop;
            $stockTransfer->date = $request->date ?: $date;
            $stockTransfer->note = $request->note;
            if (Auth::user()->user_type == 'Admin') {
                $stockTransfer->admin_id = Auth::id();
            } else {
                $stockTransfer->admin_id = Auth::user()->admin_id;
                $stockTransfer->employee_id = Auth::id();
            }
            $stockTransfer->created_user_id = $this->User->id;
            $stockTransfer->updated_user_id = $this->User->id;
            $stockTransfer->save();
            if ($stockTransfer) {
                $totalStock=0;
                $transferProducts = $request->product_id;
                for ($i = 0; $i < count($transferProducts); $i++) {
                    $productId = $request->product_id[$i];
                    $stockId = $request->current_stock_id[$i];
                    $name = $request->product_name[$i];
                    $cqty = $request->current_qty[$i];
                    $tqty = $request->transfer_qty[$i];
                    $totalStock +=$tqty;
                   $stockTransferDetail=new StockTransferDetails();
                   $stockTransferDetail->stock_transfer_id= $stockTransfer->id;
                   $stockTransferDetail->admin_id= $stockTransfer->admin_id;
                   $stockTransferDetail->product_id=$productId;
                   $stockTransferDetail->product_name=$name;
                   $stockTransferDetail->current_qty= $cqty;
                   $stockTransferDetail->transfer_qty= $tqty;
                   $stockTransferDetail->current_stock_id= $stockId;
                   $stockTransferDetail->save();
                   if($stockTransferDetail){
                    $stock=ShopCurrentStock::find($stockId);
                    $stock->decrement('stock_qty', $tqty);
                   }
                    $checkShop = ShopCurrentStock::whereproduct_id($productId)->whereshop_id($toShop)->first();
                    if ($checkShop) {
                        $checkShop->increment('stock_qty', $tqty);

                    } else {
                        $checkShop = new ShopCurrentStock();
                        if (Auth::user()->user_type == 'Admin') {
                            $checkShop->admin_id = Auth::id();
                        } else {
                            $checkShop->admin_id = Auth::user()->admin_id;
                        }
                        $checkShop->shop_id = $toShop;
                        $checkShop->product_id = $productId;
                        $checkShop->product_name = $name;
                        $checkShop->sku = $stock->sku;
                        $checkShop->barcode = $stock->barcode;
                        $checkShop->stock_qty = $tqty;
                        $checkShop->last_purchase_price = $stock->last_purchase_price;
                        $checkShop->last_sale_price = $stock->last_sale_price;
                        $checkShop->last_purchase_discount = $stock->last_purchase_discount;
                        $checkShop->discount = $stock->discount;
                        $checkShop->last_purchase_vat = $stock->last_purchase_vat;
                        $checkShop->expire_date = $stock->expire_date;
                        $checkShop->save();
                    }
                    }
                    if($stock){
                  StockTransfer::find($stockTransfer->id)->increment('total_stock', $totalStock);

                 }
            }
            DB::commit();
            if ($request->has('transfer')) {
                Toastr::success("Stock Transfer Created Successfully  Done. Add  Another Stock Transfer", "Success");
                return redirect()->back();
            } else {
                Toastr::success("Stock Transfer Created Successfully", "Success");
                return redirect()->route(request()->segment(1) . '.stock-transfers.index');
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
     * @param  \App\Models\Category   $stockTransfer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

          try {

                $User = $this->User;
                if ($User->user_type == 'Superadmin') {
                    $stockTransfer = StockTransfer::with('user','fromshop','toshop', 'stocktransferdetails')->findOrFail(decrypt($id));
                } elseif ($User->user_type == 'Admin') {
                    $stockTransfer = StockTransfer::with('user','fromshop','toshop', 'stocktransferdetails')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
                } else {
                    $stockTransfer = StockTransfer::with('user','fromshop','toshop', 'stocktransferdetails')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
                }

            $pdf = PDF::loadView('backend.common.stock_transfers.show', compact('stockTransfer'));
            return $pdf->stream('stock_transfer' . now() . '.pdf');
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }


    public function getProductForTransfer(Request $request)
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
                $results[] = ['id' => $v->product_id,'current_stock_id' => $v->id, 'value' => $v->product->product_full_name, 'price' => $v->last_sale_price, 'stock' => $v->stock_qty];
            }

            return response()->json($results);
        }
    }
}
