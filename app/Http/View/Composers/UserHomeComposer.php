<?php


namespace App\Http\View\Composers;


use App\Helpers\CommonHelper;
use App\Helpers\HttpRequestHelper;
//use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class UserHomeComposer
{
    public function compose(View $view)
    {
        $userHome = CommonHelper::getUserHome();

        $get_category = DB::table('category')->where([
            'status' => 1
        ])->get();

        $get_product = DB::table('product')->where([
            'status'     => 1
        ])
        ->limit(4)
        ->get();

        end:
        $view->with(['userHome' => $userHome,'get_category' => $get_category, 'get_product' => $get_product]);
    }
}
