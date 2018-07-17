@extends('partials.user_nav')

@section('content')

  <h2 class="brand-header">日報</h2>

  <div class="container">
    {!! Form::open(['route' => 'report.store']) !!}
      <div class="form-group @if(!empty($errors->first('date'))) has-error @endif">
        {!! Form::input('date', 'date', null, ['class' => 'form-control']) !!}
        <span class="help-block">{{$errors->first('date')}}</span>
      </div>
      <div class="form-group @if(!empty($errors->first('title'))) has-error @endif">
        {!! Form::input('text', 'title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
        <span class="help-block">{{$errors->first('title')}}</span>
      </div>
      <div class="form-group @if(!empty($errors->first('contents'))) has-error @endif">
        {!! Form::textarea('contents', null, ['class' => 'form-control', 'placeholder' => '本文']) !!}
        <span class="help-block">{{$errors->first('contents')}}</span>
      </div>
      <button type="submit" class="btn btn-success pull-right">追加</button>
    {!! Form::close() !!}
  </div>

  <div class="bottom-btn-wrapper">
    <a href="{{ route('report.index') }}" class="btn">日報一覧画面へ</a>
  </div>
  
@endsection
