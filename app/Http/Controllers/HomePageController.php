<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Helpers\HttpRequestHelper;
use Illuminate\Support\Facades\Validator;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class HomePageController extends Controller
{
    //
    public function index()
    {
        //  Lấy danh sách sản phẩm
        $get_product = DB::table('product')->get();

        return view('homeuser.home.index',[
            'get_product' => $get_product
        ]);
    }

    public function account(Request $request)
    {
        $dataHeader = [];
        $dataHeader[] = 'Content-type:application/json';
        $dataHeader[] = 'Token: ffdccdf1-fcae-11ea-a4d7-f63a98a5d75d';

        $apiUrl = 'https://online-gateway.ghn.vn/shiip/public-api/master-data/province';

        $callApiGhn = HttpRequestHelper::callApi('', $apiUrl, $dataHeader);

        if ($callApiGhn->code == 200) {
            $data_province = $callApiGhn->data;
            return view('homeuser.home.account',[
                'data_province' => $data_province
            ]);

        }else{
            return redirect()->route('homePage.home.show')->with('error','Không lấy được địa chỉ!');
        }

    }


    public function district(Request $request)
    {
        $dataHeader = [];
        $dataHeader[] = 'Content-type:application/json';
        $dataHeader[] = 'Token: ffdccdf1-fcae-11ea-a4d7-f63a98a5d75d';


        $data = '{
            "province_id":'.$request->get('province_id').'
        }';

        $apiUrl = 'https://online-gateway.ghn.vn/shiip/public-api/master-data/district';

        $callApiGhn = HttpRequestHelper::callApi($data, $apiUrl,$dataHeader);

        if ($callApiGhn->code == 200) {
            $data_district = $callApiGhn->data;

            $html='';
            foreach($data_district as $index){
              $html .= "<li data-value=".$index->DistrictID." class='option'>$index->DistrictName</li>";
            }
            return $html;

        }else{
            return response('Có lỗi xảy ra', 400);
        }

    }

    public function ward(Request $request)
    {
        $dataHeader = [];
        $dataHeader[] = 'Content-type:application/json';
        $dataHeader[] = 'Token: ffdccdf1-fcae-11ea-a4d7-f63a98a5d75d';


        $data = '{
            "district_id":'.$request->get('district_id').'
        }';

        $apiUrl = 'https://online-gateway.ghn.vn/shiip/public-api/master-data/ward';

        $callApiGhn = HttpRequestHelper::callApi($data, $apiUrl,$dataHeader);

        if ($callApiGhn->code == 200) {
            $data_ward = $callApiGhn->data;

            $html='';
            foreach($data_ward as $index){
              $html .= "<li data-value=".$index->WardCode." class='option'>$index->WardName</li>";
            }
            return $html;

        }else{
            return response('Có lỗi xảy ra', 400);
        }
    }

    public function register(Request $request)
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
        // if ($request->get('password')!=$request->get('password2')) {
        //     return response('Mật khẩu không trùng khớp!',400);
        // }
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

        $get_email=DB::table('user')->select('email')->get();

        $array_code=[];

        foreach ($get_email as $key => $value) {
            array_push ($array_code, $value->email);
        }

        $check_email = in_array($request->get('email'),$array_code);

        if ($check_email==true) {
            return response('Email này đã tồn tại trong hệ thống!',400);
        }

        $get_phone=DB::table('user')->select('phone')->get();

        $array_phone=[];
        foreach ($get_phone as $key => $value) {
            array_push ($array_phone, $value->phone);
        }

        $check_phone = in_array($request->get('phone'),$array_phone);

        if ($check_phone==true) {
            return response('Số điện thoại này đã tồn tại trong hệ thống!',400);
        }

        $user = new Users;
        $user -> full_name = $request     -> get('full_name');
        $user -> email     = $request     -> get('email');
        $user -> phone     = $request     -> get('phone');
        $user -> password  = md5($request -> get('password'));
        $user -> province  = $request     -> get('province');
        $user -> district  = $request     -> get('district');
        $user -> ward      = $request     -> get('ward');
        $user -> address   = $request     -> get('address');
        $user -> status    = 1;
        $user -> save();

        if ($user->wasRecentlyCreated == true) {
            return response('Đăng kí thành công!');
        }else{
            return response('Đăng kí không thành công',400);
        }
    }

    public function login(Request $request)
    {
        if (!$request->get('email')) {
            return response('Email không được để trống!',400);
        }

        if (!$request->get('password')) {
            return response('Password không được để trống!',400);
        }

        $login = DB::table('user')->where([
            'email'     =>  $request     -> get('email'),
            'password'  =>  md5($request -> get('password'))
        ])->first();

        if (!$login) {
            return response('Tài khoản hoặc mật khẩu sai!',400);
        }

        if ($login -> id) {
            Session::put('id_user', $login -> id);
            Cookie::queue('dn_user', json_encode($login), 100);
            return response('Đăng nhập thành công!');
        }
    }


}
