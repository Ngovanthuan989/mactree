<?php

namespace App\Http\Controllers;

use DB;
use Cart;
use Illuminate\Http\Request;
use App\Helpers\HttpRequestHelper;
use Illuminate\Support\Facades\Redirect;
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
}
