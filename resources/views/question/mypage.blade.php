@extends('partials.user_nav')

@section('content')
<h2 class="brand-header">マイページ</h2>
<div class="content-wrapper">
  <table class="margin__center text-align">
    <thead>
      <tr>
        <th class="content-inner">質問タイトル</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($questions as $question)
        <tr>
          <td class="content-inner">{{ $question->title }}</td>
          <td>
            <a class="btn btn-success" href="{{ route('question.edit', $question->id) }}">編集</a>
          </td>
          <td>
            {!! Form::open(['route' => ['question.destroy', $question->id], 'method' => 'DELETE']) !!}
              <button class="btn btn-danger" type="submit">削除</button>
            {!! Form::close() !!}
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection
