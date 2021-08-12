<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\OrderExportFromView;
use Maatwebsite\Excel\Facades\Excel;
use App\Helpers\HttpRequestHelper;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function index(Request $request)
    {

        $dataSearch=[];

        if($request->get('created_at_from')) {
            $createdAtFrom = date('Y-m-d', strtotime($request->get('created_at_from')));
        }

        if($request->get('created_at_to')) {
            $createdAtTo = date('Y-m-d', strtotime($request->get('created_at_to')));
        }

        if(strtotime($request->get('created_at_from')) > strtotime($request->get('created_at_to'))){
            return redirect('/order')->with('error',' Từ ngày Đến ngày không hợp lệ!');
        }
        if ($request->get('order_code')){
            $dataSearch['order_code'] = $request->get('order_code');
        }

        if ($request->get('ship_code')){
            $dataSearch['ship_code'] = $request->get('ship_code');
        }

        if ($request->get('status')){
            $dataSearch['status'] = $request->get('status');
        }

        if ($request->get('created_at_from') && $request->get('created_at_to')) {
            $get_order=Order::with(['ship','customer'])
            ->where($dataSearch)
            ->whereBetween('created_at', [$createdAtFrom, $createdAtTo])
            ->orderBy('id', 'DESC')
            ->paginate(10);

            return view('dashboard.order.show',
                [
                    'get_order' =>$get_order,
                    'created_at_from' => $request->get('created_at_from'),
                    'created_at_to' =>  $request->get('created_at_to')
                ]
            );
        }else{
            $get_order=Order::with(['ship','customer'])
            ->where($dataSearch)
            ->orderBy('id', 'DESC')
            ->paginate(10);
            return view('dashboard.order.show',
                ['get_order'=>$get_order]
            );
        }



    }

    public function export()
    {
        $get_order=Order::with(['ship','customer'])
        ->orderBy('id', 'DESC')
        ->get();

        $export = new OrderExportFromView($get_order);
        $fileName = 'DANH_SACH_DON_HANG'. '.xlsx';
        return Excel::download($export, $fileName);
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

    public function update(Request $request)
    {
        $update = Order::where('id',$request->get('id'))->update(array(
            'district_id'     => $request->get('district_id'),
            'province_id'     => $request->get('province_id'),
            'ward_id'         => $request->get('ward_id'),
            'address'         => $request->get('address'),
            'payment_methods' => $request->get('payment_methods'),
            'status'          => $request->get('status'),
            'ship_id'         => $request->get('ship_id'),
            'ship_fee'        => $request->get('ship_fee'),
        ));
        if ($update==1) {
            return response('Cập nhập đơn hàng thành công!');
        }else{
            return response('Cập nhập đơn hàng không thành công!',400);
        }
    }
    public function shipFee(Request $request)
    {
        $dataHeader = [];
        $dataHeader[] = 'Content-type:application/json';
        $dataHeader[] = 'Token: ffdccdf1-fcae-11ea-a4d7-f63a98a5d75d';

        $apiUrl = 'https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee';

        $data = '{"service_type_id":2,"to_district_id":'.$request->get('district_id').',"to_ward_code":"'.$request->get('ward_id').'","weight": 200}';

        $callApiGhn = HttpRequestHelper::callApi($data, $apiUrl, $dataHeader);

        if ($callApiGhn->code == 200) {
            return response($callApiGhn->data->total);
        }else{
            return response('Có lỗi xảy ra khi tính phí ship',400);
        }

    }

    public function createShip(Request $request)
    {
        $product = DB::table('product')->where([
            'id'=> $request->get('id_product')
        ])->first();

        $dataHeader = [];
        $dataHeader[] = 'Content-type:application/json';
        $dataHeader[] = 'Token: ffdccdf1-fcae-11ea-a4d7-f63a98a5d75d';

        $apiUrl = 'https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/create';

        $data = '{"payment_type_id": 2,"note":"Giao hàng cho '.$request->get('customer_name').'","required_note":"KHONGCHOXEMHANG","to_name":"'.$request->get('customer_name').'","to_phone": "'.$request->get('customer_phone').'","to_address": "'.$request->get('address').'","to_ward_code": "'.$request->get('ward_id').'","to_district_id": '.$request->get('district_id').',"cod_amount":0,"content": "Được kiểm tra hàng","weight": 200,"length": 15,"width": 15,"height": 15,"pick_station_id": 0,"deliver_station_id": 0,"insurance_value": 0,"service_id": 0,"service_type_id":2,"items":[{"name":"'.$product->product_name.'","code":"'.$product->product_code.'","quantity":'.$request->get('product_quantity').'}]}';

        $callApiGhn = HttpRequestHelper::callApi($data, $apiUrl, $dataHeader);

        if ($callApiGhn->code == 200) {
            $update = Order::where('id',$request->get('id'))->update(array(
                'district_id'     => $request->get('district_id'),
                'province_id'     => $request->get('province_id'),
                'ward_id'         => $request->get('ward_id'),
                'address'         => $request->get('address'),
                'payment_methods' => $request->get('payment_methods'),
                'status'          => 3,
                'ship_id'         => $request->get('ship_id'),
                'ship_fee'        => $request->get('ship_fee'),
                'ship_code'       => $callApiGhn->data->order_code,
            ));
            if($update==1){
                return response('Tạo vận đơn thành công');
            }
        }else{
            return response('Có lỗi xảy ra khi tạo vận đơn',400);
        }
    }

    public function cancelShip(Request $request)
    {
        $dataHeader = [];
        $dataHeader[] = 'Content-type:application/json';
        $dataHeader[] = 'Token: ffdccdf1-fcae-11ea-a4d7-f63a98a5d75d';

        $apiUrl = 'https://online-gateway.ghn.vn/shiip/public-api/v2/switch-status/cancel';

        $data = '{"order_codes":["'.$request->get('order_codes').'"]}';

        $callApiGhn = HttpRequestHelper::callApi($data, $apiUrl, $dataHeader);

        if ($callApiGhn->code == 200) {
            $update = Order::where('id',$request->get('id'))->update(array(
                'status'          => 0,
                'ship_fee'        => 0,
                'ship_code'       => "",
            ));
            if($update==1){
                return response('Huỷ vận đơn thành công');
            }
        }else{
            return response('Có lỗi xảy ra khi tạo vận đơn',400);
        }
    }
}
