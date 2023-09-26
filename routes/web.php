<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\DashboardController::class, 'index']);
Route::get('/register', [App\Http\Controllers\PageController::class, 'register']);
Route::post('/user/register', ['as' => '/user/register', 'uses' => 'App\Http\Controllers\UserController@register']);

//Google
Route::get('/google/redirect', ['as' => 'google.redirect', 'uses' => 'App\Http\Controllers\Auth\LoginController@redirectToGoogle']);
Route::get('/google/callback', ['as' => 'google.callback', 'uses' => 'App\Http\Controllers\Auth\LoginController@handleGoogleCallback']);

Route::get('user/{id}/avatar', function ($id) {
    // Find the user
    $user = App\Models\User::find(1);

    // Return the image in the response with the correct MIME type
    return response()->make($user->profile_photo, 200, array(
        'Content-Type' => (new finfo(FILEINFO_MIME))->buffer($user->profile_photo)
    ));
});

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('users', ['as' => 'users', 'uses' => 'App\Http\Controllers\UserController@index']);
    Route::get('users/delete/{id}', ['as' => 'users/delete/{id}', 'uses' => 'App\Http\Controllers\UserController@delete']);
    Route::get('users/verify/{id}', ['as' => 'users/verify', 'uses' => 'App\Http\Controllers\UserController@verify_user']);
	Route::resource('user', 'App\Http\Controllers\UserController');

    //Webcam
	Route::resource('webcam', 'App\Http\Controllers\WebcamController');
    // Route::controller(WebcamController::class)->group(function () {
    //     Route::get('webcam', 'index')->name('webcam.capture');
    //     Route::post('webcam', 'store');
    // });

    //Incidents
    Route::get('incidents',  ['as' => 'incidents', 'uses' => 'App\Http\Controllers\IncidentsController@index']);
    Route::get('incidents/delete/{id}', ['as' => 'incidents/delete/{id}', 'uses' => 'App\Http\Controllers\IncidentsController@delete']);
    Route::resource('incident', 'App\Http\Controllers\IncidentsController');

    Route::get('incident_types',  ['as' => 'incident_types', 'uses' => 'App\Http\Controllers\IncidentTypesController@index']);
    Route::get('incident_types/delete/{id}', ['as' => 'incident_types/delete/{id}', 'uses' => 'App\Http\Controllers\IncidentTypesController@delete']);
    Route::resource('incident_type', 'App\Http\Controllers\IncidentTypesController');

    //Incidents Archived
    Route::resource('incident_archive', 'App\Http\Controllers\IncidentArchiveController');

    //Medical Assistance
    //Blood Donation
    Route::get('blood_donations',  ['as' => 'blood_donations', 'uses' => 'App\Http\Controllers\MedicalAssistanceBloodDonationController@index']);
    Route::resource('blood_donation', 'App\Http\Controllers\MedicalAssistanceBloodDonationController');

    //User Management
    Route::get('employees', ['as' => 'employees', 'uses' => 'App\Http\Controllers\EmployeeController@index']);
    Route::get('employees/delete/{id}', ['as' => 'employees/delete/{id}', 'uses' => 'App\Http\Controllers\EmployeeController@delete']);
    Route::get('employees/data', ['as' => 'employees/data', 'uses' => 'App\Http\Controllers\EmployeeController@data']);
    Route::resource('employee','App\Http\Controllers\EmployeeController');
    //Request Management
    //Department Type
    Route::get('department_types', ['as' => 'department_types', 'uses' => 'App\Http\Controllers\DepartmentTypeController@index']);
    Route::get('department_types/data', ['as' => 'department_types/data', 'uses' => 'App\Http\Controllers\DepartmentTypeController@data']);
    Route::get('department_types/delete/{id}', ['as' => 'department_types/delete/{id}', 'uses' => 'App\Http\Controllers\DepartmentTypeController@delete']);
    Route::resource('department_type','App\Http\Controllers\DepartmentTypeController');
    //Department Name
    Route::get('department_names', ['as' => 'department_names', 'uses' => 'App\Http\Controllers\DepartmentNameController@index']);
    Route::get('department_names/data', ['as' => 'department_names/data', 'uses' => 'App\Http\Controllers\DepartmentNameController@data']);
    Route::get('department_names/delete/{id}', ['as' => 'department_names/delete/{id}', 'uses' => 'App\Http\Controllers\DepartmentNameController@delete']);
    Route::resource('department_name','App\Http\Controllers\DepartmentNameController');
    //Report Management
    //By Department
    Route::get('reports/department', ['as' => 'reports/department', 'uses' => 'App\Http\Controllers\ReportManagementController@by_department']);
    //Holdings
    Route::get('reports/holding', ['as' => 'reports/holding', 'uses' => 'App\Http\Controllers\ReportManagementController@holding']);
    Route::resource('report','App\Http\Controllers\ReportManagementController');

  	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
  	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
  	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'App\Http\Controllers\DashboardController@index']);

    Route::get('contacts', ['as' => 'contacts', 'uses' => 'App\Http\Controllers\ContactController@index']);
    //Route::get('contact/get_contacts', ['as' => 'country/get_countries', 'uses' => 'App\Http\Controllers\ContactController@getCountries']);
    Route::resource('contact', 'App\Http\Controllers\ContactController');

    //Community Service

    Route::resource('community_service', 'App\Http\Controllers\CommunityServiceController');

    //Roles
    Route::get('roles', ['as' => 'roles', 'uses' => 'App\Http\Controllers\RoleController@index']);
    Route::resource('role', 'App\Http\Controllers\RoleController');
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});
