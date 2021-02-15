<?php

namespace App\Models\rnr;

use Illuminate\Database\Eloquent\Model;

class RnrSurveyEsibRecord extends Model
{
    protected $fillable = [
        'id',   
        'year',
        'answers',
        'created_at',
        'updated_at'
    ];
}
