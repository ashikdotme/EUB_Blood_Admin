<?php

namespace App\Http\Controllers;

use App\Models\ReportsModel;
use App\Models\UsersModel;
use Illuminate\Http\Request;
use DB;

class DonorController extends Controller
{
    // Donor Feedback Page View
    function DonorFeedbackView(){
        return view('Dashboard.DonorFeedback');
    }
    // Donor Feedback List
    function DonorFeedbackList(){
        $list = UsersModel::whereNotNull('feedback')->select('id','mobile','name','feedback_status','feedback')->get();
        return $list;
    }
    // Approve Donor Feedback
    function ApproveDonorFeedback(Request $request){
        $id = $request->input('appid');
        $update=UsersModel::where('id',$id)->update([
            'feedback_status' => 1
        ]);
        if($update == true){
            return 1;
        }
        else{
            return 0;
        }
    }
    // Delete Donor Feedback
    function DeleteDonorFeedback(Request $request){
        $id = $request->input('delid');
        $update=UsersModel::where('id',$id)->update([
            'feedback_status' => 0
        ]);
        if($update == true){
            return 1;
        }
        else{
            return 0;
        }
    }
    // Donor Feedback Homepage List
    function DonorFeedbackForHomePage(){
        $list=UsersModel::where('feedback_status',1)->select('name','photo','feedback','feedback_status')->get();
        return $list;
    }

    // **********  Visitor Reports ************ //

    // Visitor Reports Page View
    function VisitorReportsView(){
        // Count Total Reports
        $totalReports = ReportsModel::count();
        return view('Dashboard.VisitorReports',[
            'totalReports' => $totalReports
        ]);
    }
    // Visitor Reports List
    function ReportsList(Request $request){
        $list = DB::table('visitor_reports')
        ->join('users', 'visitor_reports.user_id', '=', 'users.id') 
        ->select('users.name','users.id as user_id','users.blood_group','users.mobile','visitor_reports.*')
        ->orderBy('visitor_reports.id','DESC')
        ->get(); 
        return $list;
    }

    //  Ready Donor List View //
    function ReadyDonorView(){
        return view('Dashboard.ReadyDonorList');
    }
    function ReadyDonorList(){
        $list = UsersModel::where('ready_donor',1)->select('id','name','mobile','ready_donor','blood_group','last_day','last_month','last_year')->get();
        return $list;
    }
    function RemoveReadyDonor(Request $request){
        $id = $request->input('delid');
        $update = UsersModel::where('id',$id)->update([
            'ready_donor' => 0
        ]);
        if($update == true){
            return 1;
        }else{
            return 0;
        }
    }
}
