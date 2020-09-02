<?php

namespace App\Http\Controllers;

use App\Http\Resources\Appointment as AppointmentResource;
use App\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Carbon\Traits\Timestamp;
use Illuminate\Support\Facades\DB;
use Validator;

class AppointmentController extends Controller
{
    // public function __construct()
    // {
    // $this->middleware('auth:api', ['except' => ['login', 'register']]);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function control_search($id)
    {
        $appointment = DB::table('appointments')->find($id);
        // $appointment = Appointment::firstOrNew(
        // );
        return response()->json(["status" => "success", "data" => $appointment], 200);
    }

    public function complete(Request $request)
    {
        $appointment = Appointment::find($request->input('id'));
        $appointment->is_complete = 1;
        $date_received = $appointment->date_received;
        $date_completed = now();
        $appointment->date_completed = $date_completed;
        $starttimestamp = strtotime($date_received);
        $endtimestamp = strtotime($date_completed);
        $difference = abs($endtimestamp - $starttimestamp); // / 3600;
        $appointment->turn_around_time = $difference;
        $appointment->save();
        return response()->json(["status" => "success"], 201);
    }
    // function differenceInHours($startdate,$enddate){

    // }

    public function index()
    {
        $appointments = AppointmentResource::collection(Appointment::orderBy('created_at', 'desc')->get()); //->keyBy->id);
        // $appointments = $appointments->sortByDesc('created_at');
        return response()->json(["status" => "success", "data" => $appointments], 200);
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
        $appointment = Appointment::updateOrCreate(
            ['id' => $request->input('id')],
            [
                'date_received' => $request->input('date_received') ? $request->input('date_received') : now(),
                'name' => $request->input('name'),
                'position' => $request->input('position'),
                'date_of_effectivity' => $request->input('date_of_effectivity'),
                'needs_revision' => $request->input('needs_revision'),
                'remarks' => $request->input('remarks'),
                'is_complete' => $request->input('is_complete') ? $request->input('is_complete') : 0,
                'date_completed' => $request->input('date_completed')
            ]
        );
        return response()->json(["status" => "success"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
