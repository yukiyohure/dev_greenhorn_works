@extends('partials.admin_nav')

@section('content')

<h1 class="brand-header">質問詳細</h1>

{{ Form::open(['route' => 'admin.question.create', 'method' => 'GET']) }}
  <div class="container">
      <h2 class="question-header">{{ $question->title }}{{ Form::hidden('id', $id) }}</h2>
        <h3 class="question-header">({{ $question->category->name }})</h3>

      <ul class="question-show-list">
        <li>
          <h4>質問内容</h4>
          <p>{!! $question->mark_content !!}</p>
        </li>

        <li>
          <h4>解答</h4>
          <div class="form-group @if(!empty($errors->first('contents'))) has-error @endif">
            {!! Form::textarea('answer', $question['answer'], ['class' => 'form-control']) !!}
          </div>
        </li>
      </ul>

      <div class="bottom-btn-wrapper">
        <button type="submit" class="bottom-btn">更新</button>
        <a href="{{ route('admin.question.show', $id) }}" class="bottom-btn">戻る</a>
      </div>
  </div>
{!! Form::close() !!}

@endsection
