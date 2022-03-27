<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    function getPopularAttribute($attribute)
    {
        return [
            "1" => "Yes",
            "0" => "No",
        ][$attribute];
    }
}
