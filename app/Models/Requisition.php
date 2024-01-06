<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'created_user_id');
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
    public function requisitiondetails(){
        return $this->hasMany(RequisitionDetails::class);
    }

}
