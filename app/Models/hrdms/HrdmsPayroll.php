<?php

namespace App\Models\hrdms;

use Illuminate\Database\Eloquent\Model;

class HrdmsPayroll extends Model
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
