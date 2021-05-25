<?php

namespace App;
// use App\Department;
// use App\Employee;
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
    protected $appends = ['full_name'];
    /**
     * Get the user's full name.
     *
     * @return string
     */

    public function getFullNameAttribute()
    {
        $employee = Employee::find($this->employee_id);
        return $employee->full_name;
    }
}
