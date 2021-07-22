<?php

namespace App\Http\Controllers;

use App\Http\Resources\selects\Employee as EmployeeSelectResource;
use App\Employee;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        return response()->json("testing!");
    }

}
