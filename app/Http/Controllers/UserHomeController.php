<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Users;
use App\Helpers\MailHelper;



class UserHomeController extends Controller
{
    //

    public function index(Request $request)
    {
        $get_user=DB::table('user')->paginate(6);
        return view('dashboard.userHome.show',[
            'get_user' => $get_user,
        ]);

    }

    public function edit($id)
    {
        $get_user = DB::table('user')->where([
            'id' => $id
        ])->get();

        return view('dashboard.userHome.edit',[
            'user' => $get_user[0],
        ]);

    }

    public function update(Request $request)
    {
        $update = Users::where('id',$request->get('id'))->update(array(
            'status' => $request->get('status'),

        ));

        if ($update==1) {
            return response('Cập nhập thành công!');
        }else{
            return response('Cập nhập không thành công!',400);
        }

    }

    public function delete(Request $request)
    {
        $delete = DB::table('user')->where('id', $request->get('id'))->delete();

        if ($delete==1) {
            return response('Xoá người dùng thành công!');
        }else{
            return response('Xoá người dùng không thành công!',400);
        }
    }

    public function add()
    {
        return view('dashboard.userHome.add');
    }

    public function addPost(Request $request)
    {

        $validate = Validator::make(

            $request->all(),
            [
                'full_name' => 'required',
                'email'     => 'required|email'

            ], [

                'email.email'        => 'Email không đúng định dạng',
                'email.required'        => 'Email không được để trống',
                'full_name.required' => 'Tên không được để trống'
            ]

        );



        if ($validate -> fails()) {

            return redirect()->route('dashboard.userHome.add')->withErrors($validate);

        }

        $get_email=DB::table('user')->select('email')->get();

        $array_code=[];

        foreach ($get_email as $key => $value) {
            array_push ($array_code, $value->email);
        }

        $check_email = in_array($request->get('email'),$array_code);

        if ($check_email==true) {
            return redirect()->route('dashboard.user.add')->with('error','Email này đã tồn tại trong hệ thống!');
        }


        $password = mt_rand(10000000,99999999);

        $customer = new Users;

        $customer -> full_name   = $request     -> get('full_name');
        $customer -> email       = $request     -> get('email');
        $customer -> status      = 1;
        $customer -> password    = md5($password);

        $customer -> save();

        if ($customer->wasRecentlyCreated == true) {

            $subject  = "Mật khẩu được gửi từ MacTree";
            $email_to = $request->get('email');
            $content  = '<p><b>Công cty cổ phần MacTree</b></p>
                    <p><b>Mật khẩu của bạn là</b>:'.$password.'</p>';

            MailHelper::sendEmail($subject,$email_to,$content);

            return redirect()->route('dashboard.userHome.add')->with('success', 'Thêm thành công');

        }else{

            return redirect()->route('dashboard.userHome.add')->with('error','Có lỗi xảy ra');

        }


    }
}
