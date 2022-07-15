<?php
namespace App\Http\Controllers\Classes;

class MsgApi
{


  public function sendOtp($mobile, $msg)
  {
    $curl = curl_init();
   // $mobile = "8109973009";
    $mobile = str_replace("+91", "", $mobile); 
    //dd($mobile);
    $url = 'http://sms.bigmarkmedia.in/api/smsapi.aspx?username='.env('MSG_USERNAME').'&password='.env('MSG_PASSWORD').'&to='.$mobile.'&from='.env('MSG_SENDER_ID').'&message='. urlencode($msg);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    //dd($url);
    if ($err) {
      return "cURL Error #:" . $err;
    } else {
      return $response;
    }
    # code...
  }



}