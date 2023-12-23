<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class StockTransfer extends Model
{
    use HasFactory, LogsActivity;
    protected $casts = [
        'created_at' =>  'datetime:dS F, Y, H:i',
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*']);
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'created_user_id', 'id')->select('id', 'name', 'email', 'phone');
    }
    public function fromshop()
    {
        return $this->belongsTo(Shop::class, 'from_shop_id', 'id');
    }
    public function toshop()
    {
        return $this->belongsTo(Shop::class, 'to_shop_id', 'id');
    }
    public function stocktransferdetails()
    {
        return $this->hasMany(StockTransferDetails::class);
    }
}
