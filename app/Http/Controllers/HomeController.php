<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\HttpRequestHelper;
use App\Helpers\MailHelper;
use Illuminate\Support\Facades\Cookie;
use App\Models\Customers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;





class HomeController extends Controller
{
    //
    public function index()
    {
       return view('dashboard.home.index');
    }

    public function login()
    {
        return view('dashboard.home.login');
    }
    public function register()
    {
        return view('dashboard.home.register');
    }

    public function postRegister(Request $request)
    {
        if (!$request->get('full_name')) {
            return response('Tên không được để trống!',400);
        }
        if (!$request->get('email')) {
            return response('Email không được để trống!',400);
        }
        if (!$request->get('password')) {
            return response('Mật khẩu không được để trống!',400);
        }
        if ($request->get('password')!=$request->get('password2')) {
            return response('Mật khẩu không trùng khớp!',400);
        }
        $validator = Validator::make($request->all(), [
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => 'required|email',
        ], [
            'phone.regex'    => 'Số điện thoại không đúng định dạng',
            'phone.required' => 'Số điện thoại không được để trống',
            'email.email'    => 'Email không đúng định dạng',
        ]);
        if ($validator->fails()) {
            return response($validator->errors()->first(), 400);
        }

        $get_email=DB::table('customer')->select('email')->get();

        $array_code=[];

        foreach ($get_email as $key => $value) {
            array_push ($array_code, $value->email);
        }

        $check_email = in_array($request->get('email'),$array_code);

        if ($check_email==true) {
            return response('Email này đã tồn tại trong hệ thống!',400);
        }

        $get_phone=DB::table('customer')->select('phone')->get();

        $array_phone=[];
        foreach ($get_phone as $key => $value) {
            array_push ($array_phone, $value->phone);
        }

        $check_phone = in_array($request->get('phone'),$array_phone);

        if ($check_phone==true) {
            return response('Số điện thoại này đã tồn tại trong hệ thống!',400);
        }

        $customer = new Customers;
        $customer -> full_name = $request     -> get('full_name');
        $customer -> email     = $request     -> get('email');
        $customer -> phone     = $request     -> get('phone');
        $customer -> password  = md5($request -> get('password'));
        $customer -> save();

        if ($customer->wasRecentlyCreated == true) {
            return response('Đăng kí thành công đang chờ xác thực!');
        }else{
            return response('Đăng kí không thành công',400);
        }
    }

    public function postLogin(Request $request)
    {
        if (!$request->get('email')) {
            return response('Email không được để trống!',400);
        }

        if (!$request->get('password')) {
            return response('Password không được để trống!',400);
        }

        $login = DB::table('customer')->where([
            'email'     =>  $request     -> get('email'),
            'password'  =>  md5($request -> get('password'))
        ])->get();

        if ($login[0] -> permission == null) {
            return response('Tài khoản chưa được xác thực!',400);
        }

        $verification_codes = mt_rand(100000,999999);

        if ($login[0] -> id) {
            Session::put('user_id', $login[0] -> id);
            $subject ="Mã xác thực được gửi từ MacTree";
            $email_to = $request->get('email');
            $content = '<p><b>Công cty cổ phần MacTree</b></p>
                        <p><b>Mã xác thực</b>:'.$verification_codes.'</p>
            ';
            MailHelper::sendEmail($subject,$email_to,$content);

            $update = Customers::where('id',$login[0] -> id)->update(array(
                'code_accuracy' => $verification_codes,
            ));

            if ($update == 1){
                return response('Mã xác thực được gửi đến mail!Bạn vui lòng check mail để đăng nhập!');
            }else{
                return response('Có lỗi xảy ra!',400);
            }
        }

        return response('Tài khoản hoặc mật khẩu sai!',400);

    }

    public function checkCode(Request $request)
    {
        $id = Session::get('user_id');

        $login = DB::table('customer')->where([
            'id'     =>  $id
        ])->get();

        if($login[0] -> code_accuracy == $request->get('code_accuracy')){
            Cookie::queue('logged_user', json_encode($login[0]), 100);
            return response('Thành công!');
        }else{
            return response('Mã xác thực không đúng!',400);
        }

    }

    public function logout(Request $request) {
        // Logout luon
        CommonHelper::destroyCookie();
        return redirect()->route('home.index');
    }

    public function profile(Request $request)
    {
        $id = Session::get('user_id');

        $user = DB::table('customer')->where([
            'id'     =>  $id
        ])->get();

        return view('dashboard.home.profile',[
            'user' => $user[0]
        ]);
    }


    public function editProfile($id)
    {

        $user = DB::table('customer')->where([
            'id'     =>  $id
        ])->get();

        return view('dashboard.home.editProfile',[
            'user' => $user[0]
        ]);
    }

    public function updateProfile(Request $request)
    {
        $userInfo = DB::table('customer')->where([
            'id'     =>  $request->get('id')
        ])->get();

        $user = $userInfo[0];

        if($request->file('avatar') != ''){
            $path = public_path().'/uploads/images/';


            //upload new file
            $file = $request->file('avatar');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);


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

                return redirect()->route('dashboard.profile.edit',['id' =>  $request->get('id')])->withErrors($validate)->with('user',$user);

            }

            $update = Customers::where('id',$request->get('id'))->update(array(
                'full_name' => $request -> get('full_name'),
                'email'     => $request -> get('email'),
                'phone'     => $request ->  get('phone'),
                'avatar'    => $filename
            ));

            if ($update==1) {

                return redirect()->route('dashboard.profile.show')->with('success', 'Cập nhập thành công');

            }else{

                return redirect()->route('dashboard.profile.edit',['id' =>  $request->get('id')])->with(['user'=>$user,'error'=>'Có lỗi xảy ra']);

            }

        }else{

            return redirect()->route('dashboard.profile.edit',['id' =>  $request->get('id')])->with(['user'=>$user,'error'=>'Xin vui lòng chọn ảnh']);

        }



    }

}
