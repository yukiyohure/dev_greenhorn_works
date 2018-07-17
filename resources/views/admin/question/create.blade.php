@extends('partials.admin_nav')

@section('content')

<h1 class="brand-header">入力の確認</h1>

{{ Form::open(['route' => 'admin.question.updateAnswer', 'method' => 'PUT']) }}
  <div class="content">
    <h2 class="question-header">{{ $question->title }}</h2>
      <h3 class="question-header">({{ $question->category->name }})</h3>

    <ul class="question-show-list">
      <li>
        <h4>質問内容</h4>
        <p>{!! $question->mark_content !!}</p>
      </li>

      <li>
        <h4>解答</h4>
        <p>{{ $data['answer'] }}</p>
      </li>
    </ul>

    <div class="bottom-btn-wrapper">
      <button type="submit" class="bottom-btn">更新</button>
      <a href="{{ route('admin.question.edit', $question) }}" class="bottom-btn">戻る</a>
    </div>

  </div>
{{ Form::close() }}

@endsection
