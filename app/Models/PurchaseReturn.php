<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PurchaseReturn extends Model
{
    use HasFactory, LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*']);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'created_user_id', 'id')->select('id', 'name');
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function purchasereturndetails()
    {
        return $this->hasMany(PurchaseReturnDetails::class);
    }
}
