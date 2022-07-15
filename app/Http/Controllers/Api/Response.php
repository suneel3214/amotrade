<?php

namespace App\Http\Controllers\Api;

class Response
{

   

    public static function fail(string $message)
    {  $status = "";
          if($user = auth('api')->user())
                {
                    $status = $user->is_active;
        }

       // die('hi');
        return response()->json([
            "success" => false,
            "message" => $message,
            "status" =>  (string)$status
        ]);
        # code...
    }

    public static function pass(string $message, $data = null)
    { 
         //$status ="";
        //   if($user = auth('api')->user())
        //         {
        //             $status = $user->is_active;
        //             if($status == "2")  return Response::fail("Account has been Deleted");
        //             if($status == "3") return Response::fail("Account has been Deactivated By Admin");
        //             if($status == "0") return Response::fail("Account is not Activated");
        // }
        
        $response = [
            "success" => true,
            "message" => $message,
        ];

        if (!is_null($data)) $response['data'] = $data;
        return response()->json($response);

    }


}