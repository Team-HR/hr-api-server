<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tlb extends Model
{
    protected $fillable = [
        'id',
        'date_received',
        'name',
        'description',
        'needs_revision',
        'remarks',
        'is_complete',
        'date_completed',
        'turn_around_time'
    ];
}
