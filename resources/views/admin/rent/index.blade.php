@extends('partials.admin_nav')

@section('content')

  <h1 class="brand-header">貸出物一覧</h1>
  {!! Form::open(['route' => 'admin.rent.index', 'method' => 'GET']) !!}
  <div class="btn-wrapper">
    <a class="btn btn-success" href="{{ route('admin.rent.create') }}">貸出物の登録</a>
    <a class="btn" href="#openModal">貸出物の検索</a>
    <a class="btn btn-success" href="{{ route('admin.item_category.index') }}">貸出物種類一覧へ</a>
  </div>
  <div id="openModal" class="modalDialog">
    <div><a href="#close" class="close" title="Close">X</a>
      <table class="search-table">
        <thead class="search-thead">
        </thead>
        <div class="modal-header">貸出物の検索</div>
        <tbody class="search-tbody">
          <tr>
            <td class="search-td">
              <label>
                名称
              </label>
            </td>
            <td class="search-td">
              {!! Form::input('text', 'name', null, ['class' => 'form-control']) !!}
            </td>
            <td class="search-td">
              <label>
                種類
              </label>
            </td>
            <td class="search-td">
              {!! Form::select('item_category_id', [null => '種類選択'] + array_pluck($categories, 'category', 'id'), null, ['class' => 'form-control', 'id' => 'item_category_id']) !!}
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
  </div>

  <div class="content-wrapper">
    <table class="table table-hover rental-item-list">
      <thead>
        <tr>
          <th>名称</th>
          <th>種類</th>
        </tr>
      </thead>
      <tbody>
      @foreach($items as $item)
        <tr>
          <td class="rental-item-name-list">{{ $item->name }}</td>
          <td>{{ $item->category->category }}</td>
          <td><a class="btn btn-success" href="{{ route('admin.rent.show', $item->id) }}">詳細</a></td>
          <td>
            <a class="btn-danger btn" href="#deleteModal{{ $item->id }}">削除</a>

            <div id="deleteModal{{ $item->id }}" class="modalDialog">
              <div><a href="#close" class="close" title="Close">X</a>
                <div class="modal-header">削除の確認</div>
                <ul class="rental-item-show-list">
                  <li>
                    <h4>名称</h4>
                    {{ $item->name }}
                  </li>
                  <li>
                    <h4>種類</h4>
                    {{ $item->category->category }}
                  </li>
                  <li>
                    <h4>概要・説明</h4>
                    {{ $item->item_info }}
                  </li>
                </ul>
                {!! Form::open(["route" => ['admin.rent.destroy', $item->id], 'method' => 'DELETE']) !!}
                  <a href="#close" class="btn" title="Close">閉じる</a>
                  <button class="btn-danger btn">削除</button>
                {!! Form::close() !!}
              </div>
            </div>

          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="bottom-btn-wrapper">
    <a href="{{ route('admin.home') }}" class="bottom-btn">ホームへ</a>
  </div>
@endsection
