<?php

namespace App;

use App\QuestionnaireItem;
use App\QuestionnaireRecord;
use App\Employee;
use Illuminate\Database\Eloquent\Model;

class SuperiorsRecord extends Model
{
    protected $fillable = [
        'superior_id',
        'employee_id',
        'questionnaire_id',
        'office_id',
        'is_complete'
    ];
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['name', 'office', 'competency_records'];
    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        $employee_id = $this->employee_id;
        $employee = Employee::find($employee_id);
        $full_name = $employee->full_name;
        return $full_name;
    }

    /**
     * Get the user's office.
     *
     * @return string
     */
    public function getOfficeAttribute()
    {
        // $department_id = $this->department_id;
        // $department = "NO DEPT ASSIGNED";
        // if (!$department_id) {
        //     return $department;
        // }

        // $department = Department::find($department_id);
        // $department = $department->department;
        $department = "Test Department";
        return $department;
    }
    /**
     * Get the peer's data.
     * checks if peer has data in questionnaire entries if not return empty array
     * @return array
     */
    public function getCompetencyRecordsAttribute()
    {
        $records = array();
        // $items = QuestionnaireRecord::where('superiors_record_id', $this->id)->get(['id','questionnaire_item_id','questionnaire_option_id']);
        // foreach ($items as $item) {
        //     // $data[] = $item->questionnaire_option_id;
        //     $data[] = $item;
        // }
        // return $records;
        $questionnaire_id = 1;
        $items = QuestionnaireItem::where('questionnaire_id', $questionnaire_id)->get(['id']);
        foreach ($items as $item) {
            // $data[] = $item->questionnaire_option_id;
            $opt = QuestionnaireRecord::where([
                'superiors_record_id' => $this->id,
                'questionnaire_item_id' => $item->id
            ])->get(['id','questionnaire_option_id'])->first();

            $questionnaire_record_id = $opt?$opt->id:null;
            $questionnaire_option_id = $opt?$opt->questionnaire_option_id:null;
            $records[] = array(
                'questionnaire_record_id' => $questionnaire_record_id,
                'questionnaire_item_id' => $item->id,
                'questionnaire_option_id' => $questionnaire_option_id
            );
            // $rec = QuestionnaireRecord::where('questionnaire_id', $item->id)->get(['id']);
        }
        return $records;
    }

}
