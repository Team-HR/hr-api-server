<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Department;
use App\Section;

class Office extends Model
{
    protected $fillable = [
        'department_id',
        'section_id',
        'office'
    ];

    protected $appends = ['section','department'];

	public function getSectionAttribute()
    {
        $section_id = $this->section_id;
        $section = "";
        if (!$section_id) {
            return $section;
        }

        $section = section::find($section_id);
        $section = $section->section;
		return $section;
    }

	public function getDepartmentAttribute()
	{

		$department_id = $this->department_id;
        $department = "";
        if (!$department_id) {
            return $department;
        }

        $department = Department::find($department_id);
        $department = $department->department;
		return $department;
	}


}
