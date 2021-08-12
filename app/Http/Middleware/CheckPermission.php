<?php

namespace App\Http\Middleware;
use App\Helpers\CommonHelper;

use Closure;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = CommonHelper::getUserInfo();
        if(!$user) {
            return redirect('/');
        }
        if($user->permission == 1) {
            return $next($request);
        } else {
            return redirect('/');
        }
    }
}
