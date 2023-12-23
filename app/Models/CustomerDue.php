<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class CustomerDue extends Model
{
    use HasFactory, LogsActivity;
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
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
