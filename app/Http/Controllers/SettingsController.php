<?php

namespace App\Http\Controllers;

use App\Models\FemaleCodeModel;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    // Settings Page View
    function settingsPageView(){
        // Female Password
        $femalePassword = FemaleCodeModel::where('id',1)->pluck('code')->first();
        return view('Dashboard.Settings',[
            'femalePassword' => $femalePassword
        ]);
    }
    // Update Female Password
    function updateFemalePassword(Request $request){
        $new_password = $request->input('new_password');
        if(empty($new_password)){
            return "New Password is Required!";
        }
        else{
            $update = FemaleCodeModel::where('id',1)->update([
                'code' => $new_password
            ]);
            
            if($update == true){
                return 1;
            }
            else{
                return 0;
            }
        }
    }
}
