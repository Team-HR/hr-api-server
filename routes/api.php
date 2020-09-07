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
	'prefix' => 'appointments',
], function ($router) {
	Route::get('index', 'AppointmentController@index');
	Route::post('control_search', 'AppointmentController@control_search');
	Route::post('complete', 'AppointmentController@complete');
	Route::post('store', 'AppointmentController@store');
});


// // Route::prefix('v1')->group(function () {
//     Route::prefix('auth')->group(function () {

//         // Below mention routes are public, user can access those without any restriction.
//         // Create New User
//         Route::post('register', 'AuthController@register');

//         // Login User
//         Route::post('login', 'AuthController@login');
//         // Refresh the JWT Token
//         Route::get('refresh', 'AuthController@refresh');

//         // Below mention routes are available only for the authenticated users.

//         Route::middleware('auth:api')->group(function () {
//             // Get user info
//             Route::get('user', 'AuthController@profile');

//             // Logout user from application
//             Route::post('logout', 'AuthController@logout');
//         });
//     });
// // });