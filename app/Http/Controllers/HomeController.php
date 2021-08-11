<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\HttpRequestHelper;
use App\Helpers\MailHelper;
use Illuminate\Support\Facades\Cookie;
use App\Models\Customers;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;






class HomeController extends Controller
{
    //
    public function index()
    {
        $count_user=DB::table('user')->count();
        $get_order=Order::count();

        $createdAtFrom = date('Y-m-d 00:00:00', strtotime(' -7 days'));
        $createdAtTo = date('Y-m-d 23:59:59');
        $count_dt=Order::whereBetween('created_at', [$createdAtFrom, $createdAtTo])
        ->orderBy('id', 'DESC')
        ->get();
        $get_product = DB::table('product')->count();

        $count_total = 0;
        foreach ($count_dt as $key => $value) {
            $count_total +=  str_replace(',','',$value->total_money);;

        }
        return view('dashboard.home.index',[
            'count_user' => $count_user,
            'get_order'  => $get_order,
            'count_total' => $count_total,
            'get_product' => $get_product
        ]);
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
        ])->first();

        if (!$login) {
            return response('Tài khoản hoặc mật khẩu sai!',400);
        }


        if ($login -> permission == null) {
            return response('Tài khoản chưa được xác thực!',400);
        }

        $verification_codes = mt_rand(100000,999999);

        if ($login -> id) {
            Session::put('user_id', $login -> id);
            // gửi mail mã xác thực
            $email_to = $request->get('email');
            $template = config('apps.email_template_login.template');
            $template = str_replace('{$MacTreeCode}',$verification_codes, $template);
            Mail::send([], [], function ($message) use($template,$email_to) {
                $template = str_replace('{$topImage}', $message->embed('uploads/images/logo_mactree_thaihoang.png'), $template);
                $template = str_replace('{$bottomImage}', $message->embed('uploads/images/logo_mactree_thaihoang.png'), $template);
                $message->to($email_to)
                    ->subject('[MACTREE]THÔNG BÁO MÃ XÁC THỰC')
                    ->setBody($template, 'text/html') ;// for HTML rich messages
                 });

            $update = Customers::where('id',$login -> id)->update(array(
                'code_accuracy' => $verification_codes,
            ));

            if ($update == 1){
                return response('Mã xác thực được gửi đến mail!Bạn vui lòng check mail để đăng nhập!');
            }else{
                return response('Có lỗi xảy ra!',400);
            }
        }



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

    public function profile()
    {
        $get_permission=DB::table('permission')->get();

        return view('dashboard.home.profile',[
            'get_permission' => $get_permission
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

                return redirect()->route('dashboard.profile.show')->withErrors($validate)->with('user',$user);

            }

            $update = Customers::where('id',$request->get('id'))->update(array(
                'full_name' => $request -> get('full_name'),
                'email'     => $request -> get('email'),
                'phone'     => $request ->  get('phone'),
                'permission'=> $request ->  get('permission'),
                'avatar'    => $filename
            ));

            if ($update==1) {
                $login = DB::table('customer')->where([
                    'id'     =>  $request->get('id')
                ])->get();

                Cookie::queue('logged_user', json_encode($login[0]), 100);
                return redirect()->route('dashboard.profile.show')->with('success', 'Cập nhập thành công');

            }else{

                return redirect()->route('dashboard.profile.show')->with(['user'=>$user,'error'=>'Có lỗi xảy ra']);

            }

        }else{
            $validate = Validator::make(

                $request->all(),
                [
                    'phone'     => 'required',
                    'full_name' => 'required',
                    'email'     => 'required|email'

                ], [

                    'phone.required'     => 'Phone không được bỏ trống',
                    'email.email'        => 'Email không đúng định dạng',
                    'email.required'     => 'Email không được để trống',
                    'full_name.required' => 'Tên không được để trống'
                ]

            );



            if ($validate -> fails()) {

                return redirect()->route('dashboard.profile.show')->withErrors($validate)->with('user',$user);

            }

            $update = Customers::where('id',$request->get('id'))->update(array(
                'full_name' => $request -> get('full_name'),
                'email'     => $request -> get('email'),
                'phone'     => $request ->  get('phone'),
                'permission'=> $request ->  get('permission'),
            ));

            if ($update==1) {
                $login = DB::table('customer')->where([
                    'id'     =>  $request->get('id')
                ])->get();

                Cookie::queue('logged_user', json_encode($login[0]), 100);

                return redirect()->route('dashboard.profile.show')->with('success', 'Cập nhập thành công');

            }else{

                return redirect()->route('dashboard.profile.show')->with(['user'=>$user,'error'=>'Có lỗi xảy ra']);

            }
        }


    }

    public function changePassword()
    {
        $get_permission=DB::table('permission')->get();
        return view('dashboard.home.changePassword',[
            'get_permission' => $get_permission
        ]);
    }
    public function postResetPassword(Request $request)
    {
        if (!$request->get('password')) {
            return response('Mật khẩu hiện tại không được để trống',400);
        }
        if (!$request->get('password_new')) {
            return response('Mật khẩu mới không được để trống',400);
        }
        if (!$request->get('password_new2')) {
            return response('Bạn cần xác nhận lại mật khẩu',400);
        }
        if ($request->get('password_new2') != $request->get('password_new')) {
            return response('Mật khẩu xác nhận không khớp',400);
        }
        if ($request->get('password_new') == $request->get('password')) {
            return response('Mật khẩu mới không được trùng với mật khẩu hiện tại',400);
        }

        $user = Customers::where([
            'id'       => $request->get('id')
        ])
        ->first();
        if($user){
            if (md5($request->get('password')) == $user->password) {
                $update = Customers::where('id',$request->get('id'))->update(array(
                    'password' => md5($request -> get('password_new')),
                ));

                if ($update==1) {

                    return response('Đổi mật khẩu thành công');

                }else{

                    return response('Có lỗi xảy ra',400);

                }
            }
            else{
                return response('Mật khẩu hiện tại không đúng',400);
            }
        }
        else{
            return response('Tài khoản không tồn tại',400);
        }
    }

}
