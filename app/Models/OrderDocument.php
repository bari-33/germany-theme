<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDocument extends Model
{
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
