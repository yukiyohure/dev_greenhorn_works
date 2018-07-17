<?php
//日報の日付をstringからdatetimeに変換
 $reporting_time = date("Y-m-d", strtotime($report->reporting_time));
 ?>

@extends('partials.user_nav')

@section('content')

  <h1 class="brand-header">日報詳細・編集</h1>
 
  <div class="container">
    {!! Form::open(['route' => ['report.update', $report->id], 'method' => 'PUT']) !!}
      <div class="form-group @if(!empty($errors->first('date'))) has-error @endif">
        {{ Form::input('date', 'date', $reporting_time, ['class' => 'form-control']) }}
        <span class="help-block">{{$errors->first('date')}}</span>
      </div>
      <div class="form-group @if(!empty($errors->first('title'))) has-error @endif">
        {!! Form::input('text', 'title', $report->title, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
        <span class="help-block">{{$errors->first('title')}}</span>
      </div>
      <div class="form-group @if(!empty($errors->first('contents'))) has-error @endif">
        {!! Form::textarea('contents', $report->contents, ['class' => 'form-control', 'placeholder' => '本文']) !!}
        <span class="help-block">{{$errors->first('contents')}}</span>
      </div>
      <button type="submit" class="btn btn-success pull-right">更新</button>
    {!! Form::close() !!}
  </div><!-- container closing tag -->

  <div class="bottom-btn-wrapper">
    <a href="{{ route('report.index') }}" class="btn">日報一覧画面へ</a>
  </div>

@endsection