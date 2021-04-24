<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pay;
use Illuminate\Support\Facades\DB;

class PayController extends Controller
{
    //
    public function index()
    {
        $get_pay=DB::table('pay')->get();
        return view('dashboard.pay.show',
            ['get_pay'=>$get_pay]
        );
    }
    public function add()
    {
        return view('dashboard.pay.add');
    }

    public function addPost(Request $request)
    {
        if (!$request->get('pay_name')) {
            return response('Tên phương thức không được để trống!',400);
        }
        if (!$request->get('pay_code')) {
            return response('Mã phương thức không được để trống!',400);
        }

        $get_pay=DB::table('pay')->select('pay_code')->get();
        $array_code=[];
        foreach ($get_pay as $key => $value) {
            array_push ($array_code, $value->pay_code);
        }

        $check_code_pay = in_array($request->get('pay_code'),$array_code);

        if ($check_code_pay==true) {
            return response('Mã phương thức này đã tồn tại!',400);
        }

        $pay = new Pay;
        $pay -> pay_name = $request->get('pay_name');
        $pay -> pay_code = $request->get('pay_code');
        $pay -> status = $request->get('status');
        $pay -> save();

        if ($pay->wasRecentlyCreated == true) {
            return response('Thêm phương thức thành công!');
        }else{
            return response('Thêm phương thức không thành công!',400);
        }
    }

    public function edit($id)
    {
        $edit_pay = DB::table('pay')->where([
            'pay_code'=> $id
        ])->get();
        return view('dashboard.pay.edit',
            ['edit_pay'=>$edit_pay[0]]
        );
    }

    public function update(Request $request)
    {
        if (!$request->get('pay_name')) {
            return response('Tên phương thức không được để trống!',400);
        }
        if (!$request->get('pay_code')) {
            return response('Mã phương thức không được để trống!',400);
        }

        $get_pay=DB::table('pay')->select('pay_code')->get();

        $array_code=[];

        foreach ($get_pay as $key => $value) {
            array_push ($array_code, $value->pay_code);
        }

        $check_code_pay = in_array($request->get('pay_code'),$array_code);

        if ($check_code_pay==true) {
            return response('Mã phương thức này đã tồn tại!',400);
        }

        $update = Pay::where('id',$request->get('id'))->update(array(
            'pay_name' => $request->get('pay_name'),
            'pay_code' => $request->get('pay_code'),
            'status' => $request->get('status'),
        ));

        if ($update==1) {
            return response('Cập nhập phương thức thành công!');
        }else{
            return response('Cập nhập phương thức không thành công!',400);
        }

    }

    public function delete(Request $request)
    {
        $delete = DB::table('pay')->where('id', $request->get('id'))->delete();
        if ($delete==1) {
            return response('Xoá phương thức thành công!');
        }else{
            return response('Xoá phương thức không thành công!',400);
        }
    }
}
