<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Wallet extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;
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
        return $this->belongsTo(User::class, 'created_user_id');
    }
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
