<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\User;
use App\BusinessProfile;
use DB;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateRequest;
use App\Http\Requests\ImageValidationRequest;
use App\Http\Controllers\Classes\MsgApi;
class UserProfileController extends Controller
{
    
    protected $images = [];
    public function __construct()
    {
     
    }
 
/* business Profile Info*/

    public function businessProfileInfo()
    {
      $user = auth('api')->user();

      $user = User::where("id", $user->id)->first();

        return response()->json([
            "success" => true,
            "message" => "data Available",
            "data" => $user,
        ]);
    }



    /* business Profile*/
    public function businessProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'business_name' => "required|min:3|max:50",
            'business_type' => "required",
            'business_sub_type' => "required",
            'location' => "required",
            'user_name' => "required",
            'designation' => "required",
           
        ]);
          
        if ($validator->fails()) {
            return Response::fail($validator->errors()->first());
        }

        $user = auth('api')->user();

        $data =[
            "business_name" => $request->business_name,
            "business_type" => $request->business_type,
            "location" => $request->location,
            "user_name" => $request->user_name,
            "designation" => $request->designation,
        ];
        $profile_data =[ "business_sub_type" => $request->business_sub_type ];

        $chk = BusinessProfile::where(["user_id" => $user->id])->count();
        User::where("id", $user->id)->update($data);

        if($chk > 0 ){
            $business_profile = BusinessProfile::where(["id" => $user->id])->update($profile_data);
            $business_profile = true;
        }else {
            $profile_data["user_id"] = $user->id;
            $profile_data["verification_status"] = "Applied";
            $business_profile = BusinessProfile::insert($profile_data);
        }
        $businessId = BusinessProfile::where('user_id',$request->user()->id)->first();
        // dd($businessId->id);
        
        $bId = User::find($user->id);
        $bId->business_id = $businessId->id;
        $bId->save();
        if($business_profile) {
            return response()->json([
                "success" => true,
                "message" => "Business Profile Successfully Created",
            ]);
        }
       return response()->json([
            "success" => false,
            "message" => "Unable to create Business Profile Please Try Again",
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
