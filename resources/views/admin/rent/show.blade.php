@extends('partials.admin_nav')

@section('content')

  <h1 class="brand-header">貸出物の詳細</h1>
  <div class="content-wrapper">
    <ul class="rental-item-show-list">
      <li>
        <h3>名称</h3>
        {{ $item->name }}
      </li>
      <li>
          <h3>種類</h3>
          {{ $item->category->category }}
      </li>
      <li>
        <h3>概要・説明</h3>
        {{ $item->item_info }}
      </li>
    </ul>
  </div>
  <div class="bottom-btn-wrapper">
    <a href="{{ route('admin.rent.edit', $item->id) }}" class="btn">編集</a>
    <a href="{{ route('admin.rent.index') }}" class="bottom-btn">一覧へ</a>
  </div>
@endsection
