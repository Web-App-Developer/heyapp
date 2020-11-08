<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\OnlineRegistration;
use Carbon\Carbon;
use Auth;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\FileUploader;
use App\Mail\ReplyEmail;

class AdminController extends Controller
{
    //inbox
    public function inbox(){
        $data = OnlineRegistration::where('status', 'New')
                    ->with('get_transfer_by')
                    ->orderBy('registration_type', 'DESC')
                    ->paginate(15);
        $pageTitle = "Inbox";
        $admins = User::where('id', '!=', Auth::user()->id)->orderBy('name', 'ASC')->get();
        return view('BackendViews.Admin.Pages.data-list', compact('data', 'pageTitle', 'admins'));
    }

    //in_progress
    public function in_progress(){
        $data = OnlineRegistration::where('status', 'In progress')
                    ->with('get_transfer_by')
                    ->orderBy('registration_type', 'DESC')
                    ->paginate(15);
        $pageTitle = "In progress";
        $admins = User::where('id', '!=', Auth::user()->id)->orderBy('name', 'ASC')->get();
        return view('BackendViews.Admin.Pages.data-list', compact('data', 'pageTitle', 'admins'));
    }

    //get_solved
    public function get_solved(){
        $data = OnlineRegistration::where('status', 'Solved')
                    ->with('get_transfer_by')
                    ->orderBy('registration_type', 'DESC')
                    ->paginate(15);
        $pageTitle = "Solved";
        $admins = User::where('id', '!=', Auth::user()->id)->orderBy('name', 'ASC')->get();
        return view('BackendViews.Admin.Pages.data-list', compact('data', 'pageTitle', 'admins'));
    }

    //get_solved
    public function get_trash(){
        $data = OnlineRegistration::where('status', 'Trash')
                    ->with('get_transfer_by')
                    ->orderBy('registration_type', 'DESC')
                    ->paginate(15);
        $pageTitle = "Trash";
        $admins = User::where('id', '!=', Auth::user()->id)->orderBy('name', 'ASC')->get();
        return view('BackendViews.Admin.Pages.data-list', compact('data', 'pageTitle', 'admins'));
    }

    //move to
    public function move__to(Request $request, $id){
        $this->validate($request, [
            'move_to'=>'required|string|in:In progress,Solved,Trash,Delete',
            'transfer_by'=>'required'
        ]);

        $transfer_by = NULL;
        if ($request->transfer_by === "Self") {
            $transfer_by = Auth::user()->id;
        }else{
            $transfer_by = $request->transfer_by;
        }

        if (!User::where('id', $transfer_by)->exists()) {
           return redirect()->back()->with('error', 'Invalid Transferer.');
        }

        if ($request->move_to === "Delete") {
            $oldData = OnlineRegistration::where('id', $id)->first();
            if (!$oldData) {
                return redirect()->back()->with('error', 'Data Not Found');
            }
            $obj_fu = new FileUploader();
            $location = "upload-files/files/";
            if ($oldData->request_file !== NULL) {
                $file_name = $oldData->request_file;
                $obj_fu->deleteFile($file_name, $location);
            }

            $oldData->forceDelete();
            return redirect()->back()->with('success', 'Record Deleted.');
        }

        $updated = OnlineRegistration::where('id', $id)->update([
            'status'=>$request->move_to,
            'transfer_by'=>$transfer_by,
            'updated_at'=>Carbon::now()
        ]);

        if ($updated == true) {
            return redirect()->back()->with('success', 'Iteam moved to '.$request->move_to);
        }else{
            return redirect()->back()->with('error', 'SORRY - Something worng.');
        }
        
    }



    public function view_file($id, $fileName){
        $data = OnlineRegistration::where([
            'id'=>$id,
        ])->first();

        if ($data) {
            $filePath = getcwd().'/upload-files/files/'.$fileName;
            if(file_exists($filePath)){
                return response()->file($filePath );
            }else{
                return abort(404);
            }
            
        }else{
            return abort(404);
        }

    }


    //reply email

    public function reply_email(Request $request){
        $validation = Validator::make($request->all(),[
            'name'=>'required|string',
            'subject'=>'required|string|max:60',
            'email'=>'required|email',
            'message'=>'required|string|max:1000',
            'attach_file'=>'nullable|file|mimes:jpg,jpeg,png,gif,doc,pdf,docx|max:5000'
        ]);

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
        if($request->hasFile('attach_file')){
            $obj_fu = new FileUploader();
            $fileName ='reply-file-'.uniqid().mt_rand(10, 9999);
            $fileName__ = $obj_fu->fileUploader($request->file('attach_file'), $fileName, $location);
            $file_ = $fileName__;
            $fileExtension = $request->file('attach_file')->getClientOriginalExtension();
        }

        $name_ = $request->name;
        $subject_ = $request->subject;
        $message_ = $request->message;

        //send email
            Mail::to($request->email)->send(new ReplyEmail(
                $name_,
                $subject_, 
                $message_,
                $file_, 
                $fileExtension
            ));

            return response()->json([
                'success'=>true,
                'msg'=>"Email Sent Successfully."
            ], 200);
    }
}   
