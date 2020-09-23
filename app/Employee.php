<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'ext_name'
    ];
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['full_name'];
    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        $firstName = $this->first_name;
        $lastName = $this->last_name;

        if ($this->middle_name == ".") {
            $middleName = "";
        } else {
            $middleName    = $this->middle_name;
            $middleName = $this->middle_name[0] . ".";
        }

        $extName    =    strtoupper($this->ext_name);
        $exts = array('JR', 'SR');

        if (in_array(substr($extName, 0, 2), $exts)) {
            $extName = " " . mb_convert_case($extName, MB_CASE_UPPER, "UTF-8");
        } else {
            $extName = " " . $extName;
        }

        $fullname =  mb_convert_case("$lastName, $firstName $middleName", MB_CASE_UPPER, "UTF-8") . $extName;

        return $fullname;
    }
}
