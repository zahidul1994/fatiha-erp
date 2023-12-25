<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warehouse extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $casts = [
        'created_at' =>  'datetime:dS F, Y, H:i a',

    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'created_user_id');
    }
   
    public function shop(){
        return $this->hasMany(Shop::class);
    }
}
