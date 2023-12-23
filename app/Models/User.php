<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, LogsActivity, HasRoles;
    protected $dates = ['deleted_at'];
     use SoftDeletes;
    protected $fillable = [
        'name',
        'phone',
        'user_type',
        'last_login',
        'ip_address',
        'email',
        'image',
        'account_expire_date',
        'password',
        'remember_token',
        'invoice_slug',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',

    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['*']);
    }

    public function profile(){
        return $this->hasOne(Profile::class);
    }
    public function setup(){
        return $this->hasOne(Setup::class,'admin_id');
    }
    public function shop(){
        return $this->belongsTo(Shop::class,'shop_id');
    }
    public function package(){
        return $this->belongsTo(Package::class,'package_id');
    }

}
