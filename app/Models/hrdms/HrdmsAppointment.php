<?php

namespace App\Models\hrdms;

use Illuminate\Database\Eloquent\Model;

class HrdmsAppointment extends Model
{
	protected $fillable = [
		'id',
		'date_received',
		'name',
		'position',
		'date_of_effectivity',
		'needs_revision',
		'remarks',
		'is_complete',
		'date_completed',
		'turn_around_time'
	];
}
