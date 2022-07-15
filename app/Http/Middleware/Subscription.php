<?php

namespace App\Http\Middleware;

use Closure;
use App\UserSubscription;
use Illuminate\Support\Facades\Auth;

class Subscription
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
        if(!session()->has('isSubscribed')){


            UserSubscription::whereRaw('DATEDIFF(subs_end_date, CURDATE()) < 0')
                            ->where("user_id", Auth::user()->id)
                            ->update(['is_active' => 0]);

            $mysubscription = UserSubscription::selectRaw("IF(DATEDIFF(subs_end_date, CURDATE()) > 0, DATEDIFF(subs_end_date, CURDATE()), '0')  AS days_left")        
                                    ->where("user_id", Auth::user()->id)
                                    ->where("is_active", 1)
                                    ->orderBy('id', 'DESC')
                                    ->first();

              if(is_null($mysubscription)) session()->put('isSubscribed', false);
              
         elseif($mysubscription->days_left == "0") {
            session()->put('isSubscribed', false);
         }
        else  
         session()->put('isSubscribed', true);
        }
        return $next($request);
    }
}
