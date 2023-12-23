<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class Product extends Model
{
    use HasFactory,LogsActivity;
    protected $casts = [
        'created_at' => 'datetime:d M Y H : m',

    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*']);
    }
    public function user(){
        return $this->belongsTo(User::class,'created_user_id','id')->select('id','name');
    }
    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id','id');
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function subcategory(){
        return $this->belongsTo(SubCategory::class)->withDefault();
    }

    public function shopcurrentstock(){
        return $this->hasMany(ShopCurrentStock::class);
    }
}
