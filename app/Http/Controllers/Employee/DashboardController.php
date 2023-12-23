<?php

namespace App\Http\Controllers\Employee;
use App\Models\Sale;
use App\Models\Slider;
use App\Models\Expense;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\SaleReturn;
use App\Models\DamageProduct;
use App\Models\PurchaseReturn;
use App\Models\StockAdjustment;
use App\Models\ShopCurrentStock;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
            ['name' => 'Dashboard'],
        ];


        $products = Product::whereadmin_id(Auth::user()->admin_id)->get(['id']);
        $purchases = Purchase::whereemployee_id(Auth::id())->whereshop_id(Auth::user()->shop_id)->get(['id','date','created_at', 'grand_total']);
        $sales = Sale::whereemployee_id(Auth::id())->whereshop_id(Auth::user()->shop_id)->get(['id','date','created_at', 'grand_total']);
        $purchaseReturn = PurchaseReturn::whereemployee_id(Auth::id())->whereshop_id(Auth::user()->shop_id)->get(['id', 'grand_total']);
        $saleReturn = SaleReturn::whereemployee_id(Auth::id())->whereshop_id(Auth::user()->shop_id)->get(['id','date','created_at', 'grand_total']);
        $damageProduct = DamageProduct::whereemployee_id(Auth::id())->whereshop_id(Auth::user()->shop_id)->get(['id', 'grand_total']);
        $stockAdjust = StockAdjustment::whereemployee_id(Auth::id())->whereshop_id(Auth::user()->shop_id)->get(['id', 'total_current_stock']);
        $totalStock = ShopCurrentStock::whereadmin_id(Auth::id())->whereshop_id(Auth::user()->shop_id)->get(['id', 'stock_qty']);
        $totalSupplier = Supplier::whereemployee_id(Auth::id())->get(['id']);
        $totalCustomer = Customer::whereemployee_id(Auth::id())->get(['id']);
        $totalExpense = Expense::whereemployee_id(Auth::id())->whereshop_id(Auth::user()->shop_id)->get(['id','date','created_at', 'expense_amount']);
        $sliders = Slider::wherestatus(1)->get();
        $previewyear = Sale::whereemployee_id(Auth::id())->whereshop_id(Auth::user()->shop_id)->orderBy('created_at')->whereYear('created_at', date("Y", strtotime("-1 year")))->get(['id', 'grand_total', 'created_at'])
            ->groupBy(function ($date) {
                return $date->created_at->month;
            })
            ->map(function ($group) {
                return $group->sum('grand_total');
            })->union(array_fill(1, 12, 0))
            ->sortKeys()
            ->toArray();
        $currentyear = Sale::whereemployee_id(Auth::id())->whereshop_id(Auth::user()->shop_id)->orderBy('created_at')->whereYear('created_at', date('Y'))->get(['id', 'grand_total', 'created_at'])
            ->groupBy(function ($date) {
                return $date->created_at->month;
            })
            ->map(function ($group) {
                return $group->sum('grand_total');
            })->union(array_fill(1, 12, 0))
            ->sortKeys()
            ->toArray();


     return view('backend.employee.dashboard', compact('breadcrumbs', 'purchases', 'sales', 'products', 'sliders', 'previewyear', 'currentyear', 'purchaseReturn', 'saleReturn', 'damageProduct', 'damageProduct', 'stockAdjust', 'totalStock', 'totalSupplier', 'totalCustomer', 'totalExpense'));
    }


}


