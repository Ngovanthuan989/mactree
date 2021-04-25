<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ships;
use Illuminate\Support\Facades\DB;
use App\Helpers\HttpRequestHelper;


class ShipController extends Controller
{
    //
    public function index()
    {
        $get_ship=DB::table('shipping')->get();
        return view('dashboard.ship.show',
            ['get_ship'=>$get_ship]
        );
    }

    public function add()
    {
        return view('dashboard.ship.add');
    }

    public function addPost(Request $request)
    {
        if (!$request->get('ship_name')) {
            return response('Tên đơn vị không được để trống!',400);
        }
        if (!$request->get('ship_code')) {
            return response('Mã đơn vị không được để trống!',400);
        }

        $get_ship=DB::table('shipping')->select('ship_code')->get();
        $array_code=[];
        foreach ($get_ship as $key => $value) {
            array_push ($array_code, $value->ship_code);
        }

        $check_code_ship = in_array($request->get('ship_code'),$array_code);

        if ($check_code_ship==true) {
            return response('Mã đơn vị này đã tồn tại!',400);
        }

        $ship = new Ships;
        $ship -> ship_name = $request->get('ship_name');
        $ship -> ship_code = $request->get('ship_code');
        $ship -> status = $request->get('status');
        $ship -> save();


        if ($ship->wasRecentlyCreated == true) {
            return response('Thêm đơn vị vận chuyển thành công!');
        }else{
            return response('Thêm đơn vị vận chuyển không thành công!',400);
        }
    }

    public function edit($id)
    {
        $edit_ship = DB::table('shipping')->where([
            'ship_code'=> $id
        ])->first();

        return view('dashboard.ship.edit',
            ['edit_ship'=>$edit_ship]
        );
    }

    public function update(Request $request)
    {
        if (!$request->get('ship_name')) {
            return response('Tên đơn vị không được để trống!',400);
        }
        if (!$request->get('ship_code')) {
            return response('Mã đơn vị không được để trống!',400);
        }

        $get_ship=DB::table('shipping')->select('ship_code')->get();
        $array_code=[];
        foreach ($get_ship as $key => $value) {
            array_push ($array_code, $value->ship_code);
        }

        $check_code_ship = in_array($request->get('ship_code'),$array_code);

        if ($check_code_ship==true) {
            return response('Mã đơn vị này đã tồn tại!',400);
        }

        $update = Ships::where('id',$request->get('id'))->update(array(
            'ship_name' => $request->get('ship_name'),
            'ship_code' => $request->get('ship_code'),
            'status'    => $request->get('status'),
        ));

        if ($update==1) {
            return response('Cập nhập đơn vị vận chuyển thành công!');
        }else{
            return response('Cập nhập đơn vị vận chuyển không thành công!',400);
        }

    }

    public function shipConnect()
    {
        $get_ship=DB::table('shipping')->where([
            'status' => 1
        ])->get();
        return view('dashboard.ship.connect',
            ['get_ship'=>$get_ship]
        );
    }

    public function addConnect($id)
    {
        $ship=DB::table('shipping')->where([
            'status'    => 1,
            'ship_code' => $id
        ])->first();

        $get_ship=DB::table('shipping')->where([
            'status' => 1
        ])->get();

        return view('dashboard.ship.addConnect',
            [
                'ship'     => $ship,
                'get_ship' => $get_ship
            ]
        );
    }

    public function addPostConnect(Request $request)
    {
        if (!$request->get('ship_key')) {
            return response('Key kết nối không được phép để trống!',400);
        }

        $dataHeader = [];
        $dataHeader[] = 'Content-type:application/json';
        $dataHeader[] = 'Token: ' . $request->get('ship_key');

        $apiUrl = 'https://online-gateway.ghn.vn/shiip/public-api/v2/shop/all';

        $callApiGhn = HttpRequestHelper::callApi('', $apiUrl, $dataHeader);

        if ($callApiGhn->code == 200) {

            $update = Ships::where('id',$request->get('id'))->update(array(
                'ship_key' => $request->get('ship_key'),
                'active'   => 1,
                'ship_img' => 'Giao_Hang_Nhanh_Toan_Quoc.png'
            ));

            if ($update == 1) {
                return response('Đã kết nối đến đơn vị vận chuyển GHN!');

            }else{

                return response('Có lỗi xảy ra!',400);
            }


        }else{
            return response($callApiGhn->message,400);
        }
    }

    public function deleteConnect(Request $request)
    {
        $update = Ships::where('id',$request->get('id'))->update(array(
            'ship_key' => '',
            'active'   => 2,
            'ship_img' => ''
        ));

        if ($update == 1) {
            return response('Đã huỷ kết nối đến đơn vị vận chuyển GHN!');

        }else{

            return response('Có lỗi xảy ra!',400);
        }
    }
}
