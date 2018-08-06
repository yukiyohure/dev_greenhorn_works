@extends('partials.outline')

@section('outline')
<body>
  @if($isRegistered === 0)
  <!-- modal -->
  <div class="modalDialog showModal">
    <div>
      {!! Form::open(['ruote' => 'home', 'method' => 'POST']) !!}
        <table class="search-table">
          <thead class="search-thead"></thead>
          <div class="modal-header">個人情報の詳細</div>
          <tbody class="search-tbody">
            <tr>
              <td class="search-td">
                <label>
                  性別
                </label>
              </td>
              <td class="search-td">
                {{ Form::select('sex', [
                                  '' =>'未選択',
                                  '男' => '男性',
                                  '女' => '女性'
                                ], ['class' => 'form-control'])
                }}
                <span class="help-block required">{{ $errors->first('sex') }}</span>
              </td>
              <td class="search-td">
                <label>
                  支店名
                </label>
              </td>
              <td class="search-td">
                {{ Form::select('store_id', [
                                  '' => '未選択',
                                  '1' => '新宿店',
                                  '2' => '渋谷店',
                                  '3' => '池袋店'
                                ], ['class' => 'form-control'])
                }}
                <span class="help-block required">{{ $errors->first('store_id') }}</span>
              </td>
            </tr>
            <tr>
              <td class="search-td">
                <label>
                  電話番号
                </label>
              </td>
              <td class="search-td">
                {!! Form::input('tel', 'tel', '', ['class' => 'form-control', 'placeholder'=>'ex) 08012345678 半角', 'pattern'=>'[0-9]{11}', 'required' => 'required']) !!}
                <span class="help-block required">{{ $errors->first('tel') }}</span>
              </td>
              <td class="search-td">
                <label>
                  誕生日
                </label>
              </td>
              <td class="search-td">
                {!! Form::input('date', 'birthday', '', ['class' => 'form-control', 'required' => 'required', 'max' => '9999-12-31']) !!}
                <span class="help-block required">{{ $errors->first('birthday') }}</span>
              </td>
            </tr>
            <tr>
              <td class="search-td">
                <label>
                  入社日
                </label>
              </td>
              <td class="search-td">
                {!! Form::input('date', 'hire_date', '', ['class' => 'form-control', 'required' => 'required', 'min' => '2015-05-15', 'max' => '9999-12-31']) !!}
                <span class="help-block required">{{ $errors->first('hire_date') }}</span>
              </td>
            </tr>
          </tbody>
          <tfoot class="search-tfoot">
            <tr class="search-tr">
              <td colspan="5" class="search-td">
                <div class="bottom-btn-wrapper">
                {!! Form::input('submit', '', '登録', ['class' => 'btn btn-success btn-sm']) !!}
              </td>
            </tr>
          </tfoot>
        </table>
      {!! Form::close() !!}
    </div>
  </div><!-- open modal -->
  @endif
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
