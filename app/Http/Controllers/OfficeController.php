<?php

namespace App\Http\Controllers;

use App\Http\Resources\selects\Department as DepartmentSelectResource;
use Illuminate\Http\Request;
use App\Office;
use App\Superior;

class OfficeController extends Controller
{

    // public function get_offices()
    // {
    //     $offices = Office::all();
    //     return response()->json($offices);
    // }

    public function get_offices($department_id)
    {
        $sections = Office::where('department_id','=',$department_id)->get();
        return response()->json($sections);
    }


    /**
     * Save new office to offices db
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $department_id = $request->department_id;
        // $section_id = NULL;
        $office = $request->office;
        $office = new Office;
        $office->department_id = $request->department_id;
        $office->office = $request->office;
        $office->save();
        return response()->json($request->all());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
    public function show($id)
    {
        $office = Office::find($id);
        $office["officeTitle"] = mb_convert_case($office["office"], MB_CASE_TITLE);
        return response()->json($office);
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
