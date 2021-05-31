<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;


class NotificationController extends Controller
{
    //
    public function index()
    {
        $get_notification=Notification::orderBy('id', 'DESC')->get();

        $count = 0;
        foreach ($get_notification as $key => $notification) {
            if ($notification->status == 1) {
                $count ++;
            }
        }
        $data =[];
        $data['listNotify'] = $get_notification;
        $data['htmlNotify'] = view('dashboard.layout.notify', ['data' => $get_notification])->render();
        $data['count'] = $count;

        return response()->json($data);
    }

    public function updateNotify(Request $request)
    {
        $update = Notification::where('id',$request->get('id'))->update(array(
            'status' => 2,
        ));
        $data =[];
        if ($update == 1) {
            $data['message'] = "Cập nhập noti thành công";
            return response()->json($data);
        }else{
            return response()->json($data);
        }
    }
}
