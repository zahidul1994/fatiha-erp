<?php

namespace App\Http\Controllers\Common;
use PDF;
use App\Models\User;
use App\Models\StockAdjustment;
use Illuminate\Http\Request;
use App\Helpers\ErrorTryCatch;
use App\Models\ShopCurrentStock;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\StockAdjustmentDetails;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Notifications\Usernotification;
class StockAdjustmentController extends Controller
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

        $this->middleware('permission:stock-adjustment-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:stock-adjustment-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:stock-adjustment-edit', ['only' => ['edit', 'update', 'updateStatus']]);
        $this->middleware('permission:stock-adjustment-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {

         try {
        $User = $this->User;
        if ($User->user_type == 'Superadmin') {
            $data = StockAdjustment::with('user','shop')->latest();
        } elseif ($User->user_type == 'Admin') {
            $data = StockAdjustment::with('user','shop')->whereadmin_id($this->User->id)->latest();
        } else {
            $data = StockAdjustment::with('user','shop')->whereshop_id($this->User->shop_id)->whereadmin_id(Auth::user()->admin_id)->latest();
        }
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) use ($User) {
                    $btn = '<a href=' . route(request()->segment(1) . '.stock-adjustments.show', (encrypt($data->id))) . ' class="btn btn-success btn-sm waves-effect" style="width:30px; padding: 5px"><i class="fa fa-eye"></i></a>';
                    $btn .= '<a href=' . route(request()->segment(1) . '.stockAdjustmentPdf', (encrypt($data->id))) . ' class="btn btn-info btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px"><i class="fas fa-file-pdf"></i></a>';
                    $btn .= '<a href=' . route(request()->segment(1) . '.stock-adjustments.edit', (encrypt($data->id))) . ' class="btn btn-warning btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px"><i class="fa fa-edit"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $breadcrumbs = [
            ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
            ['link' => route(request()->segment(1) . '.stock-adjustments.index'), 'name' => "StockAdjustment"],
            ['name' => 'List'],
        ];
        return view('backend.common.stock_adjustments.index', compact('breadcrumbs'));
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
            ['link' => route(request()->segment(1) . '.stock-adjustments.index'), 'name' => "Stock Adjustment"],
            ['name' => 'Create'],
        ];
        return view('backend.common.stock_adjustments.create', compact('breadcrumbs'));
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
                'shop_id' => 'required|min:1|max:198',
                'product_id.*' => 'required',
                'previous_qty.*' => 'required',
                'current_qty.*' => 'required|numeric|between:1,99999999',
            ]
        );

        try {
            DB::beginTransaction();
            $stockAdjust = new StockAdjustment();
            $shop = $request->shop_id;
            $date = date('Y-m-d');
            $stockAdjust->shop_id = $shop;
            $stockAdjust->date = $request->date ?: $date;
            $stockAdjust->description = $request->description;
            if (Auth::user()->user_type == 'Admin') {
                $stockAdjust->admin_id = Auth::id();
            } else {
                $stockAdjust->admin_id = Auth::user()->admin_id;
                $stockAdjust->employee_id = Auth::id();
            }
            $stockAdjust->created_user_id = $this->User->id;
            $stockAdjust->updated_user_id = $this->User->id;
            $stockAdjust->save();
            if ($stockAdjust) {
                $totalPreviousStock=0;
                $totalCurrentStock=0;
                $purchaseProducts = $request->product_id;
                for ($i = 0; $i < count($purchaseProducts); $i++) {
                    $productId = $request->product_id[$i];
                    $name = $request->product_name[$i];
                    $pqty = $request->previous_qty[$i];
                    $totalPreviousStock +=$pqty;
                    $cqty = $request->current_qty[$i];
                    $totalCurrentStock+=$cqty;
                    $stockAdjustDetails = new StockAdjustmentDetails();
                    $stockAdjustDetails->stock_adjustment_id = $stockAdjust->id;
                    $stockAdjustDetails->admin_id = $stockAdjust->admin_id;
                    $stockAdjustDetails->product_id = $productId;
                    $stockAdjustDetails->product_name = $name;
                    $stockAdjustDetails->previous_qty =  $pqty;
                    $stockAdjustDetails->current_qty =  $cqty;
                    $stockAdjustDetails->save();
                    $checkShop = ShopCurrentStock::whereproduct_id($productId)->whereshop_id($shop)->first();
                    $checkShop->stock_qty = $cqty;
                    $checkShop->save();
                }
                $newstockAdjust =StockAdjustment::find($stockAdjust->id);
                $newstockAdjust->total_previous_stock=$totalPreviousStock;
                $newstockAdjust->total_current_stock=$totalCurrentStock;
                $newstockAdjust->save();
                if ((Auth::user()->user_type === 'Employee')) {
                    $data = [
                        'message' => 'Your Staff ' . Auth::user()->name . '  Create A Adjustment ' . $stockAdjust->id,

                    ];
                    User::find(Auth::user()->admin_id)->notify(new Usernotification($data));
                }
            }

            DB::commit();
            if ($request->has('adjustment')) {
                Toastr::success("Stock Adjustment Created Successfully  Done. Add  Another Stock Adjustment", "Success");
                return redirect()->back();
            } else {
                Toastr::success("Stock Adjustment Created Successfully", "Success");
                return redirect()->route(request()->segment(1) . '.stock-adjustments.index');
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
     * @param  \App\Models\Category   $stockAdjust
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

         try {

                $User = $this->User;
                if ($User->user_type == 'Superadmin') {
                    $stockAdjustment = StockAdjustment::with('shop', 'stockadjustmentdetails')->findOrFail(decrypt($id));
                } elseif ($User->user_type == 'Admin') {
                    $stockAdjustment = StockAdjustment::with('shop', 'stockadjustmentdetails')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
                } else {
                    $stockAdjustment = StockAdjustment::with('shop', 'stockadjustmentdetails')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
                }

                return view('backend.common.stock_adjustments.show', compact('stockAdjustment'));
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category   $stockAdjust
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $data = StockAdjustment::with('shop', 'stockadjustmentdetails')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $data = StockAdjustment::with('shop', 'stockadjustmentdetails')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $data = StockAdjustment::with('shop', 'stockadjustmentdetails')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }

            return view('backend.common.stock_adjustments.edit')->with('stockAdjustment', $data);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }


    public function update(Request $request, $id)
    {

        $this->validate(
            $request,
            [

                'product_id.*' => 'required',
                'previous_qty.*' => 'required',
                'current_qty.*' => 'required|numeric|between:1,99999999',
            ]);

         try {
            DB::beginTransaction();
            $stockAdjust =StockAdjustment::find($id);
            $stockAdjust->date = $request->date ?:$stockAdjust->date;
            $stockAdjust->description = $request->description;
            $stockAdjust->updated_user_id = $this->User->id;
            $stockAdjust->save();
            if ($stockAdjust) {
                $totalPreviousStock=0;
                $totalCurrentStock=0;
                $purchaseProducts = $request->product_id;
                for ($i = 0; $i < count($purchaseProducts); $i++) {
                    $productId = $request->product_id[$i];
                    $name = $request->product_name[$i];
                    $pqty = $request->previous_qty[$i];
                    $totalPreviousStock +=$pqty;
                    $cqty = $request->current_qty[$i];
                    $totalCurrentStock+=$cqty;
                    $check=StockAdjustmentDetails::wherestock_adjustment_id($stockAdjust->id)->whereproduct_id($productId)->first();
                    if($check){
                     $stockAdjustDetails = StockAdjustmentDetails::find($check->id);
                    }else{
                        $stockAdjustDetails = new StockAdjustmentDetails();
                    }
                    $stockAdjustDetails->stock_adjustment_id = $stockAdjust->id;
                    $stockAdjustDetails->product_id = $productId;
                    $stockAdjustDetails->product_name = $name;
                    $stockAdjustDetails->previous_qty =  $pqty;
                    $stockAdjustDetails->current_qty =  $cqty;
                    $stockAdjustDetails->save();
                    $checkShop = ShopCurrentStock::whereproduct_id($productId)->whereshop_id($stockAdjust->shop_id)->first();
                    $checkShop->stock_qty = $cqty;
                    $checkShop->save();
                }
                $newstockAdjust =StockAdjustment::find($stockAdjust->id);
                $newstockAdjust->total_previous_stock=$totalPreviousStock;
                $newstockAdjust->total_current_stock=$totalCurrentStock;
                $newstockAdjust->save();
                if ((Auth::user()->user_type === 'Employee')) {
                    $data = [
                        'message' => 'Your Staff ' . Auth::user()->name . '  Update A Adjustment ' . $stockAdjust->id,

                    ];
                    User::find(Auth::user()->admin_id)->notify(new Usernotification($data));
                }
            }

            DB::commit();
                Toastr::success("Stock Adjustment Update Successfully", "Success");
                return redirect()->route(request()->segment(1) . '.stock-adjustments.index');

        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    public function destroy(StockAdjustment  $stockAdjust)
    {

    }


    public function stockAdjustmentPdf($id)
    {

         try {

                $User = $this->User;
                if ($User->user_type == 'Superadmin') {
                    $stockAdjustment = StockAdjustment::with('user','shop', 'stockadjustmentdetails')->findOrFail(decrypt($id));
                } elseif ($User->user_type == 'Admin') {
                    $stockAdjustment = StockAdjustment::with('user','shop', 'stockadjustmentdetails')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
                } else {
                    $stockAdjustment = StockAdjustment::with('user','shop', 'stockadjustmentdetails')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
                }

            $pdf = PDF::loadView('backend.common.stock_adjustments.pdf', compact('stockAdjustment'));
            return $pdf->stream('stock_adjustment_' . now() . '.pdf');
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }


}
