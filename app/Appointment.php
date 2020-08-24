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
		'remarks'
	];
}
