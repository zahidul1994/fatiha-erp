<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class DamageProduct extends Model
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
        return $this->belongsTo(User::class, 'created_user_id', 'id')->select('id', 'name', 'email', 'phone');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function damageproductdetails()
    {
        return $this->hasMany(DamageProductDetails::class);
    }
}
