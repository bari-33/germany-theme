<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeProduct extends Model
{
    public function userdetails()
    {
        return $this->belongsTo(UserDetail::class);

    }
}
