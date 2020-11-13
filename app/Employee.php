<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'ext_name',
        'gender',
        'status',
        'status',
        'employment_status',
        'position_id',
        'department_id',
        'nature_of_assignment',
        'date_activated',
        'date_inactivated',
        'date_ipcr',
    ];
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['full_name','department'];
    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        $firstName = $this->first_name;
        $lastName = $this->last_name;

        $middleName = "";
        if ($this->middle_name) {
            $middleName    = $this->middle_name;
            $middleName = $this->middle_name[0] . ".";
        }


        $extName = "";
        if ($this->ext_name) {
            $extName    =    strtoupper($this->ext_name);
            $exts = array('JR', 'SR');

            if (in_array(substr($extName, 0, 2), $exts)) {
                $extName = " " . mb_convert_case($extName, MB_CASE_UPPER, "UTF-8");
            } else {
                $extName = " " . $extName;
            }
        }

        $fullname =  mb_convert_case("$lastName, $firstName $middleName", MB_CASE_UPPER, "UTF-8") . $extName;

        return $fullname;
    }


    public function getDepartmentAttribute()
    {
        $department_id = $this->department_id;
        $department = "";
        if (!$department_id) {
            return $department;
        }

        

        return $department;
    }
}
