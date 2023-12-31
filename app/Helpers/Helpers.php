<?php

namespace App\Helpers;
use Carbon\Carbon;
use App\Models\Vat;
use App\Models\Shop;
use App\Models\User;
use App\Models\Brand;
use App\Models\Unit;
use App\Models\Setup;
use App\Models\Slider;
use App\Models\Wallet;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Package;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Setting;
use App\Models\Port;
use App\Models\Customer;
use App\Models\Discount;
use App\Models\Expense;
use App\Models\ExpenseHead;
use App\Models\Supplier;
use Illuminate\Support\Str;
use App\Models\ShopCurrentStock;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;


class Helper
{



    public static function setting()
    {
        return Cache::rememberForever('setting', function () {
            return Setting::firstOrFail();
        });
    }

    public static function adminSetting()
    {

        return Profile::where('user_id', Auth::id())->first();
    }
    public static function getAdmin($id)
    {

        return User::find($id);
    }
    public static function getShopCurrentStock($id)
    {

        return ShopCurrentStock::whereproduct_id($id)->first();
    }

    public static function getSlider()
    {

        return Slider::wherestatus(1)->inRandomOrder()->first();;
    }
    public static function shopCount($adminId)
    {
        return Shop::whereadmin_id($adminId)->count('id');
    }
    public static function employeeCount($adminId)
    {

        return User::whereadmin_id($adminId)->count('id');
    }

    public static function checkPackage($name)
    {

        return Package::find($name)->select('slug', 'price', 'employee_manage', 'package_name', 'shop')->first();
    }



    public static function getPaymentMethodName($id)
    {
        return Payment::find($id);
    }


    public static function paymentPluckValue()
    {
        return Payment::wherestatus(1)->pluck('payment_name', 'payment_name');
    }
    public static function custompaymentMethodPluckValue()
    {
        $data = [
            ['id' => 1, 'name' => 'Cash'],
            ['id' => 3, 'name' => 'Due'],
            ['id' => 2, 'name' => 'Bkash'],
            ['id' => 2, 'name' => 'Nagad'],
            ['id' => 3, 'name' => 'Rocket'],
            ['id' => 2, 'name' => 'Bank'],
            ['id' => 3, 'name' => 'Other'],
        ];

        $collection = new Collection($data);

        return $collection->pluck('name', 'name');
    }
    public static function paymentMethodPluckValue()
    {
        $data = [
            ['id' => 1, 'name' => 'Cash'],
            ['id' => 2, 'name' => 'Bkash'],
            ['id' => 3, 'name' => 'Nagad'],
            ['id' => 4, 'name' => 'Rocket'],
            ['id' => 5, 'name' => 'Bank'],
            ['id' => 6, 'name' => 'Other'],
        ];

        $collection = new Collection($data);

        return $collection->pluck('name', 'name');
    }
    public static function symbolIcon()
    {
        $data = [
            ['name' => '৳'],
            ['name' => '$'],
            ['name' => '€'],
            ['name' => '₹'],
            ['name' => 'ی'],
            
        ];

        $collection = new Collection($data);

        return $collection->pluck('name', 'name');
    }
    public static function portPluckValue()
    {
        if (Auth::user()->user_type == 'SuperAdmin') {
            return Port::wherestatus(1)->pluck('port_name', 'port_name');
        } elseif (Auth::user()->user_type == 'Admin') {
            return Port::wherestatus(1)->whereadmin_id(Auth::id())->pluck('port_name', 'port_name');
        } else {
            return Port::wherestatus(1)->whereadmin_id(Auth::user()->admin_id)->pluck('port_name', 'port_name');
        }
    }
    public static function currencyPluckValue()
    {

        if (Auth::user()->user_type == 'SuperAdmin') {
            return Currency::wherestatus(1)->select(DB::raw("CONCAT(currency_name,' - ',currency_symbol) AS name"),'id','currency_name')->pluck('name', 'currency_name'); 
        } elseif (Auth::user()->user_type == 'Admin') {
            return Currency::wherestatus(1)->select(DB::raw("CONCAT(currency_name,' - ',currency_symbol) AS name"),'id','currency_name')->pluck('name', 'currency_name');
        } else {
            return Currency::wherestatus(1)->select(DB::raw("CONCAT(currency_name,' - ',currency_symbol) AS name"),'id','currency_name')->pluck('name', 'currency_name');
        }
    }

    public static function adminPluckValue()
    {
        return User::whereuser_type('Admin')->pluck('name', 'id');
    }

    public static function discoutPluckValue()
    {
        return Cache::rememberForever('discountpluck', function () {
            return Discount::pluck('discount', 'discount');
        });
    }
    public static function vatPluckValue()
    {
        return Cache::rememberForever('vatpluck', function () {
            return Vat::pluck('vat', 'vat');
        });
    }
    
