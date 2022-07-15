<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gallery;
use Validator;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class GalleryController extends Controller
{
    public function addGalleryImage(Request $request){

        $validator = Validator::make($request->all(), [
            'image' => "required|array|max:10",
            'title' => "required",
            'description' => "required",  
        ]);
        if ($validator->fails()) {
            return Response::fail($validator->errors()->first());
        }

        if($request->hasfile('image'))
        {
           foreach($request->file('image') as $file)
           {
               $extension = $file->getClientOriginalExtension();
               $name = date( 'YmdHis' ) . random_int(10000, 99999) . '.' . $extension;
               $file->move(public_path().'/Gallery/', $name);  
               $data[] = $name;  
           }
        }
        $user = auth('api')->user();

        $file= new Gallery();
        $file->image = json_encode($data);
        $file->title = $request->input('title');
        $file->description = $request->input('description');
        $file->business_id = $user->business_id;

        $file->save();

        if($file) {
            return response()->json([
                "success" => true,
                "message" => "File Upload Successfully",
            ]);
        }
       return response()->json([
            "success" => false,
            "message" => "Failed Please Try Again",
        ]);
        
    }

    public function getGallery(){
        $galleryData = Gallery::orderBy('id','DESC')->get();
        return response()->json([
            "success" => true,
            "message" => "Gallery Images Available",
            "data" => $galleryData
        ]);
    }

    public function productGalleryUpdate(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => "required|array|max:10",
            'title' => "required",
            'description' => "required",  
        ]);
        if ($validator->fails()) {
            return Response::fail($validator->errors()->first());
        }
        $productImage = Gallery::findOrFail($request->id);
        $image = [];
        if($request->hasfile('image')){
            foreach ($request->file('image') as $images) {
                    $imageName = date('YmdHis'). random_int(10000, 99999) .'.'.$images->getClientOriginalExtension();
                    $images->move(public_path('/Gallery/'), $imageName);
                    $oldImagepath = $productImage->image;
                    Storage::delete($oldImagepath);
                    $image[] = $imageName;
                    $json_encode = json_encode($image);
                    $productImage->image = $json_encode;
                    $productImage->title = $request->input('title');
                    $productImage->description = $request->input('description');
            }
        }
             $productImage->save();
             
            if($productImage) {
                return response()->json([
                    "success" => true,
                    "message" => "Products Images Updated Successfully",
                ]);
            }
                return response()->json([
                    "success" => false,
                    "message" => "Failed Please Try Again",
            ]);

    }
}
