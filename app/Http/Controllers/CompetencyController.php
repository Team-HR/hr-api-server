<?php

namespace App\Http\Controllers;

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
use App\Office;

class CompetencyController extends Controller
{
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
     * Display a listing of peers for competency assessment
     * under the authenticated employee if supervisor
     * @return \Illuminate\Http\Response
     */
    public function get_peers()
    {
        // get employee_id of the auth user
        // $employee_id = auth()->user()->employee_id;
        $employee_id = 9;

        // get sup id
        $superior = Superior::where('employee_id', $employee_id)
            ->get();
        $superior_id = $superior[0]->id;

        // get peers
        $peers = SuperiorsRecord::where('superior_id', $superior_id)->get();

        $data = array();

        foreach ($peers as $peer) {
            array_push(
                $data,
                array(
                    'superiors_record_id' => $peer->id,
                    'superior_id' => $peer->superior_id,
                    'employee_id' => $peer->employee_id,
                    'full_name' => $peer->name,
                    'questionnaire_id' => $peer->questionnaire_id,
                    'is_complete' => $peer->is_complete,
                    'competency_records' => $peer->competency_records,
                )
            );
        }
        return response()->json($data);
    }

    /**
     * Get list of employees without assigned supervisor and questionnaire.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_free_employees()
    {
        $data = array();
        // $employees = Employee::all();
        // foreach ($employees as $employee) {
        //     array_push(
        //         $data,
        //         array(
        //             'employee_id' => $employee->id,
        //             'full_name' => $employee->full_name,
        //         )
        //     );
        // }
        // return response()->json($data);
        //  get authed user id and find superior_idsuperiors
        // $auth_employee_id = auth()->user()->employee_id;
        $auth_employee_id = 9;
        $superior_id = Superior::where('employee_id', $auth_employee_id)->get('id')->first()['id'];
        //  get questionnaire_id
        $questionnaire_id = 1;

        $employees = SuperiorsRecord::where([
            ['superior_id', '=', $superior_id],
            ['questionnaire_id', '=', $questionnaire_id]
        ])->get(['employee_id']);
        $emps_in_rec = array();

        foreach ($employees as $employee) {
            array_push(
                $emps_in_rec,
                $employee->employee_id
            );
        }
        $free_emps = array();
        $data = Employee::whereNotIn('id', $emps_in_rec)->get();
        foreach ($data as $dat) {
            array_push(
                $free_emps,
                array(
                    'employee_id' => $dat->id,
                    'full_name' => $dat->full_name,
                )
            );
        }
        return response()->json($free_emps);
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
     * Store (create or update) peer data to questionnaire records to DB.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $assessor_employee_id = auth()->user()->employee_id;
        $competency_records = $request->competency_records;


        // check if competency_records dont have 'empties'

        // foreach ($competency_records as $rec) {
        //    if($rec['questionnaire_option_id'] = null){
        //     return response()->json('inc');
        //    } else continue;
        // }

        foreach ($competency_records as $rec) {
            $records = QuestionnaireRecord::updateOrCreate(
                ['id' => $rec['questionnaire_record_id']],
                [
                    'superiors_record_id' => $request['superiors_record_id'],
                    'questionnaire_id' => 1,
                    'assessor_employee_id' => $assessor_employee_id,
                    'questionnaire_item_id' => $rec['questionnaire_item_id'],
                    'questionnaire_option_id' => $rec['questionnaire_option_id'],
                ]
            );
        }



        SuperiorsRecord::where('id', $request['superiors_record_id'])
            ->update(['is_complete' => 1]);


        // $request->validate([
        //         'title' => 'required|min:6',
        // ]);

        return response()->json('saved!');
    }



    /**
     * Add peer to supervisor records.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_peer(Request $request)
    {
        //  get authed user id and find superior_idsuperiors
        $auth_employee_id = auth()->user()->employee_id;
        $superior_id = Superior::where('employee_id', $auth_employee_id)->get('id')->first()['id'];
        //  get questionnaire_id
        $questionnaire_id = 1;
        //  db insert

        $record = new SuperiorsRecord;

        $record->superior_id = $superior_id;
        $record->employee_id = $request->employee_id;
        $record->questionnaire_id = $questionnaire_id;
        $record->is_complete = 0;

        $record->save();


        $data = array(
            'competency_records' => $record->competency_records,
            'employee_id' => $record->employee_id,
            'full_name' => $record->name,
            'is_complete' => $record->is_complete,
            'questionnaire_id' => $record->questionnaire_id,
            'superior_id' => $record->superior_id,
            'superiors_record_id' => $record->id,
        );


        return response()->json($data);
    }

    /**
     * Remove peer from supervisor records  .
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete_peer(Request $request)
    {
        $employee = $request->employee;
        $superiors_record_id = $employee['superiors_record_id'];
        // delete emp from SuperiorsRecord
        $rec = SuperiorsRecord::find($superiors_record_id);
        $rec->delete();
        // delete emps recs from QuestionnaireRecord
        $qrec = QuestionnaireRecord::where('superiors_record_id', $superiors_record_id)->delete();
        return response()->json($superiors_record_id . ": Deleted!");
    }


    /**
     * Store once initially the quesionnaire to DB.superiors_record_id
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_competencies_questionnaires(Request $request)
    {

        // $request->validate([
        //         'title' => 'required|min:6',
        // ]);
        // $model = SuperiorsRecord::updateOrCreate(
        //     ['id' => $request->input('id')],
        //     [
        //         'title' => $request->input('data'),
        //         'roles' => $request->input('type'),
        //     ]
        // );


        // Questionnaire
        // QuestionnaireItem
        // QuestionnaireOption
        // QuestionnaireRecord


        // COMPETENCIES
        // title
        // description
        // levels
        // // proficiency
        // // behaviors

        $comps = $request->all();
        foreach ($comps as $comp) {
            $qi = new QuestionnaireItem;
            $qi->questionnaire_id = 1;
            $qi->question = $comp['title'];
            $qi->description = $comp['description'];
            $qi->save();
            $inserted_id = $qi->id;

            foreach ($comp['levels'] as $level) {
                $qo = new QuestionnaireOption;
                $qo->questionnaire_item_id = $inserted_id;
                $qo->opt = $level['proficiency'];
                $qo->description = json_encode($level['behaviors']);
                $qo->save();
            }
        }
        return response()->json("saved!");
    }



    /**
     * Get quesionnaire data from DB.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get_questionnaire()
    {
        $competencies = array();
        // Questionnaire
        // QuestionnaireItem
        // QuestionnaireOption
        // QuestionnaireRecord

        // COMPETENCIES
        // title
        // description
        // levels
        // // proficiency
        // // behaviors
        $questionnaire_items = QuestionnaireItem::where('questionnaire_id', 1)->get();
        foreach ($questionnaire_items as $questionnaire_item) {
            $item_id = $questionnaire_item['id'];

            $levels = array();
            $options = QuestionnaireOption::where('questionnaire_item_id', $item_id)->get();
            foreach ($options as $opt) {
                $levels[] = array(
                    'questionnaire_option_id' => $opt['id'],
                    'proficiency' => $opt['opt'],
                    'behaviors' => json_decode($opt['description']),
                );
            }

            $competencies[] = array(
                'questionnaire_item_id' => $item_id,
                'title' => $questionnaire_item['question'],
                'description' => $questionnaire_item['description'],
                'levels' => $levels
            );
        }

        // $options = QuestionnaireOption::where('questionnaire_item_id',1)->get();
        // $competencies = $options;
        return response()->json($competencies);
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
