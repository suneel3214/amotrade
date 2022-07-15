<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRegisterValidation;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationSuccessfull;
use DB;
use App\Http\Controllers\Classes\MsgApi;
use App\Http\Controllers\Classes\Firebase;
use App\Http\Requests\UpdateRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Jobs\RegistrationMail;
use App\Jobs\MobileVerification;


class AuthController extends Controller
{
    var $msg;
    protected $images = [];
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request, int $x=0)
    {
        //dd(request());
        $validator = Validator::make($request->all(), [
            'mobile_number' => "required|numeric|digits:10",
            "code" => "required",
        ]);

        if ($validator->fails()) {
            return Response::fail($validator->errors()->first());
        }

        $credentials = request(['mobile_number', 'code']);

        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return Response::fail('Invalid User');
        }
       
        return $this->respondWithToken($token, $x, $request->firebase_token );
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return Response::pass('Successfully logged out');
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, int $x = 0, $firebase_token = null)
    {
        $user = auth('api')->user();
        //if($x === 0 && $user->is_active == "0") return Response::fail("Activate Your Account from Email");
        //if($x === 0 && $user->is_active == "3") return Response::fail("Your Account has been disabled");
        
        
        
        
        /* set firebase token */
    //   if(!is_null($firebase_token)){
    //      $fb = DB::table('firebase')->where('user_id', $user->id)->first();
    //      if(is_null($fb)){
    //          DB::table('firebase')->insert(['user_id' => $user->id, 'firebase_token' => $firebase_token ]);
    //      }
    //      else{
    //          DB::table('firebase')->where(['user_id' => $user->id])->update(['firebase_token' => $firebase_token]);
    //      }

    //    }

        
       // $me = $this->me(1,$user->id);

        
         return response()->json([
            "success" => true,
            "message" => "Logged in Successfully",
            "status"  => auth('api')->user()->is_active,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'data' => auth('api')->user()
            
        ]);
    }

    /* Register User */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile_number' => "required|numeric|digits:10",
        ]);

        if ($validator->fails()) {
            return Response::fail($validator->errors()->first());
        }
          
        // file_put_contents("test.txt",json_encode($request->all())."\n",FILE_APPEND);
         //die;
   
         $otp_number = random_int(100000, 999999);
        $otp = "Use " . $otp_number . " as the code to verify your phone number on AMOT";

     $otp_number_hash = bcrypt($otp_number);
        //$data['verify_token'] = Str::random(60);
        $user = User::where([ "mobile_number" => $request->mobile_number])->count();
        if ($user == 0) :
        $user = User::insert([ "mobile_number" => $request->mobile_number, "code" => $otp_number_hash]);
        endif;

        if ($user) :
             User::where([ "mobile_number" => $request->mobile_number])->update(["code" => $otp_number_hash]);
            $user = User::where([ "mobile_number" => $request->mobile_number])->first();
        
         /* Send Registration Mail */
         //RegistrationMail::dispatch($data);

         return response()->json([
            "success" => true,
            "message" => "OTP send Successfully",
            "registration_status"  => $user->registration,
            "otp" => $otp_number,
            
        ]);
        // dd($request->mobile_number, $otp);
         /* send otp */
         //MobileVerification::dispatch($user->mobile_number, $otp);
        //return $this->login($request, 1);
        endif;

        return Response::fail("Registration Failed");
    }

/* Reset Password */
public function passwordReset(Request $request)
{
     $validator = Validator::make($request->all(), [
            'old_password' => "required",
            "new_password" => "required",
        ]);
        if ($validator->fails()) {
            return Response::fail($validator->errors()->first());
        }
        
        $user = auth('api')->user();
       // dd($request->old_password ." - ".$user->password);
        if(Hash::check($request->old_password, $user->password)){
             $user->fill([
            'password' => $request->new_password
        ])->save();
             return Response::pass("Password reset Successfull");
        }
        return Response::fail("Password reset failed");
}


/* forget password */

public function forgetPassword(Request $request)
{
    $validator = Validator::make($request->all(), [
            'mobile' => "required|numeric|digits:10"
        ]);
        if ($validator->fails()) {
            return Response::fail($validator->errors()->first());
        }

        $user = User::where('mobile', '=', $request->mobile)->first();
        if(is_null($user)) return Response::fail('User does\'nt exist');
        $password = rand(100000, 999999);  
        $user->password = $password;
        if($user->save()){
            $msg = "Your new login password is $password please change after login"; 
            MobileVerification::dispatch($user->mobile, $msg);
       
        return Response::pass("Password Sent");
        }
       return  Response::fail("Something went wrong");
}

    public function sendMail(Request $request)
    {
        $data = $request->all();
       $data['verify_token'] = Str::random(60);
        # code...
         Mail::send(new RegistrationSuccessfull($data));
    }
}