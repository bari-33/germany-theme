<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Website extends Model
{
    use SoftDeletes;
    protected $table = 'websites';
    function getProductCategoryAttribute($attribute)
    {
        $color=WebsiteCategory::find($attribute);
        return $color->name;
    }
}
