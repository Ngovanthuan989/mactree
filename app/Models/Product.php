<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = "product";

    public function productImg() {
        return $this->hasMany('App\Models\ProductImg','product_id','id');
    }
}
