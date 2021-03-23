<?php

namespace App\Http\Controllers\rnr;

use App\Models\rnr\RnrSurvey;
use App\Models\rnr\RnrSurveyRecord;
use App\Models\rnr\RnrSurveyEsibRecord;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RnrSurveyController extends Controller
{

    /**
     * Get awardee information in json.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_awardee($id)
    {
        $rnr_surveys = RnrSurvey::find($id);
        // $rnr_surveys = RnrSurvey::all();
        return response()->json($rnr_surveys);
    }

    // public function get_select_items($department_id)
    // {
    //     // $department_id = "";
    //     $employee = Employee::orderBy('last_name', 'asc');

    //     if ($department_id && $department_id != 0) {
    //         $employee = $employee->where('department_id', $department_id);
    //     }

    //     $employees = EmployeeSelectResource::collection($employee->get());
    //     return response()->json($employees);
    // }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $rules = [
        //     'name' => 'required|min:8|max:255',
        //     'username' => 'required|min:3|max:20|unique:users',
        //     'roles' => 'required',
        //     'password' => 'required|min:4'
        // ];

        // $request->validate($rules);
        $rnr_survey_record = new RnrSurveyRecord;
        $rnr_survey_record->rnr_survey_id = $request->input('id');
        $rnr_survey_record->answers = serialize($request->input('answers'));
        // $rnr_survey_record->password = bcrypt($request->input('password'));
        $rnr_survey_record->save();

        return response()->json(["status" => "success", "data" => $rnr_survey_record]);
    }

    public function store_esib_2020(Request $request)
    {
        // $rules = [
        //     'name' => 'required|min:8|max:255',
        //     'username' => 'required|min:3|max:20|unique:users',
        //     'roles' => 'required',
        //     'password' => 'required|min:4'
        // ];

        // $request->validate($rules);
        $records = new RnrSurveyEsibRecord;
        $records->answers = serialize($request->input('answers'));
        // $rnr_survey_record->password = bcrypt($request->input('password'));
        $records->save();

        return response()->json(["status" => "success", "data" => $records]);
    }
    
    // public function store(Request $request)
    // {
    //     $rules = [
    //         'name' => 'required|min:8|max:255',
    //         'username' => 'required|min:3|max:20|unique:users',
    //         'roles' => 'required',
    //         'password' => 'required|min:4'
    //     ];

    //     $request->validate($rules);
    //     $user = new User;
    //     $user->name = $request->input('name');
    //     $user->username = $request->input('username');
    //     $user->roles = $request->input('roles');
    //     $user->password = bcrypt($request->input('password'));
    //     $user->save();

    //     return response()->json(["status" => "success", "data" => $user]);
    // }


    /**
     * Display the specified resource.
     *
     * @param  \App\Plantilla  $plantilla
     * @return \Illuminate\Http\Response
     */
    public function show(Plantilla $plantilla)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plantilla  $plantilla
     * @return \Illuminate\Http\Response
     */
    public function edit(Plantilla $plantilla)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plantilla  $plantilla
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plantilla $plantilla)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plantilla  $plantilla
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plantilla $plantilla)
    {
        //
    }
}
