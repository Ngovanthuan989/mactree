<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = "orders";
    public $timestamps = true;


    public function customer() {
        return $this->hasMany('App\Models\Users','id','customer_id');
    }

    public function ship() {
        return $this->hasMany('App\Models\Ships','id','ship_id');
    }
}
