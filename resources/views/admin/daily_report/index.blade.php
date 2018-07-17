@extends('partials.admin_nav')

@section('content')

  <h1 class="brand-header">日報一覧</h1>

      {!! Form::open(['route' => 'admin.report.index', 'method' => 'GET']) !!}
        <table class="search-table">
          <thead class="search-thead">
          </thead>
          <div class="modal-header">日報検索</div>
          <tbody class="search-tbody">
            <tr class="row">
              <td class="search-td col-md-3">
                {!! Form::input('text', 'last_name', null, ['class' => 'form-control', 'placeholder' => '苗字', 'id' => 'last_name']) !!}
              <!-- </td> -->
              </td>
              <td class="search-td col-md-3 col-md-offset-3">
                {!! Form::input('text', 'first_name', null, ['class' => 'form-control', 'placeholder' => '名前', 'id' => 'first_name']) !!}
              <!-- </td>  -->
              </td>
            </tr>
            <tr class="row">
              <td class="col-md-4 form-group search-td {{ $errors->has('start-date')? 'has-error' : '' }}">
                {!! Form::text('start-date', '', ['class' => 'datepicker start-date form-control', 'placeholder' => '始め']) !!}
                <span class="help-block">{{ $errors->first('start-date') }}</span>
              </td>
              <td class="col-md-4 form-group search-td {{ $errors->has('end-date')? 'has-error' : '' }}">
                {!! Form::text('end-date', '', ['class' => 'datepicker end-date form-control', 'placeholder' => '終わり']) !!}
                <span class="help-block">{{ $errors->first('end-date') }}</span>
              </td>
            </tr>
          </tbody>

          <tfoot class="search-tfoot">
            <tr class="search-tr">
              <td colspan="5" class="search-td  hello">
                <div class="bottom-btn-wrapper">
                  {!! Form::input('submit', '', '検索', ['class' => 'btn btn-success']) !!}
                </div>
              </td>
            </tr>
          </tfoot>
        </table>
      {!! Form::close() !!}

  <div class="content-wrapper text-align">
    <table class="table table-hover todo-table">
      <thead>
        <tr>
          <th>苗字</th>
          <th>名前</th>
          <th>日付</th>
          <th>タイトル</th>
        </tr>
      </thead>
      <tbody>
        @foreach($reports as $report)
          <tr>
            <td>{{ $report->user->info->last_name }}</td>
            <td>{{ $report->user->info->first_name }}</td>
            <td>{{ date("Y/m/d", strtotime($report->reporting_time)) }}</td>
            <td>{{ $report->title }}</td>
            <td><a class="btn btn-success" href="{{ route('admin.report.show', $report->id) }}">詳細</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="bottom-btn-wrapper">
    <a href="{{ route('admin.home') }}" class="bottom-btn">ホームへ</a>
  </div>

@endsection

@section('script')
@parent
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script>
  $(function() {
    $('.datepicker').datepicker({
      maxDate: new Date(),
      dateFormat: 'yy-mm-dd',
      onSelect: function() {
        var minDate = $('.start-date').val();
        $('.end-date').datepicker('option', 'minDate', minDate);
      }
    });
  });
</script>
@stop
