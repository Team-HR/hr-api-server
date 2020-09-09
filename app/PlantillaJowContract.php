<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlantillaJowContract extends Model
{
    protected $fillable = [
        'id',
        'date_received',
        'date1',
        'date2',
        'description',
        'needs_revision',
        'remarks',
        'is_complete',
        'date_completed',
        'turn_around_time'
    ];
}
