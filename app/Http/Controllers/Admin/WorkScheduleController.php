<?php

namespace App\Http\Controllers\admin;

use App\Models\WorkSchedules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\WorkScheduleRequest;

class WorkScheduleController extends Controller
{
    protected $schedule;

    public function __construct(WorkSchedules $schedule)
    {
        $this->middleware('auth:admin');
        $this->schedule = $schedule;
    }
    /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
    */
    public function index(WorkScheduleRequest $request)
    {
        $input = $request->all();
        $schedules = $this->schedule->getSchedules($input);
        return view('admin.work_schedule.index', compact('schedules'));
    }
}

