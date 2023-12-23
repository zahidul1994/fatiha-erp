<?php

namespace App\Http\Controllers\Common;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;


class BarcodeController extends Controller
{
    private $User;
    function __construct()
    {

        $this->middleware(function ($request, $next) {
            $this->User = Auth::user();
            if ($this->User->status == 0) {
                $request->session()->flush();
                Toastr::error('Your Account was Deactive Please Contact with Support Center', "Error");
                return redirect('login');
            }
            return $next($request);
        });

        $this->middleware('permission:hs_code-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:hs_code-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:hs_code-edit', ['only' => ['edit', 'update', 'updateStatus']]);
        $this->middleware('permission:hs_code-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {

        $breadcrumbs = [
            ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
            ['link' => route(request()->segment(1) . '.barcodes.index'), 'name' => "Barcode"],
            ['name' => 'Generate'],
        ];

        return view('backend.common.barcodes.index', compact('breadcrumbs'));
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
            ['link' => route(request()->segment(1) . '.barcodes.index'), 'name' => "Barcode"],
            ['name' => 'Generate'],
        ];
        return view('backend.common.barcodes.index', compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('product_sku')) {
            $productsku = $request->product_sku;
            $barcodes = $request->barcodes;
            $quantity = $request->print_qty;
            $saleprice = $request->sale_price;
            $printeprice = $request->price ?: null;
            $printDate = $request->expire_date ?: null;
            $productExpireDate = $request->product_expire_date;
            return view('backend.common.barcodes.show')->with('productsku', $productsku)
                ->with('barcodequantity', $quantity)->with('saleprice', $saleprice)->with('printeprice', $printeprice)->with('printDate', $printDate)->with('barcodes', $barcodes)->with('productExpireDate', $productExpireDate);
        } else {
            Toastr::warning("Please Select One Product ", "Success");
            return back();
        }
    }
}
