<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Sale extends Model
{
    use HasFactory, SoftDeletes,LogsActivity;
    protected $dates = ['deleted_at'];
    protected $casts = [
        'created_at' =>  'datetime:dS F, Y, H:i a',
        ];

  public function getActivitylogOptions(): LogOptions
        {
            return LogOptions::defaults()
            ->logOnly(['*']);
        }
    public function user(){
        return $this->belongsTo(User::class,'created_user_id','id')->select('id','name');
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function shop(){
        return $this->belongsTo(Shop::class);
    }
    public function saledetails(){
        return $this->hasMany(SaleDetails::class);
    }
    public function customerdue(){
        return $this->hasOne(CustomerDue::class,'sale_id','id');
    }
}
