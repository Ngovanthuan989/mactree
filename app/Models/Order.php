<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = "orders";

    public function customer() {
        return $this->hasMany('App\Models\Customers','id','customer_id');
    }

    public function ship() {
        return $this->hasMany('App\Models\Ships','id','ship_id');
    }
}
