<?php

namespace App;
// use App\Section;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'department',
    ];
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['countOffices',];
    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getCountOfficesAttribute()
    {
        $department_id = $this->id;
        $count = Office::where('department_id', $department_id)->count();
        return $count;
    }

}
