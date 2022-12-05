<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{ 
    // Update Last Donate Date
    function UpdateLastDonateDate(Request $request){
        $tokenUser =  auth()->user();
        $user_id = $tokenUser['id'];

        $last_donate_date = $request->input('last_donate_date');
        $userDate = date('Y-m-d', strtotime($last_donate_date));
        $today = date("Y-m-d");
        
        // $date = $last_month.' '.$last_day.' '.$last_year;
        // return date('Y-m-d', strtotime($date));

        // return $today;
 
        if(empty($last_donate_date)){
            $response['status'] = false;
            $response['message'] = "Last Donate Date is Required!";             
            return $response;  
        }
        else if($userDate > $today){ 
            $response['status'] = false;
            $response['message'] = "Your Last Donate Date is Wrong!";             
            return $response;  
        }
        else{ 
            $make = UsersModel::where('id',$user_id)->update([
                'last_donate_date' => $last_donate_date,
                'updated_at' => now()
            ]);
            if($make == true){
                $response['status'] = true;
                $response['message'] = "Donate Date Update Successfully!";             
                return $response; 
            }else{
                $response['status'] = false;
                $response['message'] = "Donate Date Update Failed!";             
                return $response; 
            }  
        }
       
    }
 

    // Profile Info
    function UserProfileInfo(Request $request){
        $tokenUser =  auth()->user();
        $user_id = $tokenUser['id']; 
        $info = UsersModel::where('id',$user_id)->get();

        $response['status'] = true;
        $response['message'] = "Success!";
        $response['data'] = $info;
        return $response;
    }

    // Update Profile Info
    function UpdateProfileInfo(Request $request){
        $tokenUser =  auth()->user();
        $user_id = $tokenUser['id'];

        $name = $request->input('name');
        $email = $request->input('email');
        $id = $request->input('st_id');
        $department = $request->input('department');
        $donor_type = $request->input('donor_type');
        $address = $request->input('address');
        $upzila = $request->input('upzila');
        $district = $request->input('district');
        $birthday = $request->input('birthday');
        $gender = $request->input('gender');

        // Upload Images
        $location = env('SVLOCATION'); 
        $destination_path = 'public/users/profile';
        $public_path = $location."/storage/users/profile/";
        $photo = $request->file('photo');
 
        if(empty($name)){
            $response['status'] = false;
            $response['message'] = "Name is Required!";             
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
        else if(empty($gender)){
            $response['status'] = false;
            $response['message'] = "Gender is Required!";             
            return $response;
        }
        else{ 
            
            if(!empty($photo)){
                $photo_hash = $photo->hashName();
                $extension = $photo->getClientOriginalExtension();
                if($extension == 'jpg' OR $extension == 'jpeg' OR $extension == 'webp' OR $extension == 'png' OR $extension == 'JPG' OR $extension == 'PNG' OR $extension == 'gif'){
                    $photo->storeAs($destination_path,$photo_hash);
                    $photo_url = $public_path.$photo_hash;
                }
            }
            else{
                $photo_url = UsersModel::where('id',$user_id)->pluck('photo')->first();
            }

            $update = UsersModel::where('id',$user_id)->update([
                'name' => $name,
                'email' => $email,
                'st_id' => $id,
                'department' => $department,
                'donor_type' => $donor_type,   
                'address' => $address,
                'upzila' => $upzila,
                'district' => $district,
                'gender' => $gender, 
                'birthday' => $birthday,
                'photo' => $photo_url,
                'updated_at' => now()
            ]);
            if($update == true){
                $response['status'] = true;
                $response['message'] = "Profile Update Successfully!";             
                return $response;
            }else{
                $response['status'] = false;
                $response['message'] = "Profile Update Failed!";             
                return $response; 
            }
        }
    }

    // Change Password
    function UserChangePassword(Request $request){ 
        $tokenUser =  auth()->user();
        $user_id = $tokenUser['id'];

        $current_password = $request->input('current_password');
        $new_password = $request->input('new_password');
        $confirm_new_password = $request->input('confirm_new_password');
        // Check Current Password
        $db_password = UsersModel::where('id',$user_id)->pluck('password')->first();
        $check_current_password = Hash::check($current_password, $db_password);
    
        if(empty($current_password)){
            $response['status'] = false;
            $response['message'] = "Current Password is Required!";             
            return $response;
        } 
        else if(empty($new_password)){
            $response['status'] = false;
            $response['message'] = "New Password is Required!";             
            return $response;
        }
        else if(empty($confirm_new_password)){
            $response['status'] = false;
            $response['message'] = "Confirm New Password is Required!";             
            return $response;
        }
        else if($new_password != $confirm_new_password){
            $response['status'] = false;
            $response['message'] = "New Password & Confirm New Password doesn't Match!";             
            return $response;
        }
        else if($check_current_password != 1){
            $response['status'] = false;
            $response['message'] = "Current Password is Wrong!";             
            return $response;
        } 
        else{ 
            $new_hash_password = Hash::make($confirm_new_password);

            $updatePassword = UsersModel::where('id',$user_id)->update([
                'password' => $new_hash_password,
                'updated_at' => now()
            ]);
            if($updatePassword == true){
                $response['status'] = true;
                $response['message'] = "Password Change Successfully!";             
                return $response;
            }else{
                $response['status'] = false;
                $response['message'] = "Password Change Failed!";             
                return $response;
            } 
        } 
    }
 
}
