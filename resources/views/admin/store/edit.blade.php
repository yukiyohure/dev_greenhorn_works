@extends('partials.admin_nav')

@section('content')

  <h1 class="brand-header">店舗情報の更新</h1>
  
  <div class="container">
    {!! Form::open(['route' => ['admin.store.update', $store->id], 'method'=> 'PUT']) !!}
    {!! Form::hidden('id', $store->id, ['class' => 'form-control']) !!}
      <div class="form-group {{ $errors->has('name')? 'has-error' : '' }}">
        <p>店舗名</p>
        {!! Form::input('text', 'name', $store->name, ['class' => 'form-control']) !!}
        <span class="help-block">{{$errors->first('name')}}</span>
      </div>
      <div class="form-group {{ $errors->has('kana_name')? 'has-error' : '' }}">
        <p>店舗名(カタカナ)</p>
        {!! Form::input('text', 'kana_name', $store->kana_name, ['class' => 'form-control']) !!}
        <span class="help-block">{{$errors->first('kana_name')}}</span>
      </div>
      <button type="submit" class="btn btn-success pull-right">更新</button>
    {!! Form::close() !!}
  </div><!-- container closing tag -->

  <div class="bottom-btn-wrapper">
    {!! Form::open(['route'=>['admin.store.destroy',$store->id],'method'=>'DELETE']) !!}
      <a href="{{ route('admin.store.index') }}" class="btn">店舗一覧へ</a> 
      <button class="button-danger btn" type="submit">削除</button>
    {!! Form::close() !!}
  </div>

@endsection
