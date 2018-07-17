@extends('partials.admin_nav')

@section('content')

  <h2 class="brand-header">研修生一覧</h2>
    {!! Form::open(['route' => 'admin.user.index', 'method' => 'GET']) !!}
      <div class="btn-wrapper">
        @if ($selfinfo->access_right & env('ACCESS_RIGHT_USER'))
          <a class="btn" href="{{ route('admin.user.create')}}">研修生を追加</a>
        @endif
        <a　class="btn" href="#openModal">研修生を検索</a>
      </div>

      <div id="openModal" class="modalDialog">
       <div>
        <a href="#close" title="Close" class="close">X</a>
        <table class="search-table">
          <thead class="search-thead">
          </thead>
          <div class="modal-header">研修生を検索</div>
          <tbody class="search-tbody">
            <tr>
              <td class="search-td">
                <label>
                  氏名
                </label>
              </td>
              <td class="search-td">
                {!! Form::input('text', 'last_name', null, ['class' => 'form-control', 'placeholder' => '苗字', 'id' => 'last_name']) !!}
              </td>
              <td class="search-td">
              </td>
              <td class="search-td">
                {!! Form::input('text', 'first_name', null, ['class' => 'form-control', 'placeholder' => '名前', 'id' => 'first_name']) !!}
              </td>
            </tr>

            <tr>
              <td class="search-td">
                <label for="store_id">
                  店舗名
                </label>
              </td>
              <td class="search-td">
                {!! Form::select('store_id', [null => '店舗選択'] + array_pluck($stores, 'name', 'id'), null, ['class' => 'form-control', 'id' => 'store_id']) !!}
              </td>
            </tr>

            <tr>
              <td class="search-td">
                <label>
                  性別
                </label>
              </td>
              <td class="search-td">
                <label for="sex">
                  男
                </label>
                {!! Form::input('radio','sex', '男', null, ['class' => 'form-control']) !!}
                <label for="sex">
                  女
                </label>
                {!! Form::input('radio','sex', '女', null, ['class' => 'form-control']) !!}
              </td>
            </tr>

            <tr>
              <td class="search-td">
                <label for="hire_date-start-date">
                  開始日
                </label>
              </td>
              <td class="search-td">
                {!! Form::date('hire_date-start-date', null, ['class' => 'form-control']) !!}
              </td>
              <td class="search-td">
              </td>
              <td class="search-td">
                {!! Form::date('hire_date-end-date', null, ['class' => 'form-control']) !!}
              </td>
            </tr>
          </tbody>

          <tfoot class="search-tfoot">
            <tr class="search-tr">
              <td colspan="5" class="search-td">
                <div class="bottom-btn-wrapper">
                  {!! Form::input('submit', '', '検索', ['class' => 'btn btn-success']) !!}
                </div>
              </td>
            </tr>
          </tfoot>
        </table>
      {!! Form::close() !!}
    </div>
  </div><!-- modal closing tag -->

  <div class="content-wrapper">
    <table class="table table-hover todo-table">
      <thead>
        <tr>
          <th>苗字</th>
          <th>名前</th>
          <th>性別</th>
          <th>開始日</th>
          <th>店舗名</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
          <tr>
            <td>{{ $user->info->last_name }}</td>
            <td>{{ $user->info->first_name }}</td>
            <td>{{ $user->info->sex}}</td>
            @if($user->info->hire_date)
              <td>{{ date("Y/m/d", strtotime($user->info->hire_date)) }}</td>
            @else
              <td></td>
            @endif
            <td>{{ $user->info->store->name }}</td>
            <td>
              <a class="btn btn-success" href="{{ route('admin.user.show', $user->id) }}">詳細</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div><!-- content-wrapper closing tag -->

  <div class="bottom-btn-wrapper">
    <a href="{{ route('admin.home') }}" class="bottom-btn">ホームへ</a>
  </div>

  @endsection
