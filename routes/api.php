<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API ROUTES
|--------------------------------------------------------------------------
|
| Here is where you can register API Routes for your application. These
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
	Route::post('change-password', 'JWTAuthController@change_password');
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

// appointment 
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

// payroll 
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

// plantilla/jow contracts 
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

// tlb 
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

// talent_assessment
Route::group([
	'middleware' => 'api',
	'prefix' => 'talent-assessment',
	// 'namespace' => 'hrdms'
], function ($router) {
	Route::get('/', 'TalentAssessmentController@index');
	// Route::get('/select_items/{department_id}', 'EmployeeController@get_select_items');
	Route::post('store', 'TalentAssessmentController@store');
});

// rnr_surveys
Route::group([
	'middleware' => 'api',
	'prefix' => 'rnr-survey',
	'namespace' => 'rnr'
], function ($router) {
	Route::get('/{id}', 'RnrSurveyController@get_awardee');
	// Route::get('/select_items/{department_id}', 'EmployeeController@get_select_items');
	Route::post('store', 'RnrSurveyController@store');
	Route::post('store_esib_2020', 'RnrSurveyController@store_esib_2020');
});






















































// staff-management
Route::group([
	'middleware' => 'api',
	'prefix' => 'staff-management',
], function ($router) {
	// Route::get('/offices', 'SupervisorManagementController@get_offices');
});

// employees 
Route::group([
	'middleware' => 'api',
	'prefix' => 'employee',
], function ($router) {
	Route::get('/', 'EmployeeController@index');
	Route::get('/get_select_items/{department_id}', 'EmployeeController@get_select_items');
	Route::post('/store', 'EmployeeController@store');
});

// departments 
Route::group([
	'middleware' => 'api',
	'prefix' => 'department',
], function ($router) {
	Route::get('/','DepartmentController@index');
	Route::get('/get_info/{id}','DepartmentController@get_info');
	Route::get('/get_select_items', 'DepartmentController@get_select_items');
	// Route::get('/test', 'DepartmentController@test');
});

// office 
Route::group([
	'middleware' => 'api',
	'prefix' => 'office',
], function ($router) {
	Route::get('/get_info/{id}', 'OfficeController@get_info');
	Route::get('/get_offices/{department_id}', 'OfficeController@get_offices');
	Route::post('/create', 'OfficeController@create');
});

// competency 
Route::group([
	'middleware' => 'api',
	'prefix' => 'competency'
], function ($router) {
	Route::get('/get_peers', 'CompetencyController@get_peers');
	Route::get('/get_questionnaire', 'CompetencyController@get_questionnaire');
	Route::post('/store', 'CompetencyController@store');
	Route::post('/add_peer', 'CompetencyController@add_peer');
	Route::post('/delete_peer', 'CompetencyController@delete_peer');
});

// superior
Route::group([
	'middleware' => 'api',
	'prefix' => 'superior',
], function ($router) {
	Route::post('/create', 'SuperiorController@create');
	Route::get('/get_free_employees','SuperiorController@get_free_employees');
	Route::get('/get_info/{superior_id}', 'SuperiorController@get_info');
	Route::get('/get_superiors/{office_id}', 'SuperiorController@get_superiors');
	Route::get('/authCheck', 'SuperiorController@authCheck');
});

// TESTING ============================================= START
Route::group([
	'middleware' => 'api',
	'prefix' => 'test',
], function ($router) {
	Route::get('/', 'TestController@getDepartmentTree');
});
// TESTING ============================================= END