<?php

namespace App\Models\rnr;

use Illuminate\Database\Eloquent\Model;

class RnrSurveyRecord extends Model
{
    protected $fillable = [
        'id',   
        'rnr_survey_id',
        'surveyor',
        'answers',
        'created_at',
        'updated_at'
    ];
}
