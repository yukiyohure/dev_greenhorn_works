@extends('partials.admin_nav')

@section('content')

  <h1 class="brand-header">店舗一覧</h1>
  <div class="btn-wrapper">
    @if ($selfinfo->access_right & env('ACCESS_RIGHT_STORE'))
      <a class="btn delete-margin" href="{{ url('admin/store/create') }}">店舗の登録</a>
    @endif
  </div>

  <div class="content-wrapper">
    <table class="table table-hover todo-table">
      <thead>
        <tr>
          <th>店舗名</th>
        </tr>
      </thead>
      <tbody>
        @foreach($stores as $store)
          <tr>
            <td>{{ $store->name }}</td>
            <td><a class="btn btn-success pull-right" href="{{ route('admin.store.show', $store->id)}}">研修生一覧</a></td>
              @if ($selfinfo->access_right & env('ACCESS_RIGHT_STORE'))
                <td><a href="{{ route('admin.store.edit', $store->id) }}" type="submit" class="btn btn-success pull-right">
                  店舗情報の更新</a>
                </td>
              @endif
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="bottom-btn-wrapper">
    <a href="{{ route('admin.home') }}" class="bottom-btn">ホームへ</a>
  </div>

@endsection
