<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Thalassemia\TbDonorModel;

class UsersController extends Controller
{
    // User List Page View
    function UserSearchPageView(){
        return view('Dashboard.UserSearch');
    }
    function searchTheUser(Request $request){
        $mobile  = $request->input('search_mobile');
        $find = UsersModel::where('mobile',$mobile)->count();
        if($find == 1){
            $id = UsersModel::where('mobile',$mobile)->pluck('id')->first();
            return $id;
        }
        else{
            return 0;
        }
    }

    // User List Page View
    function UserListPageView(){
        return view('Dashboard.Users');
    }
   
    // View Single User
    function ViewSingleUser(Request $request){
        $id = $request->id;
        $data = UsersModel::where('id',$id)->get();
        return view('Dashboard.UserView',[
            'data' => $data
        ]);
    }

    // Update Single User View
    function UpdateViewSingleUser(Request $request){
        $id = $request->id;
        $data = UsersModel::where('id',$id)->get();
        return view('Dashboard.UserUpdate',[
            'data' => $data
        ]);
    }
     
    // Update The User Data
    function UpdateTheUserData(Request $request){
        $name = $request->input('name');
        $email = $request->input('email');
        $mobile = $request->input('mobile');
        $st_id = $request->input('st_id');
        $department = $request->input('department'); 
        $donor_type = $request->input('donor_type'); 
        $blood_group = $request->input('blood_group');
        $last_donate_date = $request->input('last_donate_date');
        $address = $request->input('address');
        $upzila = $request->input('upzila');
        $district = $request->input('district');
        $gender = $request->input('gender');
        $birthday = $request->input('birthday');
        $password = $request->input('password');
        $id = $request->input('user_id');
        
        if(empty($password)){
            $password = UsersModel::where('id',$id)->pluck('password')->first();
        }
        else{
            $password = Hash::make($password); 
        } 
        $update = UsersModel::where('id',$id)->update([
            'name' => $name, 
            'email' => $email,
            'mobile' => $mobile,
            'st_id' => $st_id,
            'department' => $department,
            'donor_type' => $donor_type, 
            'blood_group' => $blood_group,
            'last_donate_date' => $last_donate_date, 
            'address' => $address, 
            'upzila' => $upzila, 
            'district' => $district, 
            'gender' => $gender,
            'birthday' => $birthday,
            'password' => $password,
            'updated_at' => now()
        ]);
        if($update == true){
            return 1;
        }
        else{
            return 0;
        }
            
    }

    // All Users List
    function UsersList(){
        $list = User::whereNull('deleted_at')->select('id','name','mobile','blood_group','last_donate_date')->get();
        return $list;
    }
    // Delete User
    function DeleteUser(Request $request){
        $id = $request->input('delid');
        $delete = UsersModel::where('id',$id)->delete();
        if($delete == true){
            return 1;
        }else{
            return 0;
        }
    }

    // Deleted User Page View
    function DeletedUserPageView(){
        return view('Dashboard.DeletedUsers');
    }
    // All Users List
    function DeletedUsersList(){
        $list = User::whereNotNull('deleted_at')->select('id','name','mobile','blood_group','deleted_at','last_donate_date')->get();
        return $list;
    }
    // Restore Delete User
    function RestoreDeleteUser(Request $request){
        $id = $request->input('delid');
        $restore = UsersModel::where('id',$id)->restore();
        if($restore == true){
            return 1;
        }else{
            return 0;
        }
    }


    // Roktobondhu Page
    // Roktobondhu List
    function RoktobondhuListPageView(){
        return view('Dashboard.RoktobondhuList');
    }
   
    // Roktobondhu Users List
    function RoktobondhuUsersList(){
        $list = User::where('platelet',0)->whereNull('deleted_at')->select('id','name','mobile','blood_group','last_day','last_month','last_year')->get();
        return $list;
    }
 
    // New User Registration
    function NewUserRegistration(Request $request){ 
        $name = $request->input('name');
        $mobile = $request->input('mobile');
        $email = $request->input('email');
        $id = $request->input('st_id');
        $department = $request->input('department');
        $donor_type = $request->input('donor_type');
        $blood_group = $request->input('blood_group');
        $last_donate_date = $request->input('last_donate_date');
        $address = $request->input('address');
        $upzila = $request->input('upzila');
        $district = $request->input('district');
        $birthday = $request->input('birthday');
        $password = $request->input('password');
        $gender = $request->input('gender');
 
        $userDate = date('Y-m-d', strtotime($last_donate_date));
        $today = date("Y-m-d");
 
        $mobileCount = UsersModel::where('mobile',$mobile)->count();
        $emailCount = UsersModel::where('email',$email)->count();
        if(empty($name)){
            $response['status'] = false;
            $response['message'] = "Name is Required!";             
            return $response;
        }
        else if(empty($mobile)){ 
            $response['status'] = false;
            $response['message'] = "Mobile Number is Required!";             
            return $response;
        }
        else if(!is_numeric($mobile)){ 
            $response['status'] = false;
            $response['message'] = "Mobile Number Must be Number!";             
            return $response;
        }
        else if(strlen($mobile) != 11){ 
            $response['status'] = false;
            $response['message'] = "Mobile Number Must be 11 Digit!";             
            return $response;
        }
        else if($mobileCount !== 0){
            $response['status'] = false;
            $response['message'] = "Mobile Number Already exists!";             
            return $response;
        }
        else if($emailCount !== 0){
            $response['status'] = false;
            $response['message'] = "Email Already exists!";             
            return $response;
        } 
        else if(empty($address)){
            $response['status'] = false;
            $response['message'] = "Address is Required!";             
            return $response;
        }
        else if(empty($upzila)){
            $response['status'] = false;
            $response['message'] = "Upzila is Required!";             
            return $response;
        }
        else if(empty($district)){
            $response['status'] = false;
            $response['message'] = "District is Required!";             
            return $response;
        }
        else if(empty($blood_group)){
            $response['status'] = false;
            $response['message'] = "Blood Group is Required!";             
            return $response;
        }
       
        else if(empty($last_donate_date)){
            $response['status'] = false;
            $response['message'] = "Last Donote Date is Required!";             
            return $response;
        } 
        else if($userDate > $today){
            $response['status'] = false;
            $response['message'] = "Your Last Donate Date is Wrong!";             
            return $response;
        }
        else if(empty($password)){
            $response['status'] = false;
            $response['message'] = "Password is Required!";             
            return $response;
        }
        else if(empty($gender)){
            $response['status'] = false;
            $response['message'] = "Gender is Required!";             
            return $response;
        }
        else{

            $password = Hash::make($password); 
            $create = UsersModel::insert([
                'name' => $name,
                'mobile' => $mobile,
                'email' => $email,
                'st_id' => $id,
                'department' => $department,
                'donor_type' => $donor_type,
                'blood_group' => $blood_group,
                'last_donate_date' => $last_donate_date,
                'address' => $address,
                'upzila' => $upzila,
                'district' => $district,
                'birthday' => $birthday,
                'password' => $password,
                'gender' => $gender,
                'created_at' => now()
            ]);
            if($create == true){
                $response['status'] = true;
                $response['message'] = "Registration Successfully!";             
                return $response;

            }else{
                $response['status'] = false;
                $response['message'] = "Registration Failed!";             
                return $response;

            }
        }
    }






}
