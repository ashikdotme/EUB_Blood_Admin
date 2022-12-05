<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Models\FemaleCodeModel;
use App\Models\ReportsModel;
use App\Models\UsersModel;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    // Search Donor
    function SearchDonor(Request $request){
        $blood_group = $request->input('blood_group'); 

        if(empty($blood_group)){
            $response['status']=false;
            $response['message']="Blood Group is Required!";
            return $response;
        }
        else{ 
            $data = UsersModel::where('blood_group',$blood_group)
            ->select(
                'id',
                'name',
                'department',
                'district',
                'upzila',
                'address',
                'mobile',
                'blood_group',
                'gender',
                'last_donate_date'
            )->get();

            $response['status']=true;
            $response['message']="Success!";
            $response['data']=$data;
            return $response;  
        }
    }

    
    // Get Female Mobile Number
    function getFemaleNumber(Request $request){
        $id = $request->input('id');
        $code = $request->input('code');

        $count = UsersModel::where('id',$id)->where('gender','female')->count();
        $db_code = FemaleCodeModel::where('id',1)->pluck('code')->first();

        if(empty($id)){
            $response['status']=false;
            $response['message']="ID is Required!";
            return $response;
        }
        else if($count != 1){
            $response['status']=false;
            $response['message']="User Not Found!";
            return $response;
        }
        else if(empty($code)){
            $response['status']=false;
            $response['message']="Code is Required!";
            return $response;
        }
        else if($code != $db_code){
            $response['status']=false;
            $response['message']="Code is Wrong!";
            return $response;
        }
        else{
            $data = UsersModel::where('id',$id)->select('mobile')->get();

            $response['status']=true;
            $response['message']="Success!";
            $response['data']=$data;
            return $response;
        }
    }

}
