@extends('partials.admin_nav')

@section('content')
    
  <h2 class="brand-header">店舗登録</h2>
    <div class="container">
      {!! Form::open(['route' => ['admin.store.store']]) !!}
        <div class="form-group @if(!empty($errors->first('name'))) has-error @endif">
          <p>店舗名</p>
          {!! Form::input('text', 'name', null, ['class' => 'form-control', 'placeholder' => '例：◯△カメラ新宿店']) !!}
          <span class="help-block">{{$errors->first('name')}}</span>
        </div>
        <div class="form-group @if(!empty($errors->first('kana_name'))) has-error @endif">
          <p>店舗名(カタカナ)</p>
          {!! Form::input('text', 'kana_name', null, ['class' => 'form-control', 'placeholder' => '例：◯△カメラシンジュクテン']) !!}
          <span class="help-block">{{$errors->first('kana_name')}}</span>
        </div>
        <button type="submit" class="btn btn-success pull-right">追加</button>
      {!! Form::close() !!}
    </div><!-- container closing tag -->
    
  <div class="bottom-btn-wrapper">
    <a href="{{ route('admin.store.index') }}" class="bottom-btn">店舗一覧に戻る</a>
  </div>

@endsection
