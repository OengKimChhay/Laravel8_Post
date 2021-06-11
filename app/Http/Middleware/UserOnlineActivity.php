<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use Auth;
use Cache;
use Carbon\Carbon;

class UserOnlineActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next){   
        if(Auth::check()){
            $expireTime = Carbon::now()->addMinute(1); // keep online for 1 min after user logout
            Cache::put('user_online'.Auth::user()->id, true, $expireTime);
        }
        return $next($request);
    }
}
