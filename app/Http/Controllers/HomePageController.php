<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Helpers\HttpRequestHelper;
use App\Models\Notification;
use Illuminate\Support\Facades\Validator;
use App\Models\Users;
use App\Helpers\CommonHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

class HomePageController extends Controller
{
    //
    public function index(Request $request)
    {
        //  Lấy danh sách sản phẩm

        if ($request->product_name) {
            $get_product = Product::where('product_name', 'like', '%' . $request->product_name . '%')
            ->get();
            $product_name = $request->product_name;

        }else{
            $get_product = Product::get();
            $product_name = '';
        }


        $get_slider = DB::table('slider')->where([
            'status'     => 1,
        ])->get();



        return view('homeuser.home.index',[
            'get_product'   => $get_product,
            'get_slider'    => $get_slider,
            'product_name'  => $product_name
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

    public function district2(Request $request)
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
              $html .= "<option value=".$index->DistrictID.">$index->DistrictName</option>";
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

    public function ward2(Request $request)
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
              $html .= "<option value=".$index->WardCode.">$index->WardName</option>";
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
            'email' => 'required|email',
        ], [
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

        // $get_phone=DB::table('user')->select('phone')->get();

        // $array_phone=[];
        // foreach ($get_phone as $key => $value) {
        //     array_push ($array_phone, $value->phone);
        // }

        // $check_phone = in_array($request->get('phone'),$array_phone);

        // if ($check_phone==true) {
        //     return response('Số điện thoại này đã tồn tại trong hệ thống!',400);
        // }

        $user = new Users;
        $user -> full_name = $request     -> get('full_name');
        $user -> email     = $request     -> get('email');
        $user -> password  = md5($request -> get('password'));
        $user -> status    = 1;
        $user -> save();

        $notification = new Notification;
        $notification -> title    = "Khách hàng mới";
        $notification -> content  = $user->full_name .' vừa đăng ký tài khoản ';
        $notification -> code     = $user->id;
        $notification -> type     = 2;
        $notification -> status   = 1;
        $notification -> save();

        if ($user->wasRecentlyCreated == true) {
            $dataHeader = [];
            $dataHeader[] = 'Content-type:application/json';
            $dataHeader[] = 'Authorization: Basic MGEzNWI4YzYtYWU4MS00MTY3LWI2MTEtZjVkZmM2NWMzMTU2';

            $data = '{
                "app_id": "6ea4c522-3c23-481e-9f7a-1bfed48e6395",
                "contents": {"en": "'.$user->full_name .' vừa đăng ký tài khoản"},
                "headings": {"en": "Khách hàng mới"},
                "included_segments": [
                    "Subscribed Users"
                ]
            }';

            $apiUrl = 'https://onesignal.com/api/v1/notifications';

            $callApiNotification = HttpRequestHelper::callApi($data, $apiUrl,$dataHeader);

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

        if ($login -> status == 2) {
            return response('Tài khoản của bạn đã ở trạng thái không hoạt động vui lòng liên hệ với MacTree',400);
        }

        if ($login -> id) {
            Session::put('id_user', $login -> id);
            Cookie::queue('dn_user', json_encode($login), 100);
            return response('Đăng nhập thành công!');
        }
    }

    public function logout(Request $request) {
        // Logout luon
        CommonHelper::destroyCookieHome();
        return redirect()->route('homePage.home.show');
    }


    public function productDetail($id)
    {
        $get_product = Product::with('productImg')->where([
            'id' => $id
        ])->first();

        $get_product_lq = DB::table('product')->where([
            'category_id'     => $get_product->category_id,
        ])->get();


        return view('homeuser.product.detail',[
            'get_product'    => $get_product,
            'get_product_lq' => $get_product_lq
        ]);
    }


}
