<?php

namespace App\Http\Controllers;

use App\Http\Resources\Payroll as PayrollResource;
use App\Payroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Carbon\Traits\Timestamp;
use Illuminate\Support\Facades\DB;

class PayrollController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('log')->only(['control_search', 'complete', 'store']);
        // $this->middleware('is_payroll_admin')->only('complete');
    }
    public function control_search(Request $request)
    {
        $request->validate([
            'id' => ['required', 'numeric'],
        ]);
        $model = Payroll::find($request->input('id'));
        return response()->json(["status" => "success", "data" => $model]);
    }

    public function complete(Request $request)
    {
        $request->validate([
            'id' => ['required', 'numeric'],
        ]);
        $model = Payroll::find($request->input('id'));
        $model->is_complete = 1;
        $date_received = $model->date_received;
        $date_completed = now();
        $model->date_completed = $date_completed;
        $starttimestamp = strtotime($date_received);
        $endtimestamp = strtotime($date_completed);
        $difference = abs($endtimestamp - $starttimestamp); // / 3600;
        $model->turn_around_time = $difference;
        $model->save();
        return response()->json(["status" => "success"], 201);
    }

    public function index()
    {
        $resource = PayrollResource::collection(Payroll::orderBy('created_at', 'desc')->get());
        return response()->json(["status" => "success", "data" => $resource], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'date1' => 'required',
            'date2' => 'required',
            'description' => 'required|max:255',
        ]);
        $model = Payroll::updateOrCreate(
            ['id' => $request->input('id')],
            [
                'date_received' => $request->input('date_received') ? $request->input('date_received') : now(),
                'date1' => $request->input('date1'),
                'date2' => $request->input('date2'),
                'description' => $request->input('description'),
                'needs_revision' => $request->input('needs_revision'),
                'remarks' => $request->input('remarks'),
                'is_complete' => $request->input('is_complete') ? $request->input('is_complete') : 0,
                'date_completed' => $request->input('date_completed')
            ]
        );
        return response()->json(["status" => "success", "data" => $model]);
    }
}
