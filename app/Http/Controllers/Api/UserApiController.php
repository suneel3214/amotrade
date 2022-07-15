<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\User;
use DB;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateRequest;
use App\Http\Requests\ImageValidationRequest;
use App\Http\Controllers\Classes\MsgApi;
class UserApiController extends Controller
{
    
    protected $images = [];
    public function __construct()
    {
     
    }
 
/* Dashboard*/

    public function users(Request $request)
    {
      $user = auth('api')->user();

        return response()->json([
            "success" => true,
            "message" => "User available",
            "status"  => auth('api')->user()->is_active,
            "data" => $user,
        ]);
    }



    /* Resend otp */
    public function registrationForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => "required|min:3|max:50",
            'location' => "required",
            'business_type' => "required",
            'business_name' => "required",
            'term_and_condition' => "required",
            'privacy_policy' => "required",
           
        ]);
          
        if ($validator->fails()) {
            return Response::fail($validator->errors()->first());
        }

        $user = auth('api')->user();

        $data =[
            "user_name" => $request->name,
            "location" => $request->location,
            "business_type" => $request->business_type,
            "business_name" => $request->business_name,
            "terms_check" => $request->term_and_condition,
            "status_check" => $request->privacy_policy,
            "registration" => 1
        ];

        $registration = User::where(["id" => $user->id])->update($data);

        if($registration) {
            return response()->json([
                "success" => true,
                "message" => "Registeration Successfully",
            ]);
        }
       return response()->json([
            "success" => false,
            "message" => "Unable to Register Please Try Again",
        ]);

    }




    /* Resend otp */
    public function resendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => "required|numeric|digits:10",
            'otp' => "required|numeric|digits:4",
        ]);
          
        if ($validator->fails()) {
            return Response::fail($validator->errors()->first());
        }
        $otp = "Use " . $request->otp . " as the code to verify your phone number on Vaishnav Vivah";
      (new MsgApi)->sendOtp($request->mobile, $otp);

      return Response::pass('otp sent Successfully'); 
    }

    /* Deactivate User */

    public function deactivateUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reasons' => "required",
        ]);
          
        if ($validator->fails()) {
            return Response::fail($validator->errors()->first());
        }

        $user = auth('api')->user();
          
        $user->reasons = $request->reasons;
        $user->is_active = 2;
        if($user->save()) return Response::pass("Account Deleted Successfully");

        return Response::fail("Something went wrong");
        

    }
}
