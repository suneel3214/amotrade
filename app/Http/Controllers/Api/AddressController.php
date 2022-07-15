<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Address;
use Validator;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function newAddress(Request $request){
        
        $data = $request->all();
        $validator = Validator::make($request->all(), [
            'type' => "required",
            'city' => "required",
            'address' => "required",

        ]);

        if ($validator->fails()) {
            return Response::fail($validator->errors()->first());
        }
        // dd($data);
        $user = auth('api')->user();
        $data['business_id'] = $user->business_id;
        $add = Address::create($data);
        if($add) {
            return response()->json([
                "success" => true,
                "message" => "New Address Added Successfully",
            ]);
        }
       return response()->json([
            "success" => false,
            "message" => "Failed Please Try Again",
        ]);
    }

    public function updateAddress(Request $request){
        $validator = Validator::make($request->all(), [
            'type' => "required",
            'city' => "required",
            'address' => "required",

        ]);

        if ($validator->fails()) {
            return Response::fail($validator->errors()->first());
        }
        $address = Address::find($request->id);
        $address->type = $request->input('type');
        $address->city = $request->input('city');
        $address->address = $request->input('address');

        $address->update();

        if($address) {
            return response()->json([
                "success" => true,
                "message" => "Address Updated Successfully",
            ]);
        }
       return response()->json([
            "success" => false,
            "message" => "Failed Please Try Again",
        ]);

    }
}
