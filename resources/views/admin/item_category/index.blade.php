@extends('partials.admin_nav')

@section('content')

  <h1 class="brand-header">貸出物種類一覧</h1>
  <div class="btn-wrapper">
    <a class="btn btn-success" href="{{ route('admin.item_category.create') }}">貸出物種類の登録</a>
    <a class="btn btn-success" href="{{ route('admin.rent.index') }}">貸出物一覧へ</a>
  </div>


  <div class="content-wrapper">
    <table class="table table-hover rental-item-list">
      <thead>
        <tr>
          <th>種類</th>
        </tr>
      </thead>
      <tbody>
      @foreach($categories as $category)
        <tr>
          <td>{{ $category->category }}</td>
          <td>
            <a class="btn" href="{{ route('admin.item_category.edit', $category->id) }}">編集</a>
          </td>
          <td>
            @if(empty($category->item))
            <a class="btn-danger btn" href="#deleteModal{{ $category->id }}">削除</a>

            <div id="deleteModal{{ $category->id }}" class="modalDialog">
              <div><a href="#close" class="close" title="Close">X</a>
                <div class="modal-header">削除の確認</div>
                <ul class="rental-item-show-list">
                  <li>
                    <h4>種類</h4>
                    {{ $category->category }}
                  </li>
                </ul>
                {!! Form::open(["route" => ['admin.item_category.destroy', $category->id], 'method' => 'DELETE']) !!}
                  <a href="#close" class="btn" title="Close">閉じる</a>
                  <button class="btn-danger btn">削除</button>
                {!! Form::close() !!}
              </div>
            </div>

            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="bottom-btn-wrapper">
    <a href="{{ route('admin.home') }}" class="bottom-button">ホームへ</a>
  </div>
@endsection