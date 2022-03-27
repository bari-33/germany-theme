<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paypal extends Model
{
    public function orders()
    {
        return $this->belongsTo(Order::class);
    }
}
