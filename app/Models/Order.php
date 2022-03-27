<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PayPal\Api\Payer;

class Order extends Model
{
    use SoftDeletes;

    public function getProductAttribute()
    {
        $product=Product::find($this->product_id);
        return $product->product_title;
    }
    public function getPDetailAttribute()
    {
        $product=Product::find($this->product_id);
        return $product;
    }

    public function getWebsiteAttribute()
    {
        $website=Website::find($this->website_id);
        return $website;
    }
    public function getDesignAttribute()
    {
        $design=Design::find($this->design_id);
        return $design;
    }

    public function getExpressStatusAttribute()
    {
        if ($this->express==0)
        {
            $string='Normal';
        }
        else
        {
            $string='Express';

        }
        return $string;
    }

    public function getProductLanguageAttribute()
    {

        $product=Product::find($this->product_id);
        return $product->language;
    }

    /*
    public function getOrderStatusAttribute($attribute)
    {
        return [
            "0" => "Pending",
            "1" => "Verified",
            "-1" => "Rejected",
        ][$attribute];
    }*/

    function user()
    {
        return $this->belongsTo(User::class,'customer_id');

    }
    function orderdetail()
    {
        return $this->hasOne(OrderDetail::class);

    }

    public function documents()
    {
        return $this->hasMany(OrderDocument::class);
    }


    public function trialdocuments()
    {
        return $this->hasMany(TrialDocument::class);
    }
    public function finisheddocuments()
    {
        return $this->hasMany(FinishedDocument::class);
    }

    public function employees()
    {
        return $this->belongsToMany(User::class)->withPivot('amount')->withTimestamps();
    }

    public function employees_detail()
    {
        return $this->hasOne('App\User','id','employee_chat');
    }

    public function orderprogress()
    {
        return $this->hasMany(order_progresses::class);
    }

    public function paypals()
    {
        return $this->hasMany(Paypal::class);
    }

}
