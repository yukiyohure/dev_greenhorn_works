<?php

namespace App\Http\Controllers;

use App\Models\DailyReports;
use Illuminate\Http\Request;
use App\Http\Requests\DailyReportRequest;
use Illuminate\Support\Facades\Auth;

class DailyReportController extends Controller
{

  protected $report;

  public function __construct(DailyReports $report)
  {
      $this->middleware('auth');
      $this->report = $report;
  }

    /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
    public function index(Request $request)
    {
        dd('kanatani');
        $inputs = $request->all();
        $inputs['id'] = Auth::id();

        //ユーザーからのインプットを正常化
        $inputs = $this->report->normalizeInputs($inputs);

        // あるユーザーのレポート情報を日付の範囲を指定し、contentsを取得。
        $reports = $this->report->getReportsByDateRange($inputs);

        return view('daily_report.index', compact('reports'));

    }

    /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
    public function store(DailyReportRequest $request)
    {
        $userId = Auth::id();

        $input = $request->all();
        $this->report->create([
            'user_id' => $userId,
            'reporting_time' => $input['date'],
            'title' => $input['title'],
            'contents' =>$input['contents'],
        ]);

        return redirect()->to('report');
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
        return view('daily_report.show', compact('report'));
    }

    /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
    public function edit($id)
    {
        $report = $this->report->find($id);
        return view('daily_report.edit', compact('report'));
    }

    /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
    public function update(DailyReportRequest $request, $id)
    {
        $userId = Auth::id();
        $input = $request->all();
        $this->report->update([
            'user_id'        => $userId,
            'reporting_time' => $input['date'],
            'title'          => $input['title'],
            'contents'       => $input['contents'],
        ],$id);

        return redirect()->to('report');
    }

    /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
    public function destroy($id)
    {

        $data = $this->report->find($id);
        $data->delete();

        return redirect()->to('report');
    }

    public function create()
    {
        return view('daily_report.create');
    }

}

