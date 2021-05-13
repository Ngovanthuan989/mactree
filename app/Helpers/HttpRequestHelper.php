<?php


namespace App\Helpers;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class HttpRequestHelper
{
    public static function callApi($data, $apiUrl, $header = [], $method = 'post', $responseType = 0, $timeOut = 90) {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $apiUrl);
            curl_setopt($ch, CURLOPT_POST, 1);
            if($method == 'post') {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            } else if($method == 'put') {
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                }
            } else if($method == 'get') {
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            }
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeOut);
            curl_setopt($ch, CURLOPT_TIMEOUT, $timeOut);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($ch);

            if(!empty($result)) {
                $responseBody = json_decode($result, $responseType);
            } else {
                $responseBody = null;
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage() . '-' . $e->getFile() . '-' . $e->getLine());
            $responseBody = null;
        }
        return $responseBody;
    }



    // public static function callApiGHN($data, $apiUrl) {
    //     try {
    //         $curl = curl_init();
    //         curl_setopt_array($curl, array(
    //         CURLOPT_URL => $apiUrl,
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'GET',
    //         CURLOPT_POSTFIELDS => $data,
    //         CURLOPT_HTTPHEADER => array(
    //             'Token: ffdccdf1-fcae-11ea-a4d7-f63a98a5d75d',
    //             'Content-Type: application/json'
    //         ),
    //         ));

    //         $result = curl_exec($curl);

    //         if(!empty($result)) {
    //             $responseBody = json_decode($result);
    //         } else {
    //             $responseBody = null;
    //         }
    //     } catch (\Exception $e) {
    //         Log::info($e->getMessage() . '-' . $e->getFile() . '-' . $e->getLine());
    //         $responseBody = null;
    //     }
    //     return $responseBody;
    // }
}
