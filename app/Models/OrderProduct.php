<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    //
    protected $table = "order_product";

    public function product() {
        return $this->hasMany('App\Models\Product','id','product_id');
    }
}
