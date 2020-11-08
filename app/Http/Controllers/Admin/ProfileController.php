<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function my_profile(){
        return view("BackendViews.Admin.Pages.profile");
    }

    //change email
    public function change_email(Request $request){
        $validation = $this->validate($request, [
            'name'=>'required',
            'email'=>'required|email'
        ]);

        $updated = User::where('id', Auth::user()->id)
                    ->update([
                        'name'=>$request->name,
                        'email'=>$request->email,
                        'updated_at'=>Carbon::now(),
                    ]);
        if ($updated == true) {
            return redirect()->back()
                ->with('success', 'Info. Updated Successfully.');
        }else{
           return redirect()->back()
                ->with('error', 'Sorry! Something went wrong, please try again later.'); 
        }
    }

    //change password
    public function change_password(Request $request){
        $validate = $this->validate($request, [
            'current_password'=>'required',
            'password'=>'required|min:8|max:33|confirmed',
        ]);

        $currentPass = $request->current_password;
        $new_password = $request->password;
        $passConfirmation = $request->password_confirmation;

        //First Check old password matched or not
        $match_current_pass = $this->check_old_pass($currentPass); 

        if ($match_current_pass == false) {
            return redirect()->back()
            ->with('error', 'Sorry! Current Password doesn`t match.');
        }else{
            //Update Password            
            $updated = User::where([
                            ['id', '=', Auth::user()->id],
                        ])
                        ->update([
                            'password'=>Hash::make($new_password)
                        ]);
            
            if ($updated) {
                  Auth::logout();
                  return redirect()->route('login')
                  ->with('success', 'Password updated successfully, please login with new password.');
              }else{
                return redirect()->back()
                ->with('error', 'Sorry, There is problem, please try again later.');
              }
        }
    }


    //check_old_pass
    private function check_old_pass($current_pass){
        $authPass = Auth::user()->password;

        if (Hash::check($current_pass, $authPass)) {
            return true;
        }else{
            return false;
        }
    }
}
