<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class QuestionnaireItem extends Model
{
    protected $fillable = [
        'questionnaire_id',
        'item_no',
        'question',
        'description',
        'type',
    ];
}
