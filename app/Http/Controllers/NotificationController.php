<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;


class NotificationController extends Controller
{
    //
    public function index()
    {
        $get_notification=Notification::get();

        $count = 0;
        foreach ($get_notification as $key => $notification) {
            $count ++;
        }
        $data =[];
        $data['listNotify'] = $get_notification;
        $data['htmlNotify'] = view('dashboard.layout.notify', ['data' => $get_notification])->render();
        $data['count'] = $count;

        return response()->json($data);
    }
}
