<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setup extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class,'created_user_id','id')->select('id','name');
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class,'default_supplier_id','id')->withDefault([
            'id' => 'Add Default Supplier']);
    }
    public function customer(){
        return $this->belongsTo(Customer::class,'default_customer_id','id')->withDefault();
    }
}
