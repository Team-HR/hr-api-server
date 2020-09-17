<?php

namespace App\Http\Controllers\hrdms;

use App\Http\Resources\hrdms\HrdmsAppointment as HrdmsAppointmentResource;
use App\Models\hrdms\HrdmsAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Carbon\Traits\Timestamp;
use Illuminate\Support\Facades\DB;
use App\Events\AppointmentDocEvent;

class HrdmsAppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('log')->only(['control_search', 'complete', 'store']);
        $this->middleware('is_appointments_admin')->only('complete');
    }

    public function control_search(Request $request)
    {
        $request->validate([
            'id' => ['required', 'numeric'],
        ]);
        $appointment = HrdmsAppointment::find($request->input('id'));
        return response()->json(["status" => "success", "data" => $appointment]);
    }

    public function complete(Request $request)
    {
        $request->validate([
            'id' => ['required', 'numeric'],
        ]);
        $appointment = HrdmsAppointment::find($request->input('id'));
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

    public function index()
    {
        $appointments = HrdmsAppointmentResource::collection(HrdmsAppointment::orderBy('created_at', 'desc')->get());
        return response()->json(["status" => "success", "data" => $appointments], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'position' => 'required|max:255',
            'date_of_effectivity' => 'required',
        ]);
        $appointment = HrdmsAppointment::updateOrCreate(
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
        event(new AppointmentDocEvent());
        return response()->json(["status" => "success", "data" => $appointment]);
    }
}
