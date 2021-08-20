<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
//        $token = $request->header('token');
//        if($token != 'secret'){
//            return response()->json([
//                "error"=> "",
//                "description"=> "User Not Allowed to post or comment"
//            ],401);
//        }
        return $next($request);
    }
}
