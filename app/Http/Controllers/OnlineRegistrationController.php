<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OnlineRegistration;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\FileUploader;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;

class OnlineRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'registration_type'=>'required|string|in:Student,Alumni,Other',
            'full_name'=>'required|string|max:100',
            'you_are'=>'nullable|string|max:100',
            'degree'=>'nullable|string',
            'learning_stream'=>'nullable|string',
            'master_name'=>'nullable|string',
            'year'=>'nullable|string',
            'group'=>'nullable|string',
            'email'=>'required|email',
            'telephone'=>'required|string',
            'request_type'=>'required|string',
            'request_file'=>'nullable|file|mimes:jpg,jpeg,png,gif,doc,pdf,docx|max:5000',
            'message'=>'required|string|max:1000'
        ]);

        if ($request->registration_type === "Student" || $request->registration_type === "Alumni") {
            if ($request->degree == "") {
                return response()->json([
                    'field'=>"degree",
                    'msg'=>"Degree field is required",
                ], 422);
            }
        }

        if ($request->registration_type === "Other") {
            if ($request->you_are == "") {
                return response()->json([
                    'field'=>"you_are",
                    'msg'=>"You are field is required",
                ], 422);
            }
        }

        if ($validation->fails()) {
            foreach ($validation->messages()->get('*') as $key => $value) {
                $value = json_encode($value);
                $text = str_replace('["', "", $value);
                $text = str_replace('"]', "", $text);
                return response()->json([
                    'field'=>$key,
                    'msg'=>$text,
                ], 422);
            }
        }


        $file_ = NULL;
        $fileExtension = NULL;
        $location = "upload-files/files/";
        if($request->hasFile('request_file')){
            $obj_fu = new FileUploader();
            $fileName ='file-'.uniqid().mt_rand(10, 9999);
            $fileName__ = $obj_fu->fileUploader($request->file('request_file'), $fileName, $location);
            $file_ = $fileName__;
            $fileExtension = $request->file('request_file')->getClientOriginalExtension();
        }



        $obj_OR = new OnlineRegistration();
        $obj_OR->registration_type = $request->registration_type;
        $obj_OR->full_name = $request->full_name;
        $obj_OR->you_are = $request->you_are;
        $obj_OR->degree = $request->degree;
        $obj_OR->learning_stream = $request->learning_stream;
        $obj_OR->master_name = $request->master_name;
        $obj_OR->year = $request->year;
        $obj_OR->group = $request->group;
        $obj_OR->email = $request->email;
        $obj_OR->telephone = $request->telephone;
        $obj_OR->request_type = $request->request_type;
        $obj_OR->request_file = $file_;
        $obj_OR->message =  $request->message;
        $obj_OR->created_at =  Carbon::now();
        $saved = $obj_OR->save();
        $lastID = $obj_OR->id;

        $registration_type_1 = $request->registration_type;
        $full_name_1 = $request->full_name;
        $you_are_1 = $request->you_are;
        $degree_1 = $request->degree;
        $learning_stream_1 = $request->learning_stream;
        $master_name_1 = $request->master_name;
        $year_1 = $request->year;
        $group_1 = $request->group;
        $email_1 = $request->email;
        $telephone_1 = $request->telephone;
        $request_type_1 = $request->request_type;
        $message_1 = $request->message;

        if ($saved == true && is_numeric($lastID)) {
            //sent email
            $requestID_1 = mt_rand(10, 9999).$lastID;
            OnlineRegistration::where('id', $lastID)->update([
                'request_id'=>$requestID_1
            ]);

            //send email
            Mail::to([$request->email, "office@fabiz.ase.ro"])->send(new SendEmail(
                $requestID_1,
                $registration_type_1, 
                $full_name_1, 
                $you_are_1, 
                $degree_1,
                $learning_stream_1,
                $master_name_1,
                $year_1,
                $group_1,
                $email_1,
                $telephone_1,
                $request_type_1,
                $message_1,

                $file_, 
                $fileExtension
            ));

            return response()->json([
                'success'=>true,
                'msg'=>"Data Submitted Successfully."
            ], 200);
        }else{
            return response()->json('Someting went wrong...', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
