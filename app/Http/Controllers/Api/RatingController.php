<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rating;
use Validator;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function ratingAdd(Request $request){
        $data = $request->all();
        //  dd($data);
        $validator = Validator::make($request->all(), [
            'rating' => "required",
            'comment' => "required",

        ]);

        if ($validator->fails()) {
            return Response::fail($validator->errors()->first());
        }
        $user = auth('api')->user();
        $data['user_id'] = $user->id;
        $data['business_id'] = $user->business_id;

        $rate = Rating::create($data);

        if($rate){
            return response()->json([
                "success" => true,
                "message" => "Thanks For Rating..",
            ]);
        }
            return response()->json([
            "success" => false,
            "message" => "Failed Please Try Again !",
        ]);
    }
}