    public static function expenseHeadPluckValue()
    {
        return Cache::rememberForever('expenseHeadpluck', function () {
            return ExpenseHead::pluck('expense_name', 'id');
        });
    }
    public static function countryPluckValue()
    {
        return Cache::rememberForever('countrypluck', function () {
            return Country::pluck('country_name', 'country_name');
        });
    }
    public static function Permissions()
    {
        return  Permission::get();
    }
    public static function packageEndDate($package, $date)
    {
        $dayes = Package::find($package)->duration;
        return Carbon::create($date)->addDays($dayes)->format("Y-m-d");
    }
    public static function getadminBlance($id)
    {

        return Wallet::whereadmin_id($id)->get();
    }
    public static function getadminPaymentReceiver()
    {

        return User::whereuser_type('Superadmin')->pluck('name', 'id');
    }
    public static function unitPluckValue()
    {
        return Unit::wherestatus(1)->pluck('unit_name', 'unit_name');
    }
    public static function brandPluckValue()
    {
        if (Auth::user()->user_type == 'SuperAdmin') {
            return Brand::wherestatus(1)->pluck('brand_name', 'id');
        } elseif (Auth::user()->user_type == 'Admin') {
            return Brand::wherestatus(1)->whereadmin_id(Auth::id())->pluck('brand_name', 'id');
        } else {
            return Brand::wherestatus(1)->whereadmin_id(Auth::user()->admin_id)->pluck('brand_name', 'id');
        }
    }
    public static function ProductPluckValue()
    {
        if (Auth::user()->user_type == 'SuperAdmin') {
            return Product::wherestatus(1)->pluck('product_full_name', 'id');
        } elseif (Auth::user()->user_type == 'Admin') {
            return Product::wherestatus(1)->whereadmin_id(Auth::id())->pluck('product_full_name', 'id');
        } else {
            return Product::wherestatus(1)->whereadmin_id(Auth::user()->admin_id)->pluck('product_full_name', 'id');
        }
    }
    public static function getProductName($id)
    {

        return Product::find($id)->product_full_name;
    }
    public static function getBrandName($id)
    {

        return Brand::find($id);
    }
    public static function adminSetup()
    {
        if (Auth::user()->user_type == 'SuperAdmin') {
            return Setup::with('supplier', 'customer')->first();
        } elseif (Auth::user()->user_type == 'Admin') {
            return Setup::with('supplier', 'customer')->whereadmin_id(Auth::id())->first();
        } else {
            return Setup::with('supplier', 'customer')->whereadmin_id(Auth::user()->admin_id)->first();
        }
    }public static function companySetup()
    {
        if (Auth::user()->user_type == 'Admin') {
            return Setup::whereadmin_id(Auth::id())->first();
        } else {
            return Setup::whereadmin_id(Auth::user()->admin_id)->first();
        }
    }


    public static function shopPluckValue()
    {
        if (Auth::user()->user_type == 'SuperAdmin') {
            return Shop::wherestatus(1)->pluck('shop_name', 'id');
        } elseif (Auth::user()->user_type == 'Admin') {
            return Shop::wherestatus(1)->whereadmin_id(Auth::id())->pluck('shop_name', 'id');
        } else {
            return Shop::wherestatus(1)->whereid(Auth::user()->shop_id)->pluck('shop_name', 'id');
        }
    }
    public static function shopCurrentStocks()
    {
        if (Auth::user()->user_type == 'SuperAdmin') {
            return ShopCurrentStock::sum('stock_qty');
        } elseif (Auth::user()->user_type == 'Admin') {
            return ShopCurrentStock::whereadmin_id(Auth::id())->sum('stock_qty');
        } else {
            return ShopCurrentStock::whereadmin_id(Auth::user()->admin_id)->sum('stock_qty');
        }
    }
    public static function supplierPluckValue()
    {
        if (Auth::user()->user_type == 'SuperAdmin') {
            return Supplier::wherestatus(1)->pluck('supplier_name', 'id');
        } elseif (Auth::user()->user_type == 'Admin') {
            return Supplier::wherestatus(1)->whereadmin_id(Auth::id())->pluck('supplier_name', 'id');
        } else {
            return Supplier::wherestatus(1)->whereadmin_id(Auth::user()->admin_id)->pluck('supplier_name', 'id');
        }
    }

    public static function getEmployes($id)
    {

            return User::wherestatus(1)->whereadmin_id($id)->get(['name', 'id']);

    }
    public static function customerPluckValue()
    {
        if (Auth::user()->user_type == 'SuperAdmin') {
            return Customer::wherestatus(1)->pluck('customer_name', 'id');
        } elseif (Auth::user()->user_type == 'Admin') {
            return Customer::wherestatus(1)->whereadmin_id(Auth::id())->pluck('customer_name', 'id');
        } else {
            return Customer::wherestatus(1)->whereadmin_id(Auth::user()->admin_id)->pluck('customer_name', 'id');
        }
    }
    public static function brokerPluckValue()
    {
        if (Auth::user()->user_type == 'SuperAdmin') {
            return Customer::wherestatus(1)->pluck('customer_name', 'id');
        } elseif (Auth::user()->user_type == 'Admin') {
            return Customer::wherestatus(1)->whereadmin_id(Auth::id())->pluck('customer_name', 'id');
        } else {
            return Customer::wherestatus(1)->whereadmin_id(Auth::user()->admin_id)->pluck('customer_name', 'id');
        }
    }
   





    public static function getCountryName()
    {
        return Country::pluck('country_name', 'country_name');
    }
    public static function defaultImagePath()
    {
        return 'storage/files/shares/backend';
    }
    public static function defaultImageName()
    {
        return 'not_found.webp';
    }
   
}
