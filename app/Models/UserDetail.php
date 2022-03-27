<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $guarded=[];
    function user()
    {
        return $this->belongsTo(User::class);

    }

     function getDeutchLanguageAttribute()
     {
         if($this->deutch=='1')
         {
             $deutch='Deut';
         }
         else
         {
             $deutch='';
         }
         return $deutch;
     }

    function getEnglishLanguageAttribute()
    {
        if($this->english=='1')
        {
            $english='Eng';
        }
        else
        {
            $english='';
        }
        return $english;
    }

    function getSpanishLanguageAttribute()
    {
        if($this->spanish=='1')
        {
            $spanish='Span';
        }
        else
        {
            $spanish='';
        }
        return $spanish;
    }

    function getFrenchLanguageAttribute()
    {
        if($this->french=='1')
        {
            $french='Fren';
        }
        else
        {
            $french='';
        }
        return $french;
    }

    function getWebLanguageAttribute()
    {
        if($this->web_designer=='1')
        {
            $web_designer='Web';
        }
        else
        {
            $web_designer='';
        }
        return $web_designer;
    }
    function getGraphicLanguageAttribute()
    {
        if($this->graphic_designer=='1')
        {
            $graphic_designer='Grap';
        }
        else
        {
            $graphic_designer='';
        }
        return $graphic_designer;
    }
    function getMediaLanguageAttribute()
    {
        if($this->media_designer=='1')
        {
            $media_designer='Media';
        }
        else
        {
            $media_designer='';
        }
        return $media_designer;
    }
    public function employeeproducts()
    {
        return $this->hasMany(EmployeeProduct::class);

    }
}
