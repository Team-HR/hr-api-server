<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
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
