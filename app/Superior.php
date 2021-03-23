<?php

namespace App;
// use App\Department;
use Illuminate\Database\Eloquent\Model;

class Superior extends Model
{
    protected $fillable = [
        'employee_id',
        'active',
        'office_id'
    ];
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    // protected $appends = ['full_name','office'];
    /**
     * Get the user's full name.
     *
     * @return string
     */
    /* public function getFullNameAttribute()
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
        $department = "NO DEPT ASSIGNED";
        if (!$department_id) {
            return $department;
        }

        $department = Department::find($department_id);
        $department = $department->department;

        return $department;
    } */
}
