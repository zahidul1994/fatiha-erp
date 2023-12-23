<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseHead extends Model
{
    use HasFactory;
    protected $casts = [
        'created_at' => 'datetime:d M Y H : m',
        
    ];

    public function user(){
        return $this->belongsTo(User::class,'superadmin_id','id')->select('id','name');
    }
}
