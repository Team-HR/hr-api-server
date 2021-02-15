<?php

namespace App\Models\rnr;

use Illuminate\Database\Eloquent\Model;

class RnrSurvey extends Model
{
    protected $fillable = [
        'id',   
        'awardee',
        'award',
        'created_at',
        'updated_at'
    ];
}
