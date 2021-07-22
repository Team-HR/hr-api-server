<?php

namespace App\Http\Controllers;

use App\Http\Resources\selects\Employee as EmployeeSelectResource;
use App\Employee;
use App\Department;
use App\Office;
use App\Superior;
use App\SuperiorsRecord;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function getDepartmentTree()
    {
        // get all departments
            // get all offices
                // get all supervisors
                    // get all subordinates
        $departments = Department::all();
        $data = [];
        foreach ($departments as $department) {
            $data [] = array(
                "id" => $department->id,
                "department" => $department->department,
                "countOffices" => $department->countOffices,
                "offices" => $this->getOffices($department->id)
            );
        }
        // return $departments;
        // return $data[0];
        return response()->json($data);
    }
    public function getOffices($department_id)
    {
        $offices = Office::where('department_id',$department_id)->get(['id','office']);
        $data = [];
        foreach ($offices as $office) {
            $data [] = array(
                "id" => $office->id,
                "office" => $office->office,
                "superiors" => $this->getSups($office->id)
            );
        }
        return $data;
    }
    public function getSups($office_id)
    {
        $superiors = Superior::where('office_id',$office_id)->get(['id','employee_id']);
        $data = [];
        foreach ($superiors as $superior) {
            $data [] = array(
                "id" => $superior->id,
                "employee_id" => $superior->employee_id,
                "full_name" => $superior->full_name,
                "subordinates" => $this->getSubs($superior->id)
            );
        }
        return $data;
    }
    public function getSubs($superior_id)
    {
        $subordindates = SuperiorsRecord::where('superior_id',$superior_id)->get();//->get(['id','employee_id']);
        // var_dump($superiors);
        $data = [];
        foreach ($subordindates as $sub) {
            $data [] = array(
                "id" => $sub->id,
                // "superior_id" => $sub->superior_id,
                // "questionnaire_id" => $sub->questionnaire_id,
                "employee_id" => $sub->employee_id,
                "full_name" => $sub->name,
                "is_complete" => $sub->is_complete,
            );
        }
        return $data;
    }
}
