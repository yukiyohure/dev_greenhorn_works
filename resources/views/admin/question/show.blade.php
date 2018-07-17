@extends('partials.admin_nav')

@section('content')

  <h1 class="brand-header">質問詳細</h1>
  <div class="container">

    <h2 class="question-header">{{ $question->title }}</h2>
      <h3 class="question-header">({{ $question->category->name }})</h3>

    <ul class="question-show-list">
      <li>
        <h4>質問内容</h4>
        <p>{!! $question->mark_content !!}</p>
      </li>

      <li>
        <h4>解答</h4>
        @if(!empty($question->answer))
        <p>{!! $question->answer !!}</p>
        @else
        <p><span class="point_color">まだ解答がありません</span></p>
        @endif
      </li>
    </ul>

  </div>
  <div class="bottom-btn-wrapper">
    <a href="{{ route('admin.question.edit', $question->id) }}" class="bottom-btn">編集</a>
    <a href="{{ route('admin.question.index') }}" class="bottom-btn">一覧へ</a>
  </div>
@endsection
