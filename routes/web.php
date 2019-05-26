<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('signin', "Auth\LoginController@signIn");
Route::post('login', "Auth\LoginController@login");
Route::get('logout', 'Auth\LoginController@logout');

Route::get('/user', "EmployeeController@index");
Route::post('/user/add', "EmployeeController@add");
Route::post('/user/getById', "EmployeeController@getById");
Route::post('/user/update', "EmployeeController@update");
Route::post('/user/delete', "EmployeeController@delete");
Route::post('/user/resetPassword', "EmployeeController@resetPassword");

Route::get('/payroll', "PayrollController@index");
Route::get('/payroll/confirm/{id}', "PayrollController@confirm");

Route::get('/payroll/edit/{id}', "PayrollController@edit");
Route::post('/payroll/update', "PayrollController@update");
Route::post('/payroll/getDetail', "PayrollController@getDetail");

Route::post('/payroll/setStatus', "PayrollController@setStatus");
Route::get('/payroll/getAskingRequests', "PayrollController@getAskingRequests");	
Route::post('/payroll/add', "PayrollController@add");
Route::post('/payroll/status', "PayrollController@status");

/*Payroll for user*/
Route::get('/payroll/user', "PayrollController@user");

/* Team Route */
Route::get('/team', "TeamController@index");
Route::post('/team/add', "TeamController@add");
Route::post('/team/delete', "TeamController@delete");
Route::post('/team/getById', "TeamController@getById");
Route::post('/team/update', "TeamController@update");

/*Shift Routes*/
Route::get('/shift', "ShiftController@index");
Route::post('/shift/add', "ShiftController@add");
Route::post('/shift/delete', "ShiftController@delete");
Route::post('/shift/getById', "ShiftController@getById");
Route::post('/shift/update', "ShiftController@update");

/*Roaster Routes*/
Route::get('/roaster', "RoasterController@index");
Route::post('/roaster/add', "RoasterController@add");
Route::post('/roaster/delete', "RoasterController@delete");
Route::post('/roaster/getById', "RoasterController@getById");
Route::post('/roaster/update', "RoasterController@update");

/*RoasterDetail Routes*/
Route::get('/roasterdetail/{id}', "RoasterDetailController@index");
Route::post('/roasterdetail/set_shift', "RoasterDetailController@set_shift");
Route::post('/roasterdetail/getDetails', "RoasterDetailController@getDetails");
Route::post('/roasterdetail/delete', "RoasterDetailController@delete");