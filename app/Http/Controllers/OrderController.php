<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\HttpRequestHelper;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function index()
    {
        $get_order=Order::with(['ship','customer'])->get();

        return view('dashboard.order.show',
            ['get_order'=>$get_order]
        );
    }
    public function edit($id)
    {
        $get_order=Order::with(['ship','customer'])->where([
            'order_code'=> $id
        ])->first();

        $get_order_product=OrderProduct::with(['product'])->where([
            'order_id'=> $get_order->id
        ])->get();

        $get_pay = DB::table('pay')->where([
            'status'=> 1
        ])->get();

        $get_ship=DB::table('shipping')->where([
            'status'=> 1
        ])->get();

        $dataHeader = [];
        $dataHeader[] = 'Content-type:application/json';
        $dataHeader[] = 'Token: ffdccdf1-fcae-11ea-a4d7-f63a98a5d75d';

        $apiUrl = 'https://online-gateway.ghn.vn/shiip/public-api/master-data/province';

        $callApiGhn = HttpRequestHelper::callApi('', $apiUrl, $dataHeader);

        if ($callApiGhn->code == 200) {
            $data_province = $callApiGhn->data;
        }else{
            return redirect()->route('dashboard.order.show')->with('error','Không lấy được địa chỉ!');
        }

        $data = '{
            "province_id":'.$get_order->province_id.'
        }';

        $apiUrlDistrict = 'https://online-gateway.ghn.vn/shiip/public-api/master-data/district';

        $callApiGhnDistrict = HttpRequestHelper::callApi($data, $apiUrlDistrict,$dataHeader);

        if ($callApiGhnDistrict->code == 200) {
            $data_district = $callApiGhnDistrict->data;
        }else{
            return redirect()->route('dashboard.order.show')->with('error','Không lấy được địa chỉ!');
        }


        $dataWard = '{
            "district_id":'.$get_order->district_id.'
        }';

        $apiUrlWard = 'https://online-gateway.ghn.vn/shiip/public-api/master-data/ward';

        $callApiGhnWard = HttpRequestHelper::callApi($dataWard, $apiUrlWard,$dataHeader);

        if ($callApiGhnWard->code == 200) {
            $data_ward = $callApiGhnWard->data;
            // $html='';
            // foreach($data_ward as $index){
            //   $html .= "<li data-value=".$index->WardCode." class='option'>$index->WardName</li>";
            // }
            // return $html;

        }else{
            return redirect()->route('dashboard.order.show')->with('error','Không lấy được địa chỉ!');
        }

        return view('dashboard.order.edit',[
            'get_pay'           => $get_pay,
            'get_ship'          => $get_ship,
            'get_order'         => $get_order,
            'get_order_product' => $get_order_product,
            'data_province'     => $data_province,
            'data_district'     => $data_district,
            'data_ward'         => $data_ward
        ]);
    }
}
