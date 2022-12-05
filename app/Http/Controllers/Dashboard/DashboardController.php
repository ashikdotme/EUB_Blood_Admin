<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Dashboard Page View
    function DashboardPageView(){
        return view('Dashboard.Dashboard');
    }


    // Dashboard Page View
    function FilemanagerPageView(){
        return view('Dashboard.Filemanager');
    }
}
