<?php

namespace App\Http\Controllers;

use App\Http\Resources\selects\Employee as EmployeeSelectResource;
use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return response()->json($employees);
    }

    public function get_select_items($department_id)
    {
        // $department_id = "";
        $employee = Employee::orderBy('last_name', 'asc');

        if ($department_id) {
            $employee = $employee->where('department_id', $department_id);
        }
        
        $employees = EmployeeSelectResource::collection($employee->get());
        return response()->json($employees);
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
        $request->validate([
            'gender' => 'required|max:6',
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:1',
        ]);
        // $model = HrdmsTlb::updateOrCreate(
        //     ['id' => $request->input('id')],
        //     [
        //         'date_received' => $request->input('date_received') ? $request->input('date_received') : now(),
        //         'name' => $request->input('name'),
        //         'description' => $request->input('description'),
        //         'needs_revision' => $request->input('needs_revision'),
        //         'remarks' => $request->input('remarks'),
        //         'is_complete' => $request->input('is_complete') ? $request->input('is_complete') : 0,
        //         'date_completed' => $request->input('date_completed')
        //     ]
        // );
        return response()->json($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
