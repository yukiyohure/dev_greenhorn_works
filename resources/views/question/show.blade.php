@extends('partials.user_nav')

@section('content')
<h1 class="brand-header">質問詳細</h1>
<div class="container">
  {!! Form::open(['route' => 'question.confirm', 'method' => 'post']) !!}
  <ul class="dailyreport-info-list">
    <li>
      <h3>タイトル</h3>
      {{ $questions->title }}
    </li>
    <li>
      <h3>カテゴリ</h3>
      {{ $questions->category->name }}
    </li>
    <li>
      <h3>本文</h3>
      {!! $questions->mark_content !!}
    </li>
    <li>
      <h3>解答</h3>
      @empty($questions->answer)
      wait....
      @endempty
      {{ $questions->answer }}
    </li>
  </ul>
    </div>
    <div class="bottom-btn-wrapper">
      <a href="{{ route('question.index') }}" class="bottom-btn">質問一覧へ</a>
    </div>
  {!! Form::close() !!}
</div>

@endsection
