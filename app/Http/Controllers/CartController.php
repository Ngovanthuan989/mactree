<?php

namespace App\Http\Controllers;

use DB;
use Cart;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Helpers\HttpRequestHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
session_start();


class CartController extends Controller
{
    //

    public function save(Request $request)
    {
        $productId = $request->productId_hidden;
        $quantity = $request->qty;

        $product_info = DB::table('product')->where('id',$productId)->first();

        $data['id']               = $product_info->id;
        $data['qty']              = $quantity;
        $data['name']             = $product_info->product_name;
        $data['price']            = $product_info->price_sale;
        $data['weight']           = '123';
        $data['size']             = 'XL';
        $data['options']['image'] = $product_info->product_img;

        Cart::add($data);
        return Redirect::to('/home/show-cart');
    }

    public function index()
    {
        return view('homeuser.cart.index');
    }

    public function delete(Request $request)
    {
        $rowId = $request->get('id');
        Cart::update($rowId,0);

        return response('Xoá thành công!');
    }

    public function update(Request $request)
    {
       $rowId = $request->get('id');
       $qty   = $request->get('qty');

       Cart::update($rowId,$qty);
       return response('Cập nhập thành công!');
    }

    public function checkout()
    {
        $dataHeader = [];
        $dataHeader[] = 'Content-type:application/json';
        $dataHeader[] = 'Token: ffdccdf1-fcae-11ea-a4d7-f63a98a5d75d';

        $apiUrl = 'https://online-gateway.ghn.vn/shiip/public-api/master-data/province';

        $callApiGhn = HttpRequestHelper::callApi('', $apiUrl, $dataHeader);

        $get_pay=DB::table('pay')->where([
            'status'     =>  1
        ])->get();

        if ($callApiGhn->code == 200) {
            $data_province = $callApiGhn->data;
            return view('homeuser.cart.checkout',[
                'data_province' => $data_province,
                'get_pay'       => $get_pay
            ]);

        }else{
            return redirect()->route('homePage.home.show')->with('error','Không lấy được địa chỉ!');
        }
    }

    public function addOrder(Request $request)
    {
        if (!$request->get('province')) {
            return response('Xin vui lòng chọn thành phố nhận hàng',400);
        }
        if (!$request->get('district')) {
            return response('Xin vui lòng chọn quận huyện nhận hàng',400);
        }
        if (!$request->get('ward')) {
            return response('Xin vui lòng chọn phường xã nhận hàng',400);
        }
        if (!$request->get('address')) {
            return response('Xin vui lòng nhập địa chỉ cụ thể để nhận hàng',400);
        }
        if (!$request->get('payment_methods')) {
            return response('Xin vui lòng chọn phương thức thanh toán',400);
        }

        $validator = Validator::make($request->all(), [
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ], [
            'phone.regex'    => 'Số điện thoại không đúng định dạng',
            'phone.required' => 'Số điện thoại không được để trống',
        ]);

        if ($validator->fails()) {
            return response($validator->errors()->first(), 400);
        }


        $user_id = Session::get('id_user');

        // insert order
        $order_data =array();

        $order_data['order_code']      = mt_rand(1000,9999);;
        $order_data['customer_id']     = $user_id;
        $order_data['province_id']     = $request->get('province');
        $order_data['district_id']     = $request->get('district');
        $order_data['ward_id']         = $request->get('ward');
        $order_data['address']         = $request->get('address');
        $order_data['phone']           = $request->get('phone');
        $order_data['payment_methods'] = $request->get('payment_methods');
        $order_data['status']          = 1;
        $order_data['total_money']     = Cart::subtotal();
        $order_data['created_at']      = date('Y-m-d 00:00:00', strtotime(' -0 days'));
        $order_data['updated_at']      = date('Y-m-d 00:00:00', strtotime(' -0 days'));

        $order_id =Order::insertGetId($order_data);

        //insert order_details
        $content =Cart::content();

        foreach ($content as $v_content) {

            $order_p_data =array();
            $order_p_data['order_id']         = $order_id;
            $order_p_data['product_id']       = $v_content->id;
            $order_p_data['product_name']     = $v_content->name;
            $order_p_data['product_price']    = $v_content->price;
            $order_p_data['product_quantity'] = $v_content->qty;
            $order_p_data['created_at']       = date('Y-m-d 00:00:00', strtotime(' -0 days'));
            $order_p_data['updated_at']       = date('Y-m-d 00:00:00', strtotime(' -0 days'));

            $order_product = OrderProduct::insertGetId($order_p_data);
        }

        if($order_id && $order_product){
            // Thanh toán rồi sẽ hủy phiên mua
            Cart::destroy();
            return response('Đã đặt hàng thành công');
        }else{
            return response('Có lỗi xảy ra khi đặt hàng vui lòng liên hệ shop!');
        }


    }
}
