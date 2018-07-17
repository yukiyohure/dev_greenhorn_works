@extends('partials.user_nav')

@section('content')
<h1 class="brand-header">確認画面</h1>
<div class="container">
 {!! Form::open(isset($inputs['create']) ? ['route' => 'question.store', 'method' => 'post'] : ['route' => ['question.update', $inputs['id']], 'method' => 'put']) !!}
      <ul class="dailyreport-info-list">
        <li>
          <h3>タイトル</h3>
            <div>{{ $inputs['title'] }}</div>
            {!! Form::hidden('title', $inputs['title'], ['class' => 'form-control']) !!}
        </li>
        <li>
          <h3>カテゴリ</h3>
            <div>{{ $category }}</div>
            {!! Form::hidden('tag_category_id', $inputs['tag_category_id'], ['class' => 'form-control']) !!}
        </li>
        <li>
          <h3>質問内容</h3>
            <div>{!! $question !!}</div>
            {!! Form::hidden('content', $inputs['content'], ['class' => 'form-control']) !!}
        </li>
      </ul>
      <button type="submit" class="btn btn-success pull-right"><?php print isset($inputs['create'])  ? '作成' : '編集'?></button>
    {!! Form::close() !!}
  @endsection
