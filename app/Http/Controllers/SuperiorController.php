<?php

namespace App\Http\Controllers;
use App\Office;
use App\Superior;
use App\SuperiorsRecord;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

// QUESTIONNAIRE MODELS
use App\Questionnaire;
use App\QuestionnaireItem;
use App\QuestionnaireOption;
use App\QuestionnaireRecord;
use App\Employee;



class SuperiorController extends Controller
{

    public function get_superiors($office_id){
        $superiors = Superior::where("office_id","=",$office_id)->get();
        return response()->json($superiors);
    }

    public function get_superior($superior_id){
        $superior = Superior::find($superior_id);
        return response()->json($superior);
    }

    public function create(Request $request)
    {
        $superior_employee_id = $request->superior_employee_id;
        $superior_id = $request->superior_id;
        $office_id = $request->office_id;
        $subordinates = $request->subordinates;
        // if $superior_id == null
        if (!$superior_id) {
            // create new superior
            $superior = new Superior;
            $superior->employee_id = $superior_employee_id;
            $superior->active = 1;
            $superior->office_id = $office_id;
            $superior->save();
            // get insert_id and assign to $superior_id 
            $superior_id = $superior->id;
            // and create new subordinates with $superior_id from $request->subordinates array
            foreach ($subordinates as $subordinate) {
                $record = new SuperiorsRecord;
                $record->superior_id = $superior_id;
                $record->employee_id = $subordinate["employee_id"];
                $record->questionnaire_id = 1;
                $record->is_complete = 0;
                $record->save();
            }   
        }
        // else if $superior_id == true delete all subordinates with $superior_id == $request->superior_id and create new list of subordinates from $request->subordinates array
        // else {
        // }

        return response()->json($superior_id);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $surveys = Survey::all();
        // return response()->json($surveys);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
