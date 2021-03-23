<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class QuestionnaireRecord extends Model
{
    protected $fillable = [
        'superiors_record_id',
        'assessor_employee_id',
        'questionnaire_id',
        'questionnaire_item_id',
        'questionnaire_option_id',
    ];
}
