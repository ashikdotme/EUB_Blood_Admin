<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Options\OptionsController;
use App\Http\Controllers\Search\SearchController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UsersController;

// User Auth API 
Route::post('create-new-user', [UsersController::class, 'NewUserRegistration']); 
Route::post('login', [AuthController::class, 'login']); 
Route::group(['middleware' => ['jwt.auth']], function() {
    Route::get('logout', [AuthController::class, 'logout']); 
    Route::post('change-user-password', [UserProfileController::class, 'UserChangePassword']); 
    Route::post('update-user-profile-info', [UserProfileController::class, 'UpdateProfileInfo']); 
    Route::get('user-profile-info', [UserProfileController::class, 'UserProfileInfo']); 
    Route::post('update-user-last-donate-date', [UserProfileController::class, 'UpdateLastDonateDate']);
});

// App Content
Route::get('app-content', [OptionsController::class, 'API_APP_Content']); 

// Blood Search + Female + Report
Route::post('search-donor', [SearchController::class, 'SearchDonor']); 
Route::post('get-female-mobile-number', [SearchController::class, 'getFemaleNumber']); 
