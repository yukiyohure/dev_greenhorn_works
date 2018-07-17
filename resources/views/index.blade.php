@extends('partials.outline')

@section('outline')
<body>
  <div id="app">
    <div class="row home-btn-wrapper">
      <div class="col-sm-4 col-xs-12 col__pd">
        <a href="{{ route('schedule.index') }}" class="user__btn"><i class="fa fa-briefcase mt70 fa-2x" aria-hidden="true"></i><p class="pm">勤怠</p></a>
      </div>
      <div class="col-sm-4  col-xs-12 col__pd">
        <a href="{{ route('report.index') }}" class="user__btn"><i class="fa fa-file-text-o mt70 fa-2x" aria-hidden="true"></i><p class="pm">日報</p></a>
      </div>
      <div class="col-sm-4  col-xs-12 col__pd">
        <a href="{{ route('question.index') }}" class="user__btn"><i class="fa fa-comments-o mt70 fa-2x" aria-hidden="true"></i><p class="pm">質問掲示板</p></a>
      </div>
    </div>
  </div>
</body>

@endsection
