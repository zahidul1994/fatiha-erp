<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Helpers\Helper;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\CustomerDue;
use App\Models\SubCategory;
use App\Models\SupplierDue;
use Illuminate\Http\Request;

class OnChangeController extends Controller
{
    public function getSubCategory($id){
        return SubCategory::wherestatus(1)->wherecategory_id($id)->get(['id','sub_category_name']);
    }

    public function getSupplierDue($id){
         return Supplier::find($id)->total_balance;

    }
    public function getCustomerDue($id){
   return Customer::find($id)->total_balance;
    }

    public function getAdminInformation($id){
   $admin= User::with('package')->find($id);
   $balance=(Helper::getadminBlance($admin->id)->where('status',1)->sum('credit'))-Helper::getadminBlance($admin->id)->where('status',1)->sum('debit');
$days=$balance/$admin->package->price;
     return response()->json([
        'success'=>true,
        'expireDate'=>$admin->account_expire_date,
        'balance'=>$balance,
        'package'=>$admin->package->package_name,
        'packagePrice'=>$admin->package->price,
        'newExpireDate'=>Carbon::create($admin->account_expire_date)->addDays($days)->format("Y-m-d"),
        'days'=>$days,
     ]);
    }


}
