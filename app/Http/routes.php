<?php
use App\Employee;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|

*/


/**
* Routes for the general functions,that does not require any logging 
*/

Route::get('/', 'SignUpController@main');

Route::get('/about', function () {
    return view('about');
});

Route::get('/signup', function () {
    return view('signup');
});
Route::get('/profile','SignUpController@getProfile');
Route::post('/signup', 'SignUpController@store');
Route::get('/login','SignUpController@getLogin');
Route::get('/login2','SignUpController@getLogin2');
Route::post('/login','SignUpController@log');
Route::post('/login2','SignUpController@log2');
Route::get('/logout', 'SignUpController@getLogout');

Route::get('/editProfile','SignUpController@editProfile');
Route::post('/editProfile','SignUpController@editProfile2');
Route::get('/changePassword','SignUpController@changePassword');
Route::post('/changePassword','SignUpController@changePassword2');

/**
* Routes for the functions of health assistants.
*/

Route::get('/registerpatient', 'HAController@getRegPatient');
Route::post('/registerpatient', 'HAController@postRegPatient');

Route::get('/updatepatient', 'HAController@getUpdatePatient');
Route::post('/updatepatient', 'HAController@postUpdatePatient');

Route::get('/updatepatient2', 'HAController@getUpdatePatient2');
Route::post('/updatepatient2', 'HAController@postUpdatePatient2');

Route::get('/updatevaccine', 'HAController@updatevaccine');
Route::get('/updatevaccine/{vaccineno}', 'HAController@updatevaccine2');
Route::get('/updatevaccine2', 'HAController@updatevaccine3');
Route::post('/updatevaccine2', 'HAController@updatevaccine4');

Route::get('/editpatient', 'HAController@editPatient');
Route::post('/editpatient', 'HAController@editPatient2');
Route::get('/editpatient2', 'HAController@editPatient3');
Route::get('/editpatient2/{recordno}', 'HAController@editPatient4');
Route::get('/editpatient3', 'HAController@editPatient5');
Route::post('/editpatient3', 'HAController@editPatient6');



/** 
*Routes for the functions for the Chief Health Officer  
*/

Route::get('/createCampaign', 'CHOController@getCreateCampaign');
Route::post('/createCampaign', 'CHOController@postCreateCampaign');

Route::get('/setCenter', 'CHOController@getSetCenter');
Route::get('/setCenter/{campaign_no}', 'CHOController@getSetCenter2');
Route::get('/setCenter2', 'CHOController@getSetCenter21');
Route::get('/setCenter2/add/{center_no}', 'CHOController@getSetCenter22');
Route::get('/setCenter2/del/{center_no}', 'CHOController@getSetCenter23');
Route::post('/setCenter2', 'CHOController@postSetCenter2');

Route::get('/assignHO', 'CHOController@getAssignHO');
Route::get('/assignHO/{campaign_no}', 'CHOController@getAssignHO2');
Route::get('/assignHO2', 'CHOController@getAssignHO3');
Route::get('/assignHO2/{center_no}', 'CHOController@getAssignHO4');\
Route::get('/assignHO3', 'CHOController@getAssignHO5');
Route::get('/assignHO3/{emp_id}', 'CHOController@getAssignHO6');
Route::post('/assignHO3', 'CHOController@postAssignHO3');

Route::get('/notify', 'CHOController@getNotifications');
Route::get('/notify/{campaign_no}', 'CHOController@getNotifications2');
Route::get('/notify2', 'CHOController@getNotifications3');
Route::post('/notify2', 'CHOController@getNotifications4');

/**
* Routes for the functions for the Health Officer  
*/
Route::get('/addCenter', 'HOController@getCenter');
Route::post('/addCenter', 'HOController@postCenter');
Route::get('/addVaccine', 'HOController@getVaccine');
Route::post('/addVaccine', 'HOController@postVaccine');

Route::get('/assignHA', 'HOController@getAssignHa');
Route::get('/assignHA/{cc}', 'HOController@getAssignHa2');
Route::get('/assignHA2', 'HOController@getAssignHa3');
Route::get('/assignHA2/add/{empno}', 'HOController@getAssignHa4');
Route::get('/assignHA2/del/{empno}', 'HOController@getAssignHa5');
Route::post('/assignHA2', 'HOController@getAssignHa6');

Route::get('/updateVaccine', 'HOController@updateVaccine');
Route::get('/updateVaccine/{vaccineno}', 'HOController@updateVaccine2');
Route::get('/updateVaccine2', 'HOController@updateVaccine3');
Route::post('/updateVaccine2', 'HOController@updateVaccine4');

/*
* Routes for the functions for the Patiens  
*/
Route::get('/viewNotifications', 'PatController@getviewNotifications');
Route::get('/viewNotifications/{notification}', 'PatController@getviewNotifications2');
Route::get('/viewNotifications2', 'PatController@getviewNotifications3');

/**
* Routes for the admin 
*/

Route::get('/approveEmployee', 'AdminController@approveEmployee');
Route::get('/approveEmployee/{emp_no}', 'AdminController@approveEmployee2');
Route::get('/approveEmployee2', 'AdminController@approveEmployee3');
Route::post('/approveEmployee2', 'AdminController@approveEmployee4');
Route::get('/approveEmployee2/{emp_no}', 'AdminController@approveEmployee5');

Route::get('/deleteCampaign', 'AdminController@deleteCampaign');
Route::get('/deleteCampaign/{campaign_no}', 'AdminController@deleteCampaign2');
Route::get('/deleteCampaign2', 'AdminController@deleteCampaign3');
Route::post('/deleteCampaign2', 'AdminController@deleteCampaign4');

Route::get('/deleteVaccine', 'AdminController@deleteVaccine');
Route::get('/deleteVaccine/{vaccineno}', 'AdminController@deleteVaccine2');
Route::get('/deleteVaccine2', 'AdminController@deleteVaccine3');
Route::post('/deleteVaccine2', 'AdminController@deleteVaccine4');
