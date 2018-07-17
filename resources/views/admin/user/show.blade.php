@extends('partials.admin_nav')

@section('content')

  <h2 class="brand-header">研修生の詳細情報</h2>

  <div class="btn-wrapper">
    @if ($selfinfo->access_right & env('ACCESS_RIGHT_USER'))
      {!! Form::open(['route'=>['admin.user.destroy',$user->id],'method'=>'DELETE']) !!}
        <a class="btn" href="{{ $user->id }}/edit">編集</a>
        <button class="btn-danger btn" type="submit">削除</button>
      {!! Form::close() !!}
    @endif
  </div>

  <div class="container">
    <ul class="user-info-list">
      <li>
        <h3>ユーザー名</h3>
        {{ $user->name }}
      </li>

      <li>
        <h3>苗字</h3>
        {{ $user->info->last_name }}
      </li>

      <li>
        <h3>名前</h3>
        {{ $user->info->first_name}}
      </li>

      <li>
        <h3>性別</h3>
        {{$user->info->sex}}
      </li>

      <li>
        <h3>誕生日</h3>
        {{date("Y/m/d", strtotime($user->info->birthday))}}
      </li>

      <li>
        <h3>メールアドレス</h3>
        {{$user->info->email}}
      </li>

      <li>
        <h3>電話番号</h3>
        {{$user->info->tel}}
      </li>

      <li>
        <h3>入社日</h3>
        {{date("Y/m/d", strtotime($user->info->hire_date))}}
      </li>

      <li>
        <h3>店舗名</h3>
        {{$user->info->store->name}}
      </li>
    </ul>
  </div><!-- container closing tag -->

  <div class="bottom-btn-wrapper">
    <a href="{{ route('admin.home') }}" class="bottom-btn">ホームへ</a>
  </div>

@endsection
