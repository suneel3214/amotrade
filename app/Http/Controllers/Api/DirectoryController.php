<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BusinessProfile;
use App\User;

class DirectoryController extends Controller
{
    public function directoryListing(){
        $listing = BusinessProfile::orderBy('updated_at','DESC')->paginate(20);
        // dd($listing);
        return response()->json([
            "success" => true,
            "message" => "Data Available",
            "data" => $listing
        ]);
    }

    public function directorySearch(Request $request){

        $result = User::where([['business_name' , '!=' , Null],
        [function ($query) use ($request) {
            if(($term = $request->search)){
                $query->orWhere('business_name','like','%'.$term . '%')->get();
            }
        }]
    ])->orderBy('id','desc')->get();
    
        if(count($result) > 0){
         return Response()->json($result);
        }
        else
        {
        return response()->json(['Result' => 'No Data not found'], 404);
        }
    }
}
