<?php

namespace App\Models\hrdms;

use Illuminate\Database\Eloquent\Model;

class HrdmsTlb extends Model
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
