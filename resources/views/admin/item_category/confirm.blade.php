@extends('partials.admin_nav')

@section('content')

  <h1 class="brand-header">入力の確認</h1>
  {{ Form::open(['route' => 'admin.item_category.store', 'method' => 'POST']) }}
    <div class="content">

      <ul class="rental-item-show-list">
        <li>
          <div class="form-group">
            <h4>種類</h4>
            {{ $data['category'] }}
          </div>
        </li>
      </ul>

      <div class="bottom-btn-wrapper">
        <button type="submit" class="btn" >追加</button>
        <a href="{{ route('admin.item_category.create', $data) }}" class="bottom-btn">戻る</a>
      </div>

    </div>
  {{ Form::close() }}

@endsection