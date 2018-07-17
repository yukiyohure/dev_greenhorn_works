@extends('partials.admin_nav')
@section('content')

<!-- TODO: styleは後でCSSに書き直す -->

<div style="padding: 20px">
  <h1>申請許可</h1>
  <hr>
  {!! Form::open(['route' => ['admin.access_right.replyMail', $query], 'method' => 'POST']) !!}
    <div style="
      border: 3px solid #ccc;
      background: white;
      border-radius: 20px;
      padding: 20px;
    ">
      <div>
        <p>
          許可する項目を選んで下さい（チェックをすると作成・編集・削除が可能になります）
        </p>
        <div>
          <div>
            {!! Form::checkbox('user_right'); !!}
            <label for="user_right">ユーザー</label>
          </div>
          <div>
            {!! Form::checkbox('store_right'); !!}
            <label for="store_right">店舗</label>
          </div>
        </div>
        <div style="width: 100%">
          <div style="text-align: right">
            {!! Form::input('submit', null, '送信') !!}
          </div>
        </div>
      </div>
    </div>
  {!! Form::close() !!}
</div>

@endsection
