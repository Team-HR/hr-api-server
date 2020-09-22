<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
	'middleware' => 'api',
	'prefix' => 'auth'
], function ($router) {
	Route::post('store', 'JWTAuthController@store');
	Route::post('update', 'JWTAuthController@update');
	Route::post('login', 'JWTAuthController@login');
	Route::post('logout', 'JWTAuthController@logout');
	Route::get('refresh', 'JWTAuthController@refresh');
	Route::get('user', 'JWTAuthController@profile');
	Route::get('users', 'JWTAuthController@users');
	Route::get('get_user/{id}', 'JWTAuthController@get_user');
});

Route::group([
	'middleware' => 'api',
	'prefix' => 'user-groups',
], function ($router) {
	Route::get('index', 'UserGroupController@index');
	Route::post('store', 'UserGroupController@store');
});

// appointment api routes
Route::group([
	'middleware' => 'api',
	'prefix' => 'appointments',
	'namespace' => 'hrdms'
], function ($router) {
	Route::get('index', 'HrdmsAppointmentController@index');
	Route::post('control_search', 'HrdmsAppointmentController@control_search');
	Route::post('complete', 'HrdmsAppointmentController@complete');
	Route::post('store', 'HrdmsAppointmentController@store');
});

// payroll api routes
Route::group([
	'middleware' => 'api',
	'prefix' => 'payroll',
	'namespace' => 'hrdms'

], function ($router) {
	Route::get('index', 'HrdmsPayrollController@index');
	Route::post('control_search', 'HrdmsPayrollController@control_search');
	Route::post('complete', 'HrdmsPayrollController@complete');
	Route::post('store', 'HrdmsPayrollController@store');
});

// plantilla/jow contracts api routes
Route::group([
	'middleware' => 'api',
	'prefix' => 'plantilla_jocontracts',
	'namespace' => 'hrdms'
], function ($router) {
	Route::get('index', 'HrdmsPlantillaController@index');
	Route::post('control_search', 'HrdmsPlantillaController@control_search');
	Route::post('complete', 'HrdmsPlantillaController@complete');
	Route::post('store', 'HrdmsPlantillaController@store');
});

// tlb api routes
Route::group([
	'middleware' => 'api',
	'prefix' => 'tlb',
	'namespace' => 'hrdms'
], function ($router) {
	Route::get('index', 'HrdmsTlbController@index');
	Route::post('control_search', 'HrdmsTlbController@control_search');
	Route::post('complete', 'HrdmsTlbController@complete');
	Route::post('store', 'HrdmsTlbController@store');
});

// employees api routes
Route::group([
	'middleware' => 'api',
	'prefix' => 'employees',
	// 'namespace' => 'hrdms'
], function ($router) {
	Route::get('/', 'EmployeeController@index');
});
