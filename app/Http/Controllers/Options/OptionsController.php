<?php

namespace App\Http\Controllers\Options;

use App\Http\Controllers\Controller;
use App\Models\Options\HomeModel;
use App\Models\Options\VolunteersListModel;
use Illuminate\Http\Request;

class OptionsController extends Controller
{
    // App Option
    function AppContentView(){
        $data = HomeModel::where('id',1)->get();
        return view('Options.AppOptions',[
            'data' => $data
        ]);
    } 
     
    function UpdateAppContent(Request $request){
        $icon=$request->input('icon');
        $logo=$request->input('logo');
        $home_title=$request->input('home_title');
        $home_img=$request->input('home_img');
        $login_img=$request->input('login_img');
        $about_title=$request->input('about_title');
        $about_content=$request->input('about_content');
        $about_img=$request->input('about_img');
        $app_title=$request->input('app_title');
        $splash_img=$request->input('splash_img');

        $update = HomeModel::where('id',1)->update([
            'icon'=> $icon,
            'logo'=> $logo,
            'home_title'=> $home_title,
            'home_img'=> $home_img,
            'login_img'=> $login_img,
            'about_title'=> $about_title,
            'about_content'=> $about_content,
            'about_img'=> $about_img,
            'app_title'=> $app_title,
            'splash_img'=> $splash_img,
            'updated_at' => now()
        ]);
        if($update == true){
            return 1;
        }else{
            return 0;
        }
    }
    // API APP Data
    function API_APP_Content(){
        // App Content
        $app_content = HomeModel::where('id',1)->get();
        // Team Members
        $team = VolunteersListModel::WhereNull('deleted_at')->orderBy('priority','ASC')->get();

        $response['status'] = true;
        $response['message'] = "Success!";
        $response['data']['app_content'] = $app_content;
        $response['data']['team'] = $team;
        return $response;
    }
    
     

    /********** Team Members List **********/ 
    function VolunteersListPageView(){ 
        return view('Options.TeamMembers');
    }
    function VolunteersList(){
        $list = VolunteersListModel::WhereNull('deleted_at')->orderBy('priority','ASC')->get();
        return $list;
    } 
    function VolunteersDelete(Request $request){
        $id = $request->input('delid');
        $delete = VolunteersListModel::where('id',$id)->delete();
        if($delete == true){
            return 1;
        }else{
            return 0;
        }
    } 
    function CreateNewVolunteersList(Request $request){
        $name=$request->input('name');  
        $designation=$request->input('designation');  
        $department=$request->input('department');  
        $st_id=$request->input('st_id');
        $mobile=$request->input('mobile');
        $fb_url=$request->input('fb_url');
        $priority=$request->input('priority');
        $photo=$request->input('photo');

        $create = VolunteersListModel::insert([
            'name'=> $name, 
            'designation'=> $designation,
            'department'=> $department,
            'st_id'=> $st_id,
            'phone'=> $mobile,
            'fb_url'=> $fb_url,
            'priority'=> $priority,
            'photo'=> $photo,
            'created_at' => now()
        ]);
        if($create == true){
            return 1;
        }else{
            return 0;
        }
    }
    
}
