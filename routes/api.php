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
], function ($router) {
	Route::get('index', 'AppointmentController@index');
	Route::post('control_search', 'AppointmentController@control_search');
	Route::post('complete', 'AppointmentController@complete');
	Route::post('store', 'AppointmentController@store');
});


// plantilla/jow contracts api routes
Route::group([
	'middleware' => 'api',
	'prefix' => 'plantilla_jocontracts',
], function ($router) {
	Route::get('index', 'PlantillaJowContractController@index');
	Route::post('control_search', 'PlantillaJowContractController@control_search');
	Route::post('complete', 'PlantillaJowContractController@complete');
	Route::post('store', 'PlantillaJowContractController@store');
});

// payroll api routes
Route::group([
	'middleware' => 'api',
	'prefix' => 'payroll',
], function ($router) {
	Route::get('index', 'PayrollController@index');
	Route::post('control_search', 'PayrollController@control_search');
	Route::post('complete', 'PayrollController@complete');
	Route::post('store', 'PayrollController@store');
});

// tlb api routes
Route::group([
	'middleware' => 'api',
	'prefix' => 'tlb',
], function ($router) {
	Route::get('index', 'TlbController@index');
	Route::post('control_search', 'TlbController@control_search');
	Route::post('complete', 'TlbController@complete');
	Route::post('store', 'TlbController@store');
});
