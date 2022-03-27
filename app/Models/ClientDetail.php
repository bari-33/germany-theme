<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientDetail extends Model
{
    protected $guarded=[];
    function user()
    {
        return $this->belongsTo(User::class);

    }
}
