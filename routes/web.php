<?php

use App\Mail\RegistrationSuccessfull;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Jobs\RegistrationMail;
use App\Jobs\MobileVerification;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
 
 
 Route::get('/clear-cache', function() {
    $output = new \Symfony\Component\Console\Output\BufferedOutput;
    \Artisan::call('cache:clear', $output);
    dd($output->fetch());
});

Route::get("/", function () {
       
    return view('welcome');
});
//Auth::routes();



Route::get('/previewmail', function () {
    $user = \App\User::find('915');
    $data = $user->toArray();
    $data['verify_token'] = "";
    return (new RegistrationSuccessfull($data))->render();
});

//Admin  Routes...





        // /*forget password */
        // Route::post('forget-password', 'Front\ManageController@forgetPassword');
        

        Route::get('send', function(){
            
            if(request()->query('send') == null) die("denied");
            $user = \App\User::find('2');
            $data = $user->toArray();

            $otp = "Use " . rand(0000,9999) . " as the code to verify your phone number on amotrade";
            $data['verify_token'] = Str::random(60);
            
            RegistrationMail::dispatch($data);
          
            $random = mt_rand(1111,9999);
                $otp = "Use " . $random . " as the code to verify your phone number on amotrade";
                 /* send otp */
                // MobileVerification::dispatch($user->mobile, $otp); 
              // dispatch(new MobileVerification($user->mobile, $otp));

        });


