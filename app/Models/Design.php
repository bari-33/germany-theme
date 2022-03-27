<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Design extends Model
{
    use SoftDeletes;


    function getProductCategoryAttribute($attribute)
{
    $color=DesignCategory::find($attribute);
    return $color->name;
}
}
