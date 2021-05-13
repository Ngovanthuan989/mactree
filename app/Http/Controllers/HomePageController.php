<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Helpers\HttpRequestHelper;
use Illuminate\Http\Request;

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
        dd($request->all());
    }


}
