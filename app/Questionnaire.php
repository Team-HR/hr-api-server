<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    protected $fillable = [
        'title',
        'is_accepting',
        'departments',
        'allow_self',
        'type',
    ];
}
