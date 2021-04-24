<?php


namespace App\Helpers;


use Illuminate\Support\Facades\Cookie;

class CommonHelper
{
    public static function destroyCookie() {
        Cookie::queue(Cookie::forget('logged_user'));
    }

    public static function getUserInfo() {
        $user = null;
        if(Cookie::has('logged_user')) {
            $user = json_decode(Cookie::get('logged_user'));
        }
        return $user;
    }
}
