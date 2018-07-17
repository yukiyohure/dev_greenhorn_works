@extends('partials.admin_nav')

@section('content')

  <h1 class="brand-header">日報詳細</h1>
    <div class="container">
      <ul class="dailyreport-info-list">
        <li>
          <h3>苗字</h3> 
            {{ $report->user->info->last_name }}
        </li>

        <li>
          <h3>名前</h3>
            {{ $report->user->info->first_name }}
        </li>

        <li>
          <h3>日付</h3>  
            {{ date("Y/m/d", strtotime($report->reporting_time)) }}
        </li>

        <li>
          <h3>タイトル</h3>
            {{ $report->title }}
        </li>

        <li>
          <h3>本文</h3>
            {{ $report->contents }}
        </li>
      <ul>
    </div><!-- container closing tag -->

  <div class="bottom-btn-wrapper">
    <a href="{{ route('admin.report.index') }}" class="btn">日報一覧画面へ</a>
  </div>

@endsection
