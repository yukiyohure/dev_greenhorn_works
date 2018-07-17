@extends('partials.admin_nav')
@section('content')


<?php $message_placeholder = '例）ユーザーと店舗を作成・更新・編集したいので、その権限を頂けますか？'; ?>


<div style="padding: 30px"> <!-- このstyle属性は一時的処置です -->
  <h1>権限申請</h1>
  {!! Form::open(['route' => 'admin.access_right.sendMail', 'method' => 'post']) !!}
    <label>
      承認者
    </label>
    {!!
        Form::select('authorizer_id',
                      [null => '承認者選択'] + array_pluck($adminuserinfos, 'last_name', 'id'),
                      null,
                      ['class' => 'form-control'])
    !!}
    <label>
      メッセージ
    </label>
    {!!
        Form::textarea('message',
                        null,
                        ['class' => 'form-control', 'placeholder' => $message_placeholder])
    !!}
    <button class="btn btn-primary" style="float: right; clear: both; margin-top: 20px">送信</button> <!-- このstyle属性は一時的処置です -->
  {!! Form::close() !!}
</div>
@endsection
