<?php
use Carbon\Carbon;


function setFile($current_user)
{
  return  id($current_user->id).md5(id($current_user->id)."-".$current_user->dob);
}

function profile_completion($me)
{
    $x = $me->toArray();
    $remaining_fields = $total_fields = 0;
   // wasRecentlyCreated
      foreach ($x as  $key => $value) {
          if($value === "" || is_null($value)){
             // dd($key);
             $remaining_fields++;
          }
          $total_fields++;
      }


      return (int)(100 - round(($remaining_fields/$total_fields)*100));
}

function id($uid){
     $id = "";
     $prefix = "VVMM";
    if($uid < 9) $id = $prefix."-00$uid";
    else if($uid > 9 && $uid < 99) $id = $prefix."-0$uid";
    else  $id = $prefix."-$uid";

    return $id;
}


/* function subscription(){

 $mysubscription = \App\UserSubscription::select("p.name", 
                                                    "p.description", "p.duration", 
                                                    "p.duration_type", "p.price", 
                                                    "user_subscription.*")
                                    ->selectRaw("IF(DATEDIFF(user_subscription.subs_end_date, CURDATE()) > 0, DATEDIFF(user_subscription.subs_end_date, CURDATE()), '0')  AS days_left")        
                                    ->where("user_id", auth()->user()->id)
                                    ->join("packages as p", "user_subscription.package_id", "p.id")
                                    ->orderBy('id', 'DESC')
                                    ->first();

              if(is_null($mysubscription)) return true;
              
          if($mysubscription->days_left == "0") return true;
          
          return false;


} */
function isSubscribed(){



return session('isSubscribed');


}


function today($format = null)
{
    $format = $format ? $format : 'Y-m-d H:i:s';
    return Carbon::today()->format($format);
}
function tomorrow($format = null)
{
    $format = $format ? $format : 'Y-m-d H:i:s';
    return Carbon::tomorrow()->format($format);
}
function yesterday($format = null)
{
    $format = $format ? $format : 'Y-m-d H:i:s';
    return Carbon::yesterday()->format($format);
}
function nextDay($datetime = null, $day, $format = null)
{
    $day = strtoupper($day);
    $format = $format ? $format : 'Y-m-d H:i:s';
    $datetime = $datetime ? $datetime : Carbon::now();
    $days = ['SUNDAY' => Carbon::SUNDAY, 'MONDAY' => Carbon::MONDAY, 'TUESDAY' => Carbon::TUESDAY, 'WEDNESDAY' => Carbon::WEDNESDAY, 'THURSDAY' => Carbon::THURSDAY, 'FRIDAY' => Carbon::FRIDAY, 'SATURDAY' => Carbon::SATURDAY];
    return Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->next($days[$day])->format($format);
}
function dayOfWeek($datetime = null)
{
    $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    $datetime = $datetime ? $datetime : Carbon::now();
    return $days[Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->dayOfWeek];
}
function ukDate($datetime = null, $timestamp = false)
{
    $datetime = $datetime ? $datetime : Carbon::now();
    $timestamp = $timestamp ? 'd/m/Y H:ia' : 'd/m/Y';
    return Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->format($timestamp);
}
function ukDateToDate($datetime = null, $timestamp = false)
{
    $datetime = $datetime ? $datetime : Carbon::now();
    $format = $timestamp ? 'd/m/Y H:i:s' : 'd/m/Y';
    $timestamp = $timestamp ? 'Y-m-d H:i:s' : 'Y-m-d';
    return Carbon::createFromFormat($format, $datetime)->format($timestamp);
}
function humanDate($datetime)
{
    return Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->diffForHumans();
}
function age($datetime)
{
    return Carbon::createFromFormat('Y-m-d', $datetime)->age;
}
function weekend($datetime = null)
{
    $datetime = $datetime ? $datetime : Carbon::now();
    return Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->isWeekend();
}
function diffInDays($datetime)
{
    return Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->diffInDays();
}
function addYears($datetime = null, $years, $format = null)
{
    $format = $format ? $format : 'Y-m-d H:i:s';
    $datetime = $datetime ? $datetime : Carbon::now();
    return Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->addYears($years)->format($format);
}
function addMonths($datetime = null, $months, $format = null)
{
    $format = $format ? $format : 'Y-m-d H:i:s';
    $datetime = $datetime ? $datetime : Carbon::now();
    return Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->addMonths($months)->format($format);
}
function addWeeks($datetime = null, $weeks, $format = null)
{
    $format = $format ? $format : 'Y-m-d H:i:s';
    $datetime = $datetime ? $datetime : Carbon::now();
    return Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->addWeeks($weeks)->format($format);
}
function addDays($datetime = null, $days, $format = null)
{
    $format = $format ? $format : 'Y-m-d H:i:s';
    $datetime = $datetime ? $datetime : Carbon::now();
    return Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->addDays($days)->format($format);
}
function startOfDay($datetime = null, $format = null)
{
    $format = $format ? $format : 'Y-m-d H:i:s';
    $datetime = $datetime ? $datetime : Carbon::now();
    return Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->startOfDay()->format($format);
}
function endOfDay($datetime = null, $format = null)
{
    $format = $format ? $format : 'Y-m-d H:i:s';
    $datetime = $datetime ? $datetime : Carbon::now();
    return Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->endOfDay()->format($format);
}
function startOfWeek($datetime = null, $format = null)
{
    $format = $format ? $format : 'Y-m-d H:i:s';
    $datetime = $datetime ? $datetime : Carbon::now();
    return Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->startOfWeek()->format($format);
}
function endOfWeek($datetime = null, $format = null)
{
    $format = $format ? $format : 'Y-m-d H:i:s';
    $datetime = $datetime ? $datetime : Carbon::now();
    return Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->endOfWeek()->format($format);
}
function startOfMonth($datetime = null, $format = null)
{
    $format = $format ? $format : 'Y-m-d H:i:s';
    $datetime = $datetime ? $datetime : Carbon::now();
    return Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->startOfMonth()->format($format);
}
function endOfMonth($datetime = null, $format = null)
{
    $format = $format ? $format : 'Y-m-d H:i:s';
    $datetime = $datetime ? $datetime : Carbon::now();
    return Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->endOfMonth()->format($format);
}
function startOfYear($datetime = null, $format = null)
{
    $format = $format ? $format : 'Y-m-d H:i:s';
    $datetime = $datetime ? $datetime : Carbon::now();
    return Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->startOfYear()->format($format);
}
function endOfYear($datetime = null, $format = null)
{
    $format = $format ? $format : 'Y-m-d H:i:s';
    $datetime = $datetime ? $datetime : Carbon::now();
    return Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->endOfYear()->format($format);
}
function startOfDecade($datetime = null, $format = null)
{
    $format = $format ? $format : 'Y-m-d H:i:s';
    $datetime = $datetime ? $datetime : Carbon::now();
    return Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->startOfDecade()->format($format);
}
function endOfDecade($datetime = null, $format = null)
{
    $format = $format ? $format : 'Y-m-d H:i:s';
    $datetime = $datetime ? $datetime : Carbon::now();
    return Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->endOfDecade()->format($format);
}
function startOfCentury($datetime = null, $format = null)
{
    $format = $format ? $format : 'Y-m-d H:i:s';
    $datetime = $datetime ? $datetime : Carbon::now();
    return Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->startOfCentury()->format($format);
}
function endOfCentury($datetime = null, $format = null)
{
    $format = $format ? $format : 'Y-m-d H:i:s';
    $datetime = $datetime ? $datetime : Carbon::now();
    return Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->endOfCentury()->format($format);
}
