<?php

namespace App\Http\Controllers\Common;

use PDF;
use App\Models\Sale;
use App\Models\Shop;
use App\Models\Expense;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Purchase;
use App\Models\SaleReturn;
use App\Models\SaleDetails;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DamageProduct;
use App\Models\StockTransfer;
use App\Helpers\ErrorTryCatch;
use App\Models\PurchaseReturn;
use App\Models\PurchaseDetails;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DamageProductDetails;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;


class ReportController extends Controller
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

        $this->middleware('permission:product-report', ['only' => ['productReportIndex', 'productReportStore']]);
    }

    public function findReportingProduct(Request $request)
    {
        if ($request->has('q')) {

            if (Auth::user()->user_type == 'Superadmin') {
                $data = Product::wherestatus(1)->where(function ($query) use ($request) {
                    $query->where('product_full_name', 'like', '%' . $request->q . '%')->orWhere('barcode', 'like', '%' . $request->q . '%');
                })->select('id', 'product_full_name', 'barcode', 'product_name')->take(20)->get();
            } elseif (Auth::user()->user_type == 'Admin') {

                $data = Product::whereadmin_id(Auth::id())->wherestatus(1)->where(function ($query) use ($request) {
                    $query->where('product_full_name', 'like', '%' . $request->q . '%')->orWhere('barcode', 'like', '%' . $request->q . '%');
                })->select('id', 'product_full_name', 'barcode', 'product_name')->take(20)->get();
            } else {

                $data = Product::whereadmin_id(Auth::user()->admin_id)->wherestatus(1)->where(function ($query) use ($request) {
                    $query->where('product_full_name', 'like', '%' . $request->q . '%')->orWhere('barcode', 'like', '%' . $request->q . '%');
                })->select('id', 'product_full_name', 'barcode', 'product_name')->take(20)->get();
            }

            return response()->json($data);
        }
    }
    public function findReportingCustomer(Request $request)
    {
        if ($request->has('q')) {

            if (Auth::user()->user_type == 'Superadmin') {
                $data = Customer::wherestatus(1)->where(function ($query) use ($request) {
                    $query->where('customer_name', 'like', '%' . $request->quotemeta . '%')->orWhere('customer_phone', 'like', '%' . $request->q . '%');
                })->select('id', 'customer_name', 'customer_phone', 'discount')->take(20)->get();
            } elseif (Auth::user()->user_type == 'Admin') {

                $data = Customer::whereadmin_id(Auth::id())->wherestatus(1)->where(function ($query) use ($request) {
                    $query->where('customer_name', 'like', '%' . $request->q . '%')->orWhere('customer_phone', 'like', '%' . $request->q . '%');
                })->select('id', 'customer_name', 'customer_phone', 'discount')->take(20)->get();
            } else {

                $data = Customer::whereadmin_id(Auth::user()->admin_id)->wherestatus(1)->where(function ($query) use ($request) {
                    $query->where('customer_name', 'like', '%' . $request->q . '%')->orWhere('customer_phone', 'like', '%' . $request->q . '%');
                })->select('id', 'customer_name', 'customer_phone', 'discount')->take(20)->get();
            }

            return response()->json($data);
        }
    }



    public function analyticsReport()
    {
        try {
            if (Auth::user()->user_type == 'Admin') {
                $previewYear = Sale::whereadmin_id(Auth::id())->orderBy('created_at')->whereYear('created_at', date("Y", strtotime("-1 year")))->get(['id', 'grand_total', 'created_at'])
                    ->groupBy(function ($date) {
                        return $date->created_at->month;
                    })
                    ->map(function ($group) {
                        return $group->sum('grand_total');
                    })->union(array_fill(1, 12, 0))
                    ->sortKeys()
                    ->toArray();
                $currentYear = Sale::whereadmin_id(Auth::id())->orderBy('created_at')->whereYear('created_at', date('Y'))->get(['id', 'grand_total', 'created_at'])
                    ->groupBy(function ($date) {
                        return $date->created_at->month;
                    })
                    ->map(function ($group) {
                        return $group->sum('grand_total');
                    })->union(array_fill(1, 12, 0))
                    ->sortKeys()
                    ->toArray();
                $shops = Shop::withSum('shopcurrentstock', 'stock_qty')->whereadmin_id(Auth::id())->pluck('shopcurrentstock_sum_stock_qty', 'shop_name');
                $shopLabels = $shops->keys();
                $shopData = $shops->values();

                $purchasePreviewYear = Purchase::whereadmin_id(Auth::id())->orderBy('created_at')->whereYear('created_at', date("Y", strtotime("-1 year")))->get(['id', 'grand_total', 'created_at'])
                    ->groupBy(function ($date) {
                        return $date->created_at->month;
                    })
                    ->map(function ($group) {
                        return $group->sum('grand_total');
                    })->union(array_fill(1, 12, 0))
                    ->sortKeys()
                    ->toArray();
                $purchaseCurrentYear = Purchase::whereadmin_id(Auth::id())->orderBy('created_at')->whereYear('created_at', date('Y'))->get(['id', 'grand_total', 'created_at'])
                    ->groupBy(function ($date) {
                        return $date->created_at->month;
                    })
                    ->map(function ($group) {
                        return $group->sum('grand_total');
                    })->union(array_fill(1, 12, 0))
                    ->sortKeys()
                    ->toArray();
                $shopPurchase = Shop::join('purchases', 'purchases.shop_id', '=', 'shops.id')->groupBy('shop_id')->where('shops.admin_id', Auth::id())->pluck('purchases.grand_total', 'shops.shop_name');

                $shopPurchaseLabels = $shopPurchase->keys();
                $shopPurchaseData = $shopPurchase->values();

                $dailySale = Sale::whereadmin_id(Auth::id())->groupBy('date')->selectRaw('sum(grand_total) as grand_total, date')->pluck('grand_total', 'date');
                $dailySaleLabels = $dailySale->keys();
                $dailySaleData = $dailySale->values();

                $lossProfit = Sale::whereadmin_id(Auth::id())->selectRaw('sum(total_loss_profit_amount) as total_loss_profit_amount, date')->groupBy('date')->pluck('total_loss_profit_amount', 'date');
                $lossProfitData = $lossProfit->values();
            } else {
                $previewYear = Sale::whereadmin_id(Auth::user()->admin_id)->whereshop_id(Auth::user()->shop_id)->orderBy('created_at')->whereYear('created_at', date("Y", strtotime("-1 year")))->get(['id', 'grand_total', 'created_at'])
                    ->groupBy(function ($date) {
                        return $date->created_at->month;
                    })
                    ->map(function ($group) {
                        return $group->sum('grand_total');
                    })->union(array_fill(1, 12, 0))
                    ->sortKeys()
                    ->toArray();
                $currentYear = Sale::whereadmin_id(Auth::user()->admin_id)->whereshop_id(Auth::user()->shop_id)->orderBy('created_at')->whereYear('created_at', date('Y'))->get(['id', 'grand_total', 'created_at'])
                    ->groupBy(function ($date) {
                        return $date->created_at->month;
                    })
                    ->map(function ($group) {
                        return $group->sum('grand_total');
                    })->union(array_fill(1, 12, 0))
                    ->sortKeys()
                    ->toArray();
                $shops = Shop::withSum('shopcurrentstock', 'stock_qty')->whereadmin_id(Auth::user()->admin_id)->whereid(Auth::user()->shop_id)->pluck('shopcurrentstock_sum_stock_qty', 'shop_name');
                $shopLabels = $shops->keys();
                $shopData = $shops->values();

                $purchasePreviewYear = Purchase::whereadmin_id(Auth::user()->admin_id)->whereshop_id(Auth::user()->shop_id)->orderBy('created_at')->whereYear('created_at', date("Y", strtotime("-1 year")))->get(['id', 'grand_total', 'created_at'])
                    ->groupBy(function ($date) {
                        return $date->created_at->month;
                    })
                    ->map(function ($group) {
                        return $group->sum('grand_total');
                    })->union(array_fill(1, 12, 0))
                    ->sortKeys()
                    ->toArray();
                $purchaseCurrentYear = Purchase::whereadmin_id(Auth::user()->admin_id)->whereshop_id(Auth::user()->shop_id)->orderBy('created_at')->whereYear('created_at', date('Y'))->get(['id', 'grand_total', 'created_at'])
                    ->groupBy(function ($date) {
                        return $date->created_at->month;
                    })
                    ->map(function ($group) {
                        return $group->sum('grand_total');
                    })->union(array_fill(1, 12, 0))
                    ->sortKeys()
                    ->toArray();
                $shopPurchase = Shop::join('purchases', 'purchases.shop_id', '=', 'shops.id')->groupBy('shop_id')->where('shops.admin_id', Auth::user()->admin_id)->where('shops.id', Auth::user()->shop_id)->pluck('purchases.grand_total', 'shops.shop_name');

                $shopPurchaseLabels = $shopPurchase->keys();
                $shopPurchaseData = $shopPurchase->values();

                $dailySale = Sale::whereadmin_id(Auth::user()->admin_id)->whereshop_id(Auth::user()->shop_id)->groupBy('date')->selectRaw('sum(grand_total) as grand_total, date')->pluck('grand_total', 'date');
                $dailySaleLabels = $dailySale->keys();
                $dailySaleData = $dailySale->values();

                $lossProfit = Sale::whereadmin_id(Auth::user()->admin_id)->whereshop_id(Auth::user()->shop_id)->selectRaw('sum(total_loss_profit_amount) as total_loss_profit_amount, date')->groupBy('date')->pluck('total_loss_profit_amount', 'date');
                $lossProfitData = $lossProfit->values();
            }
            return view('backend.common.reports.analytics_report.index', compact('previewYear', 'currentYear', 'shops', 'shopLabels', 'shopData', 'purchasePreviewYear', 'purchaseCurrentYear', 'shopPurchaseLabels', 'shopPurchaseData', 'dailySaleLabels', 'dailySaleData', 'lossProfitData'));
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }
    public function productReportIndex()
    {
        try {
            return view('backend.common.reports.product_report.index');
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    public function productReportShow(Request $request)
    {
        try {
            $User = $this->User;
            $from = date('Y-m-d', strtotime($request->start_date));
            $to = date('Y-m-d', strtotime($request->end_date));
            $status = $request->status;
            $previewtype = $request->previewtype;

            if ($User->user_type == 'Admin') {
                $adminId = Auth::id();
            } else {
                $adminId = Auth::user()->admin_id;
            }

            if ($status == 3) {
                $products = Product::with('brand', 'shopcurrentstock')->whereadmin_id($adminId)->whereBetween('created_at', array($from . " 00:00:00", $to . " 23:59:59"))->get();
            } else {
                $products = Product::with('brand', 'shopcurrentstock')->whereadmin_id($adminId)->wherestatus($status)->whereBetween('created_at', array($from . " 00:00:00", $to . " 23:59:59"))->get();
            }

            if ($previewtype == 'htmlview') {
                return view('backend.common.reports.product_report.show', compact('products', 'from', 'to', 'status', 'previewtype'));
            } else {
                $pdf = PDF::loadView('backend.common.reports.product_report.pdf', compact('products'));
                return $pdf->stream('product-report_' . now() . '.pdf');
            }
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }
    public function activityLogReportIndex()
    {
        try {
            return view('backend.common.reports.activity_log_report.index');
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    public function activityLogReportShow(Request $request)
    {
        try {
            $User = $this->User;
            $from = date('Y-m-d', strtotime($request->start_date));
            $to = date('Y-m-d', strtotime($request->end_date));
            $adminId = $request->user_id;

            $activityLogs = Activity::wherecauser_id($adminId)->whereBetween('created_at', array($from . " 00:00:00", $to . " 23:59:59"))->latest()->get();

            return view('backend.common.reports.activity_log_report.show', compact('activityLogs', 'from', 'to', 'adminId'));
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }


    public function purchaseReportIndex()
    {
        try {
            return view('backend.common.reports.purchase_report.index');
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    public function purchaseReportShow(Request $request)
    {
        try {
            $User = $this->User;
            $from = date('Y-m-d', strtotime($request->start_date));
            $to = date('Y-m-d', strtotime($request->end_date));
            $shop_id = $request->shop_id;
            $supplier_id = $request->supplier_id;
            $previewtype = $request->previewtype;

            if ($User->user_type == 'Admin') {
                $adminId = Auth::id();
                $data = Purchase::with('user', 'shop', 'supplier')->whereadmin_id($adminId)->whereBetween('created_at', array($from . " 00:00:00", $to . " 23:59:59"));
            } else {
                $adminId = Auth::user()->admin_id;
                $data = Purchase::with('user', 'shop', 'supplier')->whereadmin_id($adminId)->whereshop_id(Auth::user()->shop_id)->whereBetween('created_at', array($from . " 00:00:00", $to . " 23:59:59"));
            }
            if ($shop_id) {
                $data->where('shop_id', $shop_id);
            }
            if ($supplier_id) {
                $data->where('supplier_id', $supplier_id);
            }
            $purchases = $data->latest()->get();

            if ($previewtype == 'htmlview') {
                return view('backend.common.reports.purchase_report.show', compact('purchases', 'from', 'to', 'shop_id', 'supplier_id', 'previewtype'));
            } else {
                $pdf = PDF::loadView('backend.common.reports.purchase_report.pdf', compact('purchases'));
                return $pdf->stream('purchase_report_' . now() . '.pdf');
            }
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    public function purchaseProductReportIndex()
    {
        try {
            return view('backend.common.reports.purchase_product_report.index');
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    public function purchaseProductReportShow(Request $request)
    {
        try {
            $User = $this->User;
            $from = date('Y-m-d', strtotime($request->start_date));
            $to = date('Y-m-d', strtotime($request->end_date));
            $product_id = $request->product_id;
            $previewtype = $request->previewtype;
            if ($User->user_type == 'Admin') {
                $adminId = Auth::id();
            } else {
                $adminId = Auth::user()->admin_id;
            }
            if ($product_id) {
                $purchaseProducts = PurchaseDetails::whereadmin_id($adminId)->where('product_id', $product_id)->whereBetween('created_at', array($from . " 00:00:00", $to . " 23:59:59"))->latest()->get();
            } else {
                $purchaseProducts = PurchaseDetails::whereadmin_id($adminId)->whereBetween('created_at', array($from . " 00:00:00", $to . " 23:59:59"))->latest()->get();
            }

            if ($previewtype == 'htmlview') {
                return view('backend.common.reports.purchase_product_report.show', compact(
                    'purchaseProducts',
                    'from',
                    'to',
                    'product_id',
                    'previewtype'
                ));
            } else {
                $pdf = PDF::loadView('backend.common.reports.purchase_product_report.pdf', compact('purchaseProducts'));
                return $pdf->stream('purchase_product_report_' . now() . '.pdf');
            }
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }



    public function saleReportIndex()
    {
        try {
            return view('backend.common.reports.sale_report.index');
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    public function saleReportShow(Request $request)
    {
        try {
            $User = $this->User;
            $from = date('Y-m-d', strtotime($request->start_date));
            $to = date('Y-m-d', strtotime($request->end_date));
            $shop_id = $request->shop_id;
            $customer_id = $request->customer_id;
            $previewtype = $request->previewtype;

            if ($User->user_type == 'Admin') {
                $adminId = Auth::id();
                $data = Sale::with('user', 'shop', 'customer')->whereadmin_id($adminId)->whereBetween('created_at', array($from . " 00:00:00", $to . " 23:59:59"));
            } else {
                $adminId = Auth::user()->admin_id;
                $data = Sale::with('user', 'shop', 'customer')->whereadmin_id($adminId)->whereshop_id(Auth::user()->shop_id)->whereBetween('created_at', array($from . " 00:00:00", $to . " 23:59:59"));
            }

            if ($shop_id) {
                $data->where('shop_id', $shop_id);
            }

            if ($customer_id) {
                $data->where('customer_id', $customer_id);
            }
            $sales = $data->latest()->get();

            if ($previewtype == 'htmlview') {
                return view('backend.common.reports.sale_report.show', compact('sales', 'from', 'to', 'shop_id', 'customer_id', 'previewtype'));
            } else {
                $pdf = PDF::loadView('backend.common.reports.sale_report.pdf', compact('sales'));
                return $pdf->stream('sale_report_' . now() . '.pdf');
            }
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    public function saleReturnReportIndex()
    {
        try {
            return view('backend.common.reports.sale_return_report.index');
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    public function saleReturnReportShow(Request $request)
    {
        try {
            $User = $this->User;
            $from = date('Y-m-d', strtotime($request->start_date));
            $to = date('Y-m-d', strtotime($request->end_date));
            $shop_id = $request->shop_id;
            $customer_id = $request->customer_id;
            $previewtype = $request->previewtype;

            if ($User->user_type == 'Admin') {
                $adminId = Auth::id();
                $data = SaleReturn::with('user', 'shop', 'customer')->whereadmin_id($adminId)->whereBetween('created_at', array($from . " 00:00:00", $to . " 23:59:59"));
            } else {
                $adminId = Auth::user()->admin_id;
                $data = SaleReturn::with('user', 'shop', 'customer')->whereadmin_id($adminId)->whereshop_id(Auth::user()->shop_id)->whereBetween('created_at', array($from . " 00:00:00", $to . " 23:59:59"));
            }

            if ($shop_id) {
                $data->where('shop_id', $shop_id);
            }

            if ($customer_id) {
                $data->where('customer_id', $customer_id);
            }
            $sales = $data->latest()->get();

            if ($previewtype == 'htmlview') {
                return view('backend.common.reports.sale_return_report.show', compact('sales', 'from', 'to', 'shop_id', 'customer_id', 'previewtype'));
            } else {
                $pdf = PDF::loadView('backend.common.reports.sale_return_report.pdf', compact('sales'));
                return $pdf->stream('sale_return_report_' . now() . '.pdf');
            }
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }
    public function saleProductReportIndex()
    {
        try {
            return view('backend.common.reports.sale_product_report.index');
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    public function saleProductReportShow(Request $request)
    {
        try {
            $User = $this->User;
            $from = date('Y-m-d', strtotime($request->start_date));
            $to = date('Y-m-d', strtotime($request->end_date));
            $product_id = $request->product_id;
            $previewtype = $request->previewtype;
            if ($User->user_type == 'Admin') {
                $adminId = Auth::id();
            } else {
                $adminId = Auth::user()->admin_id;
            }
            if ($product_id) {
                $saleProducts = SaleDetails::whereadmin_id($adminId)->where('product_id', $product_id)->whereBetween('created_at', array($from . " 00:00:00", $to . " 23:59:59"))->latest()->get();
            } else {
                $saleProducts = SaleDetails::whereadmin_id($adminId)->whereBetween('created_at', array($from . " 00:00:00", $to . " 23:59:59"))->latest()->get();
            }

            if ($previewtype == 'htmlview') {
                return view('backend.common.reports.sale_product_report.show', compact(
                    'saleProducts',
                    'from',
                    'to',
                    'product_id',
                    'previewtype'
                ));
            } else {
                $pdf = PDF::loadView('backend.common.reports.sale_product_report.pdf', compact('saleProducts'));
                return $pdf->stream('sale_product_report_' . now() . '.pdf');
            }
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    public function purchaseReturnReportIndex()
    {
        try {
            return view('backend.common.reports.purchase_return_report.index');
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    public function purchaseReturnReportShow(Request $request)
    {
        try {
            $User = $this->User;
            $from = date('Y-m-d', strtotime($request->start_date));
            $to = date('Y-m-d', strtotime($request->end_date));
            $shop_id = $request->shop_id;
            $supplier_id = $request->supplier_id;
            $previewtype = $request->previewtype;

            if ($User->user_type == 'Admin') {
                $adminId = Auth::id();
                $data = PurchaseReturn::with('user', 'shop', 'supplier')->whereadmin_id($adminId)->whereBetween('created_at', array($from . " 00:00:00", $to . " 23:59:59"));
            } else {
                $adminId = Auth::user()->admin_id;
                $data = PurchaseReturn::with('user', 'shop', 'supplier')->whereadmin_id($adminId)->whereshop_id(Auth::user()->shop_id)->whereBetween('created_at', array($from . " 00:00:00", $to . " 23:59:59"));
            }
            if ($shop_id) {
                $data->where('shop_id', $shop_id);
            }

            if ($supplier_id) {
                $data->where('supplier_id', $supplier_id);
            }
            $purchases = $data->latest()->get();

            if ($previewtype == 'htmlview') {
                return view('backend.common.reports.purchase_return_report.show', compact('purchases', 'from', 'to', 'shop_id', 'supplier_id', 'previewtype'));
            } else {
                $pdf = PDF::loadView('backend.common.reports.purchase_return_report.pdf', compact('purchases'));
                return $pdf->stream('purchase_return_report_' . now() . '.pdf');
            }
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    public function damageReportIndex()
    {
        try {
            return view('backend.common.reports.damage_report.index');
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }


    public function damageReportShow(Request $request)
    {
        try {
            $User = $this->User;
            $from = date('Y-m-d', strtotime($request->start_date));
            $to = date('Y-m-d', strtotime($request->end_date));
            $shop_id = $request->shop_id;
            $previewtype = $request->previewtype;

            if ($User->user_type == 'Admin') {
                $adminId = Auth::id();
                $data = DamageProduct::with('user', 'shop')->whereadmin_id($adminId)->whereBetween('created_at', array($from . " 00:00:00", $to . " 23:59:59"));
            } else {
                $adminId = Auth::user()->admin_id;
                $data = DamageProduct::with('user', 'shop')->whereadmin_id($adminId)->whereshop_id(Auth::user()->shop_id)->whereBetween('created_at', array($from . " 00:00:00", $to . " 23:59:59"));
            }
            if ($shop_id) {
                $data->where('shop_id', $shop_id);
            }
            $damages = $data->latest()->get();
            if ($previewtype == 'htmlview') {
                return view('backend.common.reports.damage_report.show', compact('damages', 'from', 'to', 'shop_id', 'previewtype'));
            } else {
                $pdf = PDF::loadView('backend.common.reports.damage_report.pdf', compact('damages'));
                return $pdf->stream('damage_report_' . now() . '.pdf');
            }
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }
    public function damageProductIndex()
    {
        try {
            return view('backend.common.reports.damage_product_report.index');
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    public function damageProductReportShow(Request $request)
    {
        try {
            $User = $this->User;
            $from = date('Y-m-d', strtotime($request->start_date));
            $to = date('Y-m-d', strtotime($request->end_date));
            $product_id = $request->product_id;
            $previewtype = $request->previewtype;

            if ($User->user_type == 'Admin') {
                $adminId = Auth::id();
            } else {
                $adminId = Auth::user()->admin_id;
            }

            $data = DamageProductDetails::whereadmin_id($adminId)->whereBetween('created_at', array($from . " 00:00:00", $to . " 23:59:59"));
            if ($product_id) {
                $data->where('product_id', $product_id);
            }


            $damageProducts = $data->latest()->get();

            if ($previewtype == 'htmlview') {
                return view('backend.common.reports.damage_product_report.show', compact('damageProducts', 'from', 'to', 'product_id', 'previewtype'));
            } else {
                $pdf = PDF::loadView('backend.common.reports.damage_product_report.pdf', compact('damageProducts'));
                return $pdf->stream('damage_product_report_' . now() . '.pdf');
            }
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }




    public function expenseReportIndex()
    {
        try {
            return view('backend.common.reports.expense_report.index');
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }
    public function expenseReportShow(Request $request)
    {
        try {
            $User = $this->User;
            $from = date('Y-m-d', strtotime($request->start_date));
            $to = date('Y-m-d', strtotime($request->end_date));
            $shop_id = $request->shop_id;
            $expense_head_id = $request->expense_head_id;
            $previewtype = $request->previewtype;

            if ($User->user_type == 'Admin') {
                $adminId = Auth::id();
                $data = Expense::with('user', 'shop', 'expensehead')->whereadmin_id($adminId)->whereBetween('created_at', array($from . " 00:00:00", $to . " 23:59:59"));
            } else {
                $adminId = Auth::user()->admin_id;
                $data = Expense::with('user', 'shop', 'expensehead')->whereadmin_id($adminId)->whereshop_id(Auth::user()->shop_id)->whereBetween('created_at', array($from . " 00:00:00", $to . " 23:59:59"));
            }

            if ($shop_id) {
                $data->where('shop_id', $shop_id);
            }

            if ($expense_head_id) {
                $data->where('expense_head_id', $expense_head_id);
            }
            $expenses = $data->latest()->get();

            if ($previewtype == 'htmlview') {
                return view('backend.common.reports.expense_report.show', compact('expenses', 'from', 'to', 'shop_id', 'expense_head_id', 'previewtype'));
            } else {
                $pdf = PDF::loadView('backend.common.reports.expense_report.pdf', compact('expenses'));
                return $pdf->stream('expense_report_' . now() . '.pdf');
            }
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    public function lossProfitReportIndex()
    {
        try {
            return view('backend.common.reports.loss_profit_report.index');
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }


    public function lossProfitReportShow(Request $request)
    {
        try {
            $User = $this->User;
            $from = date('Y-m-d', strtotime($request->start_date));
            $to = date('Y-m-d', strtotime($request->end_date));
            $shop_id = $request->shop_id;
            $customer_id = $request->customer_id;
            $previewtype = $request->previewtype;

            if ($User->user_type == 'Admin') {
                $adminId = Auth::id();
                $data = Sale::with('shop', 'customer')->whereadmin_id($adminId)->whereBetween('created_at', array($from . " 00:00:00", $to . " 23:59:59"));
            } else {
                $adminId = Auth::user()->admin_id;
                $data = Sale::with('shop', 'customer')->whereadmin_id($adminId)->whereshop_id(Auth::user()->shop_id)->whereBetween('created_at', array($from . " 00:00:00", $to . " 23:59:59"));
            }

            if ($shop_id) {
                $data->where('shop_id', $shop_id);
            }

            if ($customer_id) {
                $data->where('customer_id', $customer_id);
            }
            $sales = $data->latest()->get();

            if ($previewtype == 'htmlview') {
                return view('backend.common.reports.loss_profit_report.show', compact('sales', 'from', 'to', 'shop_id', 'customer_id', 'previewtype'));
            } else {
                $pdf = PDF::loadView('backend.common.reports.loss_profit_report.pdf', compact('sales'));
                return $pdf->stream('loss_profit_report_' . now() . '.pdf');
            }
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }


    public function productLossProfitReportIndex()
    {
        try {
            return view('backend.common.reports.product_loss_profit_report.index');
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    public function productLossProfitReportShow(Request $request)
    {
        try {
            $User = $this->User;
            $from = date('Y-m-d', strtotime($request->start_date));
            $to = date('Y-m-d', strtotime($request->end_date));
            $product_id = $request->product_id;
            $previewtype = $request->previewtype;
            if ($User->user_type == 'Admin') {
                $adminId = Auth::id();
            } else {
                $adminId = Auth::user()->admin_id;
            }
            if ($product_id) {
                $saleProducts = SaleDetails::whereadmin_id($adminId)->where('product_id', $product_id)->whereBetween('created_at', array($from . " 00:00:00", $to . " 23:59:59"))->latest()->get();
            } else {
                $saleProducts = SaleDetails::whereadmin_id($adminId)->whereBetween('created_at', array($from . " 00:00:00", $to . " 23:59:59"))->latest()->get();
            }

            if ($previewtype == 'htmlview') {
                return view('backend.common.reports.product_loss_profit_report.show', compact(
                    'saleProducts',
                    'from',
                    'to',
                    'product_id',
                    'previewtype'
                ));
            } else {
                $pdf = PDF::loadView('backend.common.reports.product_loss_profit_report.pdf', compact('saleProducts'));
                return $pdf->stream('product_loss_profit_report_' . now() . '.pdf');
            }
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }
}
