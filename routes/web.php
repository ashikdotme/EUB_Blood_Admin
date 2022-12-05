<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\Options\OptionsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Thalassemia\ThalassemiaController;
use App\Http\Controllers\UsersController;

Route::get('/',[DashboardController::class,'DashboardPageView'])->middleware('AdminCheck');
Route::get('/login',[AdminController::class,'login_page_view']);
Route::get('logout',[AdminController::class,'logOut']);
Route::post('api-on-login',[AdminController::class,'onLogin']);
Route::get('change-password',[AdminController::class,'PasswordPageView'])->middleware('AdminCheck');
Route::post('api-change-password',[AdminController::class,'ChangePassword'])->middleware('AdminCheck');
Route::get('profile',[AdminController::class,'ProfilePageView'])->middleware('AdminCheck');
Route::post('api-update-profile',[AdminController::class,'UpdateAdminProfile'])->middleware('AdminCheck');

// Users List - Routes
Route::get('all-users',[UsersController::class,'UserListPageView'])->middleware('AdminCheck');
Route::get('api-all-user-list',[UsersController::class,'UsersList'])->middleware('AdminCheck');
Route::post('api-delete-user',[UsersController::class,'DeleteUser'])->middleware('AdminCheck');
// View User Details
Route::get('view-user',[UsersController::class,'ViewSingleUser'])->middleware('AdminCheck');
Route::get('update-user',[UsersController::class,'UpdateViewSingleUser'])->middleware('AdminCheck');
Route::post('api-update-the-user-data',[UsersController::class,'UpdateTheUserData'])->middleware('AdminCheck');
// User Search - page
Route::get('search-user',[UsersController::class,'UserSearchPageView'])->middleware('AdminCheck');
Route::post('api-search-the-user',[UsersController::class,'searchTheUser'])->middleware('AdminCheck');

// Deleted Users
Route::get('deleted-users',[UsersController::class,'DeletedUserPageView'])->middleware('AdminCheck');
Route::get('api-all-deleted-user-list',[UsersController::class,'DeletedUsersList'])->middleware('AdminCheck');
Route::post('api-deleted-user-restore',[UsersController::class,'RestoreDeleteUser'])->middleware('AdminCheck');


// App Content Options
Route::get('content-options',[OptionsController::class,'AppContentView'])->middleware('AdminCheck')->name('app_content_view');
Route::post('api-update-app-content',[OptionsController::class,'UpdateAppContent'])->middleware('AdminCheck');

 
// Team Members page Content Options
Route::get('team-members',[OptionsController::class,'VolunteersListPageView'])->middleware('AdminCheck')->name('team_members');
Route::get('api-volunteers-list',[OptionsController::class,'VolunteersList'])->middleware('AdminCheck');
Route::post('api-volunteers-delete-list',[OptionsController::class,'VolunteersDelete'])->middleware('AdminCheck');
Route::post('api-volunteers-create-list-data',[OptionsController::class,'CreateNewVolunteersList'])->middleware('AdminCheck');

// Dashboard - Settings
Route::get('settings',[SettingsController::class,'settingsPageView'])->middleware('AdminCheck');
Route::post('api-set-new-female-password',[SettingsController::class,'updateFemalePassword'])->middleware('AdminCheck');
 
 
// Fiele Manage Routes
Route::get('/file-manager',[DashboardController::class,'FilemanagerPageView'])->middleware('AdminCheck');
Route::group(['prefix' => 'filemanager', 'middleware' => ['AdminCheck']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
 