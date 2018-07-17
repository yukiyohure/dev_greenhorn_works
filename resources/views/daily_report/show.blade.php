@extends('partials.user_nav')

@section('content')

  <h1 class="brand-header">日報詳細</h1>

  <div class="container">
    <ul class="dailyreport-info-list">
      <li>
        <h3>日付</h3>
        {{ date("Y/m/d", strtotime($report->reporting_time)) }}
      </li>

      <li>
        <h3>タイトル</h3>
        {{ $report->title }}
      </li>

      <li>
        <h3>本文</h3>
        {{ $report->contents }}
      </li>
    </ul>
    
    <div class="btn-wrapper">
      <a class="btn btn-success" href="{{ route('report.edit', $report->id) }}">編集</a>
    </div>

    <div class="btn-wrapper">
      {!! Form::open(['route' => ['report.destroy', $report->id], 'method' => 'DELETE']) !!}
        <a href="{{ route('report.index') }}" class="btn">日報一覧画面へ</a>
        <button class="btn btn-danger" type="submit">削除</button>
      {!! Form::close() !!}
    </div>

@endsection
