<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'created_user_id');
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function workorderdetails(){
        return $this->hasMany(WorkOrderDetails::class);
    }
}
