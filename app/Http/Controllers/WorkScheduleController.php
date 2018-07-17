<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkSchedules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\WorkScheduleRequest;
use Intervention\Image\ImageManagerStatic as Image;
use Validator;

class WorkScheduleController extends Controller
{
    protected $schedule;

    public function __construct(WorkSchedules $schedule)
    {
        $this->middleware('auth');
        $this->schedule = $schedule;
    }

    /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
    public function index(Request $request)
    {
        $userId = Auth::id();
        $input = $request->all();
        $schedules = $this->schedule->getSchedules($input, $userId);

        return view('work_schedule.index', compact('schedules'));
    }

    /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
    public function create()
    {
        return view('work_schedule.create');
    }

    /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
    public function store(WorkScheduleRequest $request)
    {
        $userId = Auth::id();
        $input = $request->all();

        //同年月の勤務表が存在しないか確認
        $errMsg = $this->schedule->checkDate($input['year'], $input['month'], $userId);
        //同年月の勤務表が存在する場合は元の画面にリダイレクト
        if (!empty($errMsg)) {
            $request->session()->flash('error', $errMsg);
            return redirect()->route('schedule.create');
        }
        //ファイル保存
        $fileInfos = $this->schedule->saveUploadFile($input['schedule'], $userId);
        //データベースへ保存
        $this->schedule->createSchedule($userId, $fileInfos, $input['year'], $input['month']);

        return redirect()->route('schedule.index');
    }

    public function edit($id)
    {
        $schedule = $this->schedule->find($id);
        return view('work_schedule.edit')->with(compact('schedule'));
    }

    public function update(WorkScheduleRequest $request, $id)
    {
        $userId = Auth::id();
        $input = $request->all();

        //同年月の勤務表が存在しないか確認
        $errMsg = $this->schedule->checkDate($input['year'], $input['month'], $userId, $id);
        //同年月の勤務表が存在する場合は元の画面にリダイレクト
        if (!empty($errMsg)) {
            $request->session()->flash('error', $errMsg);
            return redirect()->route('schedule.edit', $id);
        }

        $fileInfos = null;
        //ファイルがアップロードされたか確認
        if (array_key_exists('schedule', $input)) {
            //ファイルがアップロードされた場合は保存処理
            $fileInfos = $this->schedule->saveUploadFile($input['schedule'], $userId);
        }
        //データベースの更新
        $this->schedule->updateSchedule($fileInfos, $input['year'], $input['month'], $id);

        return redirect()->route('schedule.index');
    }

    /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
    public function destroy($id)
    {
        $data = $this->schedule->find($id);
        $data->delete();

        return redirect()->route('schedule.index');
    }

}

