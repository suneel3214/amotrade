<?php

namespace App\Http\Controllers\Api;
use App\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\BusinessProfile;
use App\User;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BusinessProfileController extends Controller
{
    public function docBusinessPro(Request $request){
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'doc_type' => "required",
            'doc_id' => "required|max:12",
            // 'image' => "required|max:10240|mimes:jpg,png,pdf",
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
                $file->move(public_path().'/Document/', $name);  
                $data[] = $name;  
            }
            }
            $user = auth('api')->user();

            $file= new Document();
            $file->image = json_encode($data);
            $file->doc_type = $request->input('doc_type');
            $file->doc_id = $request->input('doc_id');
            $file->business_id = $user->business_id;

            $file->save();

            if($file) {
                return response()->json([
                    "success" => true,
                    "message" => "Document Uploaded Successfully",
                ]);
            }
                return response()->json([
                    "success" => false,
                    "message" => "Failed Please Try Again",
            ]);

    }

    public function docUpdate(Request $request){
        $document = Document::findOrFail($request->id);
        $image = [];
        if($request->hasfile('image')){
            foreach ($request->file('image') as $images) {
                    $imageName = date('YmdHis'). random_int(10000, 99999) .'.'.$images->getClientOriginalExtension();
                    $images->move(public_path('/Document/'), $imageName);
                    $oldImagepath = $document->image;
                    Storage::delete($oldImagepath);
                    $image[] = $imageName;
                    $json_encode = json_encode($image);
                    $document->image = $json_encode;
                    $document->doc_type = $request->input('doc_type');
                    $document->doc_id = $request->input('doc_id');
            }
        }
             $document->save();
             
            if($document) {
                return response()->json([
                    "success" => true,
                    "message" => "Document Update Successfully",
                ]);
            }
                return response()->json([
                    "success" => false,
                    "message" => "Failed Please Try Again",
            ]);

    }

    public function profileEdit($id){
       $data = BusinessProfile::with('businessPro')->where('id',$id)->first();
       return $data;
    }

    public function profileUpdate(Request $request){
    
            $data = BusinessProfile::find($request->id);
            // dd($data->verification_status);

            if($data->verification_status === "Approved" ){
                $validator = Validator::make($request->all(), [
                    'business_sub_type' => "required",
                    'contact_person' => "required",
                ]);
                if ($validator->fails()) {
                    return Response::fail($validator->errors()->first());
                }
                $data->business_sub_type =  $request->business_sub_type;
                $data->contact_person = $request->contact_person;
            }
            else{
                 $validator = Validator::make($request->all(), [
                'business_sub_type' => "required",
                'contact_person' => "required",
                'business_type' => "required",
                'business_name' => "required|min:3|max:50",
                'location' => "required",
            ]);
            if ($validator->fails()) {
                return Response::fail($validator->errors()->first());
            }
                $data->business_sub_type =  $request->business_sub_type;
                $data->contact_person = $request->contact_person;
                $data->businessPro->business_type =  $request->business_type;
                $data->businessPro->business_name = $request->business_name;
                $data->businessPro->location = $request->location;
            }
            // dd($data);
            $data->push();

            if($data) {
                return response()->json([
                    "success" => true,
                    "message" => "Updated Successfully",
                ]);
            }
           return response()->json([
                "success" => false,
                "message" => "Failed Please Try Again",
            ]);
        }

        public function about_bussiness_edit($id){
            $data = BusinessProfile::select('establishment','nature_of_business','employees_number','turnover',
            'bio')->where('id',$id)->first();
            return $data;
        }

        public function aboutUpdate(Request $request){
            // dd($request->all());
             $validator = Validator::make($request->all(), [
                'establishment' => "required",
                'nature_of_business' => "required",
                'employees_number' => "required",
                'turnover' => "required",
                'bio' => "required",

            ]);
            if ($validator->fails()) {
                return Response::fail($validator->errors()->first());
            }
            $about = BusinessProfile::where('id',$request->id)->first();
            $about->establishment = $request->input('establishment');
            $about->nature_of_business = $request->input('nature_of_business');
            $about->employees_number = $request->input('employees_number');
            $about->turnover = $request->input('turnover');
            $about->bio = $request->input('bio');
            $about->update();

            if($about) {
                return response()->json([
                    "success" => true,
                    "message" => "Updated Successfully",
                ]);
            }
           return response()->json([
                "success" => false,
                "message" => "Failed Please Try Again",
            ]);
        }

        public function contactUpdate(Request $request){
            $validator = Validator::make($request->all(), [
                'email' => "required|email",
                'website' => "required",
                'number' => "required|numeric|digits:10",
            ]);
            if ($validator->fails()) {
                return Response::fail($validator->errors()->first());
            }

            $contact = BusinessProfile::find($request->id);
            $contact->email =  $request->email;
            $contact->website = $request->website;
            // dd($data);
            $contact->push();

            $user = auth('api')->user();

            foreach ($request->number as $key=> $number) {
                $saveRecord = [
                  'number' => $request->number[$key],
                  'business_id' => $user->business_id,
                  'type' => 'Alternate Number',
                  'is_visible' => $request->is_visible,
                ];
                DB::table('mobile_numbers')->insert($saveRecord);
            }

            if($contact) {
                return response()->json([
                    "success" => true,
                    "message" => "Contact Details Updated Successfully",
                ]);
            }
           return response()->json([
                "success" => false,
                "message" => "Failed Please Try Again",
            ]);
        }
}
 