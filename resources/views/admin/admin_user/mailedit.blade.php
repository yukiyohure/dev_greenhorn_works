@extends('partials.admin_nav')

@section('content')
<div class="container">
  <div class="panel-heading">
    <h2>メールアドレスの変更</h2>
  </div>
  <p class="pull-right"><a href="{{ route('admin.adminuser.index') }}">一覧に戻る</a></p>
  <div class="panel-body">
    {!! Form::open(['route' => ['admin.adminuser.sendmail']]) !!}
    {!! Form::hidden('email', $adminuser->info->email, ['class' => 'form-control']) !!}
      <p>送信ボタンをクリックで以下のメールアドレスに変更用のメールを送信致します。</p>
      <div class="container__box">
        <p class="container__box__txt">{{ $adminuser->info->email }}<span class="container__box__link"></span></p>
      </div>
      <button type="submit" class="btn btn-success pull-right">送信</button>
    {!! Form::close() !!}
  </div>
</div>
@endsection
