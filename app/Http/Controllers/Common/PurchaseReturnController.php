<?php

namespace App\Http\Controllers\Common;
use PDF;
use App\Models\User;
use App\Helpers\Helper;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\SupplierDue;
use Illuminate\Http\Request;
use App\Helpers\ErrorTryCatch;
use App\Models\PurchaseReturn;
use App\Models\PurchaseDetails;
use App\Models\ShopCurrentStock;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Models\PurchaseReturnDetails;
use App\Notifications\Usernotification;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PurchaseReturnController extends Controller
{
    private $User;
    function __construct()
    {

        $this->middleware(function ($request, $next) {
            $this->User = Auth::user();
            if ($this->User->status == 0) {
                $request->session()->flush();
                Toastr::error('Your Account was De-active Please Contact with Support Center', "Error");
                return redirect('login');
            }
            return $next($request);
        });

        $this->middleware('permission:purchase-return-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:purchase-return-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:purchase-return-edit', ['only' => ['edit', 'update', 'updateStatus']]);
        $this->middleware('permission:purchase-return-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $data = PurchaseReturn::with('user', 'supplier')->latest();
            } elseif ($User->user_type == 'Admin') {
                $data = PurchaseReturn::with('user', 'supplier')->whereadmin_id($this->User->id)->latest();
            } else {
                $data = PurchaseReturn::with('user', 'supplier')->whereadmin_id(Auth::user()->admin_id)->whereemployee_id($User->id)->latest();
            }
            if ($request->ajax()) {
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) use ($User) {
                        $btn = '<a href=' . route(request()->segment(1) . '.purchase-returns.show', (encrypt($data->id))) . ' class="btn btn-success btn-sm waves-effect" style="width:30px; padding: 5px; margin-left:2px"><i class="fa fa-eye"></i></a>';
                        $btn .= '<a href=' . route(request()->segment(1) . '.purchaseReturnPdf', (encrypt($data->id))) . ' class="btn btn-info btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px"><i class="fas fa-file-pdf"></i></a>';
                        $btn .= '<a href=' . route(request()->segment(1) . '.purchaseReturnChalan', (encrypt($data->id))) . ' class="btn btn-primary btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px"><i class="fa fa-receipt"></i></a>';
                        // $btn .= '<a href=' . route(request()->segment(1) . '.purchase-returns.edit', (encrypt($data->id))) . ' class="btn btn-info btn-sm waves-effect" style="width:50px; padding: 8px;  margin-left:2px"><i class="fa fa-edit"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            $breadcrumbs = [
                ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
                ['link' => route(request()->segment(1) . '.purchase-returns.index'), 'name' => "PurchaseReturn"],
                ['name' => 'List'],
            ];
            return view('backend.common.purchase_returns.index', compact('breadcrumbs'));
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
            ['link' => route(request()->segment(1) . '.purchase-returns.index'), 'name' => "Purchase Return"],
            ['name' => 'Create'],
        ];
        return view('backend.common.purchase_returns.create', compact('breadcrumbs'));
    }
    public function purchaseReturnCreate($id)
    {
         try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $purchase = Purchase::with('shop', 'user', 'purchasedetails')->findOrFail($id);
            } elseif ($User->user_type == 'Admin') {
                $purchase = Purchase::with('shop', 'user', 'purchasedetails')->whereadmin_id($this->User->id)->findOrFail($id);
            } else {
                $purchase = Purchase::with('shop', 'user', 'purchasedetails')->whereadmin_id($this->User->admin_id)->findOrFail($id);
            }


        $breadcrumbs = [
            ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
            ['link' => route(request()->segment(1) . '.purchase-returns.index'), 'name' => "Purchase"],
            ['name' => 'Create'],
        ];
        return view('backend.common.purchase_returns.create', compact('breadcrumbs','purchase'));
    } catch (\Exception $e) {
        DB::rollBack();
        $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
        Toastr::error($response['message'], "Error");
        return back();
    }
    }

    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
               'purchase_id' => 'required',
               'payment_method' => 'required|min:1|max:300',
                'total_amount' => 'required|numeric|between:1,99999999',
                'product_id.*' => 'required',
                'product_total_price' => 'required',

            ]);

         try {
            DB::beginTransaction();
            $purchase=Purchase::find(decrypt($request->purchase_id));
            $purchase_returns = new PurchaseReturn();
            if (Auth::user()->user_type == 'Admin') {
                $purchase_returns->admin_id  = Auth::id();
                $prefix = Helper::getAdmin(Auth::id())->invoice_slug;
            } else {
                $purchase_returns->admin_id  = Auth::user()->admin_id;
                $purchase_returns->employee_id  = Auth::id();
                $prefix = Helper::getAdmin(Auth::user()->admin_id)->invoice_slug;
            }
            $purchase_returns->invoice_no = IdGenerator::generate(['table' => 'purchase_returns', 'field' => 'invoice_no', 'length' => 8, 'prefix' => $prefix, 'reset_on_prefix_change' => true]);
            $shop = $purchase->shop_id;
            $supplier = $purchase->supplier_id;
            $purchase_returns->shop_id = $shop;
            $purchase_returns->supplier_id = $supplier;
            $purchase_returns->date = $request->date;
            $purchase_returns->total_vat = $request->total_vat;
            $purchase_returns->total_discount = $request->total_discount ?: 0;
            $purchase_returns->sub_total = ($request->total_amount) - (($purchase_returns->total_vat)+ ($request->total_discount));
            $purchase_returns->payment_method = $request->payment_method;
            $purchase_returns->paid =  $purchase_returns->sub_total;
            $purchase_returns->grand_total = $request->total_amount;
            $purchase_returns->description = $request->description;
            $purchase_returns->created_user_id = $this->User->id;
            $purchase_returns->updated_user_id = $this->User->id;
            $purchase_returns->save();
            if ($purchase_returns) {
                $totalQuantity=0;
                $purchaseProducts = $request->product_id;
                for ($i = 0; $i < count($purchaseProducts); $i++) {
                    $productId = $request->product_id[$i];
                    $price = $request->product_price[$i];
                    $name = $request->product_name[$i];
                    $qty = $request->return_quantity[$i];
                    $total = $request->product_total_price[$i];
                    $productVat = $request->product_vat[$i];
                    $productVatAmount = $request->product_vat_amount[$i];
                    if($qty>0){
                    $totalQuantity+=$qty;
                    PurchaseDetails::wherepurchase_id($purchase->id)->whereproduct_id($productId)->increment('already_return_qty',$qty);
                    $purchaseDetail = new PurchaseReturnDetails();
                    $purchaseDetail->purchase_return_id = $purchase_returns->id;
                    $purchaseDetail->admin_id = $purchase_returns->admin_id;
                    $purchaseDetail->product_id = $productId;
                    $purchaseDetail->product_name = $name;
                    $purchaseDetail->return_qty =  $qty;
                    $purchaseDetail->purchase_price = $price;
                    $purchaseDetail->vat_percent = $productVat;
                    $purchaseDetail->vat_amount = $productVatAmount;
                    $purchaseDetail->total_price = $total;
                    $purchaseDetail->save();
                    $checkShop = ShopCurrentStock::whereproduct_id($productId)->whereshop_id($shop)->first();
                     $checkShop->stock_qty-= $qty;
                     $checkShop->save();
                    }

                  }
                }

                $supplierDue = new SupplierDue();
                $supplierDue->supplier_id =  $supplier;
                $supplierDue->purchase_return_id =   $purchase_returns->id;
                $supplierDue->payment_method =  $request->payment_method;
                $supplierDue->phone_number = $request->phone_number;
                $supplierDue->transaction_number = $request->transaction_number;
                $supplierDue->bank_name = $request->bank_name;
                $supplierDue->bank_account_number = $request->bank_account_number;
                $supplierDue->paid =$purchase_returns->paid;
                $supplierDue->due =0;
                $supplierDue->note = 'Purchase Return Invoice';
                if ($this->User->user_type == "Admin") {
                    $supplierDue->admin_id = $this->User->id;
                    $prefix = Helper::getAdmin(Auth::id())->invoice_slug;
                } else {
                    $supplierDue->admin_id = $this->User->admin_id;
                    $supplierDue->employee_id = $this->User->id;
                    $prefix = Helper::getAdmin(Auth::user()->admin_id)->invoice_slug;
                }
                $supplierDue->invoice_no = IdGenerator::generate(['table' => 'supplier_dues', 'field' => 'invoice_no', 'length' => 8, 'prefix' => $prefix, 'reset_on_prefix_change' => true]);
                $supplierDue->created_user_id = $this->User->id;
                $supplierDue->updated_user_id = $this->User->id;
                $supplierDue->save();
                if($supplierDue){
                    $supplier=Supplier::find($supplierDue->supplier_id);
                     $supplier->total_due -=  $supplierDue->paid;
                    $supplier->total_balance -=  $supplierDue->paid;
                     $supplier->save();
                }
                $purchasereturn=PurchaseReturn::find($purchase_returns->id);
                $purchasereturn->return_quantity=$totalQuantity;
                $purchasereturn->save();
            if ((Auth::user()->user_type === 'Employee')) {
                $data = [
                    'message' => 'Your Staff ' . Auth::user()->name . '  Create A Invoice ' . $purchase_returns->invoice_no,

                ];
                User::find(Auth::user()->admin_id)->notify(new Usernotification($data));
            }

            DB::commit();
            if($request->has('print')){
                return redirect()->route(request()->segment(1) . '.purchase-returns.show', (encrypt($purchasereturn->id)));
            }else{
                Toastr::success("Purchase Return Created Successfully", "Success");
                return redirect()->route(request()->segment(1) . '.purchase-returns.index');
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
     * @param  \App\Models\Category   $purchase_returns
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

          try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $purchasereturns = PurchaseReturn::with('shop', 'user','supplier', 'purchasereturndetails')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $purchasereturns = PurchaseReturn::with('shop', 'user','supplier', 'purchasereturndetails')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $purchasereturns = PurchaseReturn::with('shop', 'user','supplier', 'purchasereturndetails')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }
           $supplierPayment=SupplierDue::wherepurchase_return_id($purchasereturns->id)->first();
            $pdf = PDF::loadView('backend.common.purchase_returns.show',compact('purchasereturns','supplierPayment'));
            return $pdf->stream('purchase_returns_invoice_' . now() . '.pdf');
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }




    public function destroy(PurchaseReturn  $purchase_returns)
    {
        //
    }


    public function findPurchases(Request $request)
    {
        if ($request->has('q')) {

            if (Auth::user()->user_type == 'Superadmin') {
                $data = Purchase::where(function ($query) use ($request) {
                    $query->where('invoice_no', 'like', '%' . $request->q . '%')->orWhere('date', 'like', '%' . $request->q . '%')->orWhere('grand_total', 'like', '%' . $request->q . '%');
                })->select('id', 'invoice_no', 'date', 'grand_total')->take(20)->get();
            } elseif (Auth::user()->user_type == 'Admin') {

                $data = Purchase::whereadmin_id(Auth::id())->where(function ($query) use ($request) {
                    $query->where('invoice_no', 'like', '%' . $request->q . '%')->orWhere('date', 'like', '%' . $request->q . '%')->orWhere('grand_total', 'like', '%' . $request->q . '%');
                })->select('id', 'invoice_no', 'date', 'grand_total')->take(20)->get();
            } else {

                $data = Purchase::whereadmin_id(Auth::user()->admin_id)->whereshop_id(Auth::user()->shop_id)->where(function ($query) use ($request) {
                    $query->where('invoice_no', 'like', '%' . $request->q . '%')->orWhere('date', 'like', '%' . $request->q . '%')->orWhere('grand_total', 'like', '%' . $request->q . '%');
                })->select('id', 'invoice_no', 'date', 'grand_total')->take(20)->get();
            }

            return response()->json($data);
        }
    }

    public function purchaseReturnPdf($id)
    {

         try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $purchase = PurchaseReturn::with('shop', 'user', 'supplier', 'purchasereturndetails')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $purchase = PurchaseReturn::with('shop', 'user', 'supplier', 'purchasereturndetails')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $purchase = PurchaseReturn::with('shop', 'user', 'supplier', 'purchasereturndetails')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }

            $pdf = PDF::loadView('backend.common.purchase_returns.pdf', compact('purchase'));
            return $pdf->stream('purchase_invoice_' . now() . '.pdf');
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }
    public function purchaseReturnChalan($id)
    {

        try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $purchase = PurchaseReturn::with('shop', 'user', 'supplier', 'purchasereturndetails')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $purchase = PurchaseReturn::with('shop', 'user', 'supplier', 'purchasereturndetails')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $purchase = PurchaseReturn::with('shop', 'user', 'supplier', 'purchasereturndetails')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }

            return view('backend.common.purchase_returns.chalan', compact('purchase'));
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }
}
