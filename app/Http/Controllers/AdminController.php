<?php

namespace App\Http\Controllers;

use App\Models\AdminLoginModel;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Login Page View
    function login_page_view(){
        return view('Pages.Login');
    }
 
    // Login Check
    function onLogin(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');

        $loginCount = AdminLoginModel::where('username',$username)->where('password',SHA1($password))->count();
        if( $loginCount == 1){
            $request->session()->put('admin_login',$username);
            return  1;
        }else{
            return   0;
        }
    }

    // Logout
    function logOut(Request $request){ 
        $request->session()->forget('admin_login');
        return redirect('/login');
    }

    // Change Password View
    function PasswordPageView(){
        return view('Dashboard.ChangePassword');
    }
    function ChangePassword(Request $request){
        $current_password = $request->input('current_password');
        $new_password = $request->input('new_password');
        $confirm_new_password = $request->input('confirm_new_password');
        
        // Get Password from DB
        $username = $request->session()->get('admin_login');
        $db_password = AdminLoginModel::where('username',$username)->pluck('password')->first();
        $current_pass_en = SHA1($current_password);
        

        if(empty($current_password)){
            return "Current Password is Required!";
        }
        else if(empty($new_password)){
            return "New Password is Required!";
        }
        else if(empty($confirm_new_password)){
            return "Confirm New Password is Required!";
        }
        else if($confirm_new_password != $new_password){
            return "Confirm Password Does't Match!";
        }
        else if($db_password != $current_pass_en){
            return "Current Password is Wrong!";
        }else{
            $update = AdminLoginModel::where('username',$username)->update([
                'password' => SHA1($confirm_new_password),
                'updated_at' => now()
            ]);
            if($update  == true){
                $request->session()->forget('admin_login');
                return 1;
                
            }else{
                return 0;
            }
        }
    }

    // Profile page View
    function ProfilePageView(Request $request){
        $username = $request->session()->get('admin_login');

        $data = AdminLoginModel::where('username',$username)->get();
        return view('Dashboard.Profile',[
            'data' => $data
        ]);
    } 
    function UpdateAdminProfile(Request $request){
        $username = $request->session()->get('admin_login');

        $name = $request->input('name');
        $email = $request->input('email');
        $photo = $request->input('photo');

        if(!empty($photo)){
            $update = AdminLoginModel::where('username',$username)->update([
                'name' => $name,
                'email' => $email,
                'photo' => $photo,
                'updated_at' => now()
            ]);
        }
        else{
            $update = AdminLoginModel::where('username',$username)->update([
                'name' => $name,
                'email' => $email, 
                'updated_at' => now()
            ]);
        } 
        if($update == 1){
            return 1;
        }else{
            return 0;
        }
    }
    static function AdminInfo($adminUsername){ 
        $data = AdminLoginModel::where('username',$adminUsername)->select('name','photo')->get();
        return $data;
    } 

}
