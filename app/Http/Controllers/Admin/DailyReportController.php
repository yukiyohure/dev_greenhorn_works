<?php

namespace App\Http\Controllers\Admin;

use App\Models\DailyReports;
use App\Models\UserInfos;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\DailyReportsRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DailyReportController extends Controller
{

    protected $report;
    protected $user_info;

    public function __construct(DailyReports $report, UserInfos $user_info)
    {
        $this->middleware('auth:admin');
        $this->report = $report;
        $this->user_info = $user_info;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DailyReportsRequest $request)
    {
        // ユーザーの入力した値を連想配列で取得
        // inputs: (first_name, last_name, start-date, end-date)
        $inputs = $request->all();
        // あるユーザーの日報を日付の範囲で指定し、取得。
        if (empty($inputs)) {
            $reports = $this->report->orderBy('reporting_time','desc')->get();
        } else {
          $reports = $this->report->getReportsBySearching($inputs);
        }
        //$reports = $this->report->getReportsBySearching($inputs);
        return view('admin.daily_report.index', compact('reports'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = $this->report->find($id);
        return view('admin.daily_report.show', compact('report'));
    }
}

