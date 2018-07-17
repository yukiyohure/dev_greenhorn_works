@extends('partials.user_nav')

@section('content')

  <h1 class="brand-header">勤務表更新</h1>
  <div class="container">
    {!! Form::open(['route' => ['schedule.update', $schedule->id], 'method' => 'put' , 'files' => 'true']) !!}
      <div class="form-group {{ Session::has('error') ? 'has-error' :''}}">
        {!! Form::label('year', '年'); !!}
        <td class="search-td">
          {!! Form::selectRange('year', date('Y')-10, date('Y')+10, old('year'), ['class' => 'form-control-custom', 'placeholder'=>'年']) !!}
        </td>
        <span class="help-block">{{ $errors->first('year') }}</span>
      </div>
      <div class="form-group {{ Session::has('error') ? 'has-error' :''}} ">
        {!! Form::label('month', '月'); !!}
        <td class="search-td">
          {!! Form::selectRange('month', 1, 12, old('month'), ['class' => 'form-control-custom', 'placeholder'=>'月']) !!}
        </td>
        <span class="help-block">{{ $errors->first('month') }}</span>
      </div>
      @if (Session::has('error'))
        <div class="has-error">
          <span class="help-block">{{ Session('error') }}</span>
        </div>
      @endif
      <div class="form-group">
        <span class="help-block">※勤務表の変更が不要な場合はファイルを選択する必要はありません</span>
      </div>
      <div class="form-group {{ $errors->has('schedule') ? 'has-error' :''}} ">
        {!! Form::file('schedule', null) !!}
        <span class="help-block">{{ $errors->first('schedule') }}</span>
      </div>
      <div>
        <img src="{{ url($schedule->file_path . $schedule->file_name) }}" alt="" width="350" height="350">
      </div>
      <button type="submit" class="btn btn-success pull-right">更新</button>
      {!! Form::close() !!}
    </div><!-- container closing tag -->

    <div class="bottom-btn-wrapper">
      <a href="{{ route('schedule.index') }}" class="bottom-btn">ホームへ</a>
    </div>

@endsection
