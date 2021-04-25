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
}
