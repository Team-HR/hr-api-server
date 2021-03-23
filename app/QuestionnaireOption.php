<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class QuestionnaireOption extends Model
{
    protected $fillable = [
        'questionnaire_item_id',
        'opt',
        'description',
    ];
}
