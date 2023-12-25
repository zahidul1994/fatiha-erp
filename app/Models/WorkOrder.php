<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'created_user_id');
    }
}
