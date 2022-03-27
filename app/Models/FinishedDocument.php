<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinishedDocument extends Model
{
    public function order()
    {
        return $this->$this->belongsTo(Order::class);
    }
}
