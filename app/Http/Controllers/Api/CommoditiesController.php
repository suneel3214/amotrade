<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\User;
use App\MasterCommodity;
use App\Commodity;
use DB;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateRequest;
use App\Http\Requests\ImageValidationRequest;
use App\Http\Controllers\Classes\MsgApi;
class CommoditiesController extends Controller
{
    
    protected $images = [];
    public function __construct()
    {
     
    }
 
/* business Profile Info*/

    public function getCommodities()
    {
      $user = auth('api')->user();

      $commodity = MasterCommodity::all()->toArray();
     
      return response()->json([
        "success" => true,
        "message" => "Data Available",
        "data" => $commodity
    ]);

    }


    public function addCommodities(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'commodity_id' => "required|numeric",
            'bussiness_id' => "required|numeric",
          
        ]);
          
        if ($validator->fails()) {
            return Response::fail($validator->errors()->first());
        }

        $user = auth('api')->user();
        $d = [
            "system_comm_id" => $request->commodity_id, 
            "business_id" => $request->bussiness_id
         ];

         $chkCommodity = Commodity::where($d);
         if($chkCommodity->count() > 0  )  return Response::fail("Commodity Already Added");

         $commodity = Commodity::insert($d);
        
       $data = $chkCommodity->get()->toArray();

         if($commodity){
            return response()->json([
                "success" => true,
                "message" => "Successfully Added",
                "data" => $data
            ]);
         }
        

    }

}
