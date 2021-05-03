<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function index()
    {
        $get_order=Order::with(['ship','customer'])->get();

        return view('dashboard.order.show',
            ['get_order'=>$get_order]
        );
    }
    public function edit()
    {
        return view('dashboard.order.edit');
    }
}
