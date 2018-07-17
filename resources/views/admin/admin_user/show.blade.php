@extends('partials.admin_nav')

@section('content')

  <h1 class="brand-header">管理者ユーザー詳細情報</h1>

    <div class="btn-wrapper">
      @if ($selfinfo->position_code === 1)
        {!! Form::open(['route' => ['admin.adminuser.destroy', $adminuser->id], 'method' => 'DELETE']) !!}
          <a class="btn" href="{{ route('admin.adminuser.edit', $adminuser->id) }}">編集</a>
          <button class="btn-danger btn" type="submit">削除</button>
        {!! Form::close() !!}
      @endif
    </div>

    <div class="container">
      <ul class="user-info-list">
        <li>
          <h3>ユーザー名</h3>
          {{ $adminuser->name }}
        </li>

        <li>
          <h3>苗字</h3>
          {{ $adminuser->info->last_name }}
        </li>

        <li>
          <h3>名前</h3>
          {{ $adminuser->info->first_name}}
        </li>

        <li>
          <h3>性別</h3>
          {{$adminuser->info->sex}}
        </li>

        <li>
          <h3>誕生日</h3>
          {{date("Y/m/d", strtotime($adminuser->info->birthday))}}
        </li>

        <li>
          <h3>メールアドレス</h3>
          {{$adminuser->info->email}}
        </li>

      <!--   <p class="pull-right"><a href="{{ route('admin.adminuser.mailedit', $adminuser->id) }}">メールアドレスの変更はこちら</a></p> -->

        <li>
          <h3>電話番号</h3>
          {{$adminuser->info->tel}}
        </li>

        <li>
          <h3>管理者権限</h3>
          {{ $adminuser->privileges == 1? 'スーパーアドミン': 'アドミン' }}
        </li>

         <li></li>
    </ul>
  </div>

  <div class="bottom-btn-wrapper">
    <a href="{{ route('admin.adminuser.index') }}" class="btn">管理者ユーザー一覧画面へ</a>
  </div>

@endsection
