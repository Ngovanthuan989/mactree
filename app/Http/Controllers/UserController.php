<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Customers;
use Illuminate\Support\Facades\Mail;
use App\Helpers\MailHelper;



class UserController extends Controller
{
    //

    public function index(Request $request)
    {
        $get_permission=DB::table('permission')->get();
        $get_user=DB::table('customer')->paginate(6);
        return view('dashboard.user.show',[
            'get_user' => $get_user,
            'get_permission' => $get_permission
        ]);

    }

    public function edit($id)
    {
        $get_user = DB::table('customer')->where([
            'id' => $id
        ])->get();

        $get_permission=DB::table('permission')->get();

        return view('dashboard.user.edit',[
            'user' => $get_user[0],
            'get_permission' => $get_permission
        ]);

    }

    public function update(Request $request)
    {
        $update = Customers::where('id',$request->get('id'))->update(array(
            'permission' => $request->get('permission'),

        ));

        if ($update==1) {
            return response('Cập nhập thành công!');
        }else{
            return response('Cập nhập không thành công!',400);
        }

    }

    public function delete(Request $request)
    {
        $delete = DB::table('customer')->where('id', $request->get('id'))->delete();

        if ($delete==1) {
            return response('Xoá người dùng thành công!');
        }else{
            return response('Xoá người dùng không thành công!',400);
        }
    }

    public function add()
    {
        $get_permission=DB::table('permission')->get();

        return view('dashboard.user.add',[
            'get_permission' => $get_permission
        ]);
    }

    public function addPost(Request $request)
    {

        if($request->file('avatar') != ''){
            $path = public_path().'/uploads/images/';


            //upload new file
            $file     =    $request -> file('avatar');
            $filename =    $file    -> getClientOriginalName();
            $file -> move($path, $filename);


            $validate = Validator::make(

                $request->all(),
                [
                    'phone'     => 'required',
                    'full_name' => 'required',
                    'email'     => 'required|email'

                ], [

                    'phone.required'     => 'Phone không được bỏ trống',
                    'email.email'        => 'Email không đúng định dạng',
                    'full_name.required' => 'Tên không được để trống'
                ]

            );



            if ($validate -> fails()) {

                return redirect()->route('dashboard.user.add')->withErrors($validate);

            }

            $get_email=DB::table('customer')->select('email')->get();

            $array_code=[];

            foreach ($get_email as $key => $value) {
                array_push ($array_code, $value->email);
            }

            $check_email = in_array($request->get('email'),$array_code);

            if ($check_email==true) {
                return redirect()->route('dashboard.user.add')->with('error','Email này đã tồn tại trong hệ thống!');
            }

            $get_phone=DB::table('customer')->select('phone')->get();

            $array_phone=[];

            foreach ($get_phone as $key => $value) {
                array_push ($array_phone, $value->phone);
            }

            $check_phone = in_array($request->get('phone'),$array_phone);

            if ($check_phone == true) {
                return redirect()->route('dashboard.user.add')->with('error','Số điện thoại này đã tốn tại trong hệ thống!');
            }


            $password = mt_rand(10000000,99999999);

            $customer = new Customers;

            $customer -> full_name   = $request     -> get('full_name');
            $customer -> email       = $request     -> get('email');
            $customer -> phone       = $request     -> get('phone');
            $customer -> password    = md5($password);
            $customer -> permission  = $request     -> get('permission');
            $customer -> avatar      = $filename;

            $customer -> save();

            if ($customer->wasRecentlyCreated == true) {

                $email_to = $request->get('email');
                // Gửi email:
                 $template = config('apps.email_template_acc.template');
                 $template = str_replace('{$EmailAdminMacTree}', $request -> get('email'), $template);
                 $template = str_replace('{$PassAdminMacTree}', $password, $template);

                 Mail::send([], [], function ($message) use($template,$email_to) {
                     $template = str_replace('{$topImage}', $message->embed('uploads/images/logo_mactree_thaihoang.png'), $template);
                     $template = str_replace('{$bottomImage}', $message->embed('uploads/images/logo_mactree_thaihoang.png'), $template);
                     $message->to($email_to)
                         ->subject('[MACTREE]THÔNG BÁO THÔNG TIN TÀI KHOẢN PHẦN MỀM QUẢN LÝ')
                         ->setBody($template, 'text/html') ;// for HTML rich messages
                 });

                return redirect()->route('dashboard.user.show')->with('success', 'Thêm thành công');

            }else{

                return redirect()->route('dashboard.user.add')->with('error','Có lỗi xảy ra');

            }

        }else{

            return redirect()->route('dashboard.user.add')->with('error','Xin vui lòng chọn ảnh');

        }
    }
}
