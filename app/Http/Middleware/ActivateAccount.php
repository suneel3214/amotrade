<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


class ActivateAccount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      
        $user = auth('api')->user();

        if($user->registration != 1)  {
            return response()->json([
                "success" => true,
                "message" => "Registration Incomplete",
                "status"  => auth('api')->user()->registration,
               
            ]);
        }


        return $next($request);
    }
}
