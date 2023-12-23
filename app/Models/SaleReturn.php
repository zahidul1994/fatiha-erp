<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SaleReturn extends Model
{
    use HasFactory, LogsActivity;
    protected $dates = ['deleted_at'];
    protected $casts = [
        'created_at' =>  'datetime:dS F, Y, H:i a',
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*']);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'created_user_id', 'id')->select('id', 'name');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function salereturndetails()
    {
        return $this->hasMany(SaleReturnDetails::class);
    }
}
