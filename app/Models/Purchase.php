<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Purchase extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;
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
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
    public function purchasedetails()
    {
        return $this->hasMany(PurchaseDetails::class);
    }
}
