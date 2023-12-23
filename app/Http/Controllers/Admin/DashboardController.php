<?php

namespace App\Http\Controllers\Admin;
use App\Models\Sale;
use App\Models\Shop;
use App\Models\User;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\SaleReturn;
use Illuminate\Http\Request;
use App\Models\PurchaseReturn;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\DamageProduct;
use App\Models\Expense;
use App\Models\ShopCurrentStock;
use App\Models\StockAdjustment;
use App\Models\Supplier;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class DashboardController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
            ['name' => 'Dashboard'],
        ];
        $users = User::whereadmin_id(Auth::id())->get(['id']);
        $shops = Shop::whereadmin_id(Auth::id())->get(['id']);
        $products = Product::whereadmin_id(Auth::id())->get(['id']);
        $purchases = Purchase::whereadmin_id(Auth::id())->get(['id','date','created_at', 'grand_total']);
        $sales = Sale::whereadmin_id(Auth::id())->get(['id','date','created_at', 'grand_total']);
        $purchaseReturn = PurchaseReturn::whereadmin_id(Auth::id())->get(['id', 'grand_total']);
        $saleReturn = SaleReturn::whereadmin_id(Auth::id())->get(['id','date','created_at', 'grand_total']);
        $damageProduct = DamageProduct::whereadmin_id(Auth::id())->get(['id', 'grand_total']);
        $stockAdjust = StockAdjustment::whereadmin_id(Auth::id())->get(['id', 'total_current_stock']);
        $totalStock = ShopCurrentStock::whereadmin_id(Auth::id())->get(['id', 'stock_qty']);
        $totalSupplier = Supplier::whereadmin_id(Auth::id())->get(['id']);
        $totalCustomer = Customer::whereadmin_id(Auth::id())->get(['id']);
        $totalExpense = Expense::whereadmin_id(Auth::id())->get(['id','date','created_at', 'expense_amount']);
        $totalWallet = Wallet::whereadmin_id(Auth::id())->get(['id', 'credit', 'debit', 'status']);
        $sliders = Slider::wherestatus(1)->get();
        $previewyear = Sale::whereadmin_id(Auth::id())->orderBy('created_at')->whereYear('created_at', date("Y", strtotime("-1 year")))->get(['id', 'grand_total', 'created_at'])
            ->groupBy(function ($date) {
                return $date->created_at->month;
            })
            ->map(function ($group) {
                return $group->sum('grand_total');
            })->union(array_fill(1, 12, 0))
            ->sortKeys()
            ->toArray();
        $currentyear = Sale::whereadmin_id(Auth::id())->orderBy('created_at')->whereYear('created_at', date('Y'))->get(['id', 'grand_total', 'created_at'])
            ->groupBy(function ($date) {
                return $date->created_at->month;
            })
            ->map(function ($group) {
                return $group->sum('grand_total');
            })->union(array_fill(1, 12, 0))
            ->sortKeys()
            ->toArray();

        return view('backend.admin.dashboard', compact('breadcrumbs', 'users', 'shops', 'purchases', 'sales', 'products', 'sliders', 'previewyear', 'currentyear', 'purchaseReturn', 'saleReturn', 'damageProduct', 'damageProduct', 'stockAdjust', 'totalStock', 'totalSupplier', 'totalCustomer', 'totalExpense', 'totalWallet'));
    }

    public function loginSuperAdmin($id)
    {
        Session::flash('superAdminId');
        User::find(Auth::id())->update(array('remember_token' => null));
        Auth::logout();
        $user = User::find(decrypt($id));
        Auth::login($user);
        return back();
    }
}
