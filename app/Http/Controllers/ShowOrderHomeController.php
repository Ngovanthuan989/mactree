<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order;



class ShowOrderHomeController extends Controller
{
    public function index()
    {
        $user_id = Session::get('id_user');

        $get_order=Order::where([
            'customer_id'=> $user_id
        ])
        ->orderBy('id', 'DESC')
        ->get();

        return view('homeuser.order.show',[
                'get_order'=>$get_order
            ]
        );
    }
}
