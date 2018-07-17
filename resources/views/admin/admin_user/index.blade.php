@extends('partials.admin_nav')

@section('content')

  <h2 class="brand-header">管理者ユーザー一覧</h2>
    <div class="content-wrapper">
      <table class="table table-hover todo-table">
        <thead>
          <tr>
            <th>苗字</th>
            <th>名前</th>
            <th>性別</th>
            <th>生年月日</th>
            <th>メールアドレス</th>
            <th>電話番号</th>
          </tr>
        </thead>
        <tbody>
          @foreach($adminusers as $adminuser)
            <tr>
              <td>{{ $adminuser->info->last_name }}</td>
              <td>{{ $adminuser->info->first_name }}</td>
              <td>{{ $adminuser->info->sex }}</td>
              <td>{{ date("Y/m/d", strtotime($adminuser->info->birthday)) }}</td>
              <td>{{ $adminuser->info->email }}</td>
              <td>{{ $adminuser->info->tel }}</td>
              <td>
                <a class="btn btn-success" href="{{ route('admin.adminuser.show', $adminuser->id) }}">詳細</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  <div class="bottom-btn-wrapper">
    <a href="{{ route('admin.home') }}" class="btn">ホームへ</a>
    @if ($selfinfo->position_code === 1)
      <a class="btn" href="{{ route('admin.adminuser.create') }}">管理者ユーザーの作成</a></p>
    @endif
  </div>

@endsection
