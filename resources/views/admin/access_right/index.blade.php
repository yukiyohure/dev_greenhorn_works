@extends('partials.admin_nav')
@section('content')


@if(isset($messageForErr))
    <script>
      alert('おっと！通信エラーみたいです。もう一度試して！');
    </script>
@endif

<div style="padding: 30px"> <!-- このstyle属性は一時的処置です -->
    <h1>お問い合わせ</h1>
    {!! Form::open(['route' => 'admin.access_right.sendSlack', 'method' => 'post']) !!}
        <label>
            メッセージ
        </label>
        <div class="form-group @if(!empty($errors->first('message'))) has-error @endif">
            {!! Form::textarea('message', $messageForErr ?? null, ['class' => 'form-control', 'placeholder' => 'お問い合わせ内容を記入して送信してください。']) !!}
            <span class="help-block">{{$errors->first('message')}}</span>
            <button class="btn btn-primary" style="float: right; clear: both; margin-top: 20px">送信</button> <!-- このstyle属性は一時的処置です -->
        </div>
    {!! Form::close() !!}
</div>

<? $data['error'] = ""; ?>

@endsection
