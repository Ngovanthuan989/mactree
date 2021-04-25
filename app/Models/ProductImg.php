<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImg extends Model
{
    //
    protected $table = "product_img";
    protected $fillable = ['product_id', 'image'];

    public function product() {
        return $this->hasMany('App\Models\Product','id','product_id');
    }
}
