<?php

namespace App\Http\Controllers;

use App\Http\Resources\selects\Department as DepartmentSelectResource;
use App\Department;
use App\Section;
use App\Office;
use App\Superior;
use App\SuperiorsRecord;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function getDepartmentTree()
    {
        // get all departments
            // get all offices
                // get all supervisors
                    // get all subordinates
        // $departments = Department::all();
        // $data = [];
        // foreach ($departments as $department) {
        //     $data [] = array(
        //         "id" => $department->id,
        //         "department" => $department->department,
        //         "countOffices" => $department->countOffices,
        //         "offices" => $this->getOffices($department->id)
        //     );
        // }
        // return $departments;
        // return $data[0];
        return response()->json("test");
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();
        return response()->json($departments);
    }

    public function get_info($department_id)
    {
        $department = Department::find($department_id);
        $department["department"] = mb_convert_case($department["department"],MB_CASE_UPPER);
        return response()->json($department);
    }

    public function get_select_items()
    {
        $departments = DepartmentSelectResource::collection(Department::orderBy('department', 'asc')->get());
        return response()->json($departments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function get_offices($department_id)
    {
        $sections = Office::where('department_id','=',$department_id)->get();
        return response()->json($sections);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
    }
}
