@extends('partials.admin_nav')

@section('content')

  <h2 class="brand-header">研修生の追加</h2>
  {{ Form::open(array('route' => 'admin.user.store')) }} 
    <div class="container">
      <ul class="user-info-list">
        <li>
          <h4>{!! Form::label('last_name', '姓'); !!}</h4>
          <div class="form-group {{ $errors->has('last_name') ? 'has-error' :''}}">
            {!! Form::input('text', 'last_name', old("name"), array('class' => 'form-control-custom','placeholder' => '小松')) !!}
            <span class="help-block">{{$errors->first('last_name')}}</span>
          </div>
        </li>
        
        <li>
          <h4>{!! Form::label('first_name', '名'); !!}</h4>
          <div class="form-group {{ $errors->has('first_name') ? 'has-error' :''}}">
            {!! Form::input('text', 'first_name', old("name"), array('class' => 'form-control-custom','placeholder' => '信之')) !!}
            <span class="help-block">{{$errors->first('first_name')}}</span>
          </div>
        </li>
        
        <li>
          <h4>{!! Form::label('sex', '性別'); !!}</h4>
          <div class="form-group {{ $errors->has('sex') ? 'has-error' :''}}">
            {!! Form::label('sex', '男性'); !!}
            {!! Form::radio('sex', '男', old("sex")) !!}
            {!! Form::label('sex', '女性'); !!}
            {!! Form::radio('sex', '女', old("sex")) !!}
            <span class="help-block">{{$errors->first('sex')}}</span>
          </div>
        </li>

        <li>
          <div class="form-group {{ $errors->has('birthday') ? 'has-error' :''}}">
            <h4>{!! Form::label('birthday', '生年月日'); !!}</h4>
            {!! Form::input('date', 'birthday', old("birthday"), array('class' => 'form-control-custom','placeholder' => '1992年7月30日')) !!}</h4>
            <span class="help-block">{{$errors->first('birthday')}}</span>
          </div>
        </li>

        <li>   
          <div class="form-group {{ $errors->has('email') ? 'has-error' :''}}">
            <h4>{!! Form::label('email', 'メールアドレス'); !!}</h4>
            {!! Form::input('text', 'email', old("email"), array('class' => 'form-control-custom','placeholder' => 'greenhorn@gizumo.com')) !!}
            <span class="help-block">{{$errors->first('email')}}</span>
          </div>
        </li>

        <li>
          <div class="form-group {{ $errors->has('tel') ? 'has-error' :''}}">
            <h4>{!! Form::label('tel', '電話番号'); !!}</h4>
            {!! Form::input('int', 'tel', old("tel"), array('class' => 'form-control-custom','placeholder' => '0333532720')) !!}
            <span class="help-block">{{$errors->first('tel')}}</span>
          </div>
        </li>

        <li>
          <div class="form-group {{ $errors->has('hire_date') ? 'has-error' :''}}">
            <h4>{!! Form::label('hire_date', '入社日'); !!}</h4>
            {!! Form::input('date', 'hire_date', old("hire_date"), array('class' => 'form-control-custom')) !!}
            <span class="help-block">{{$errors->first('hire_date')}}</span>
          </div>
        </li>

        <li>
          <div class="form-group {{ $errors->has('store_id') ? 'has-error' :''}}">
            <h4>{!! Form::label('store_id', '店舗名'); !!}</h4>
            <select name="store_id">
              @foreach($stores as $store)
                <option value="{{ $store->id }}">{{ $store->name }}</option> 
              @endforeach
            </select>
            <span class="help-block">{{$errors->first('store_id')}}</span>
          </div>
        </li>

        <li></li>
        
      </ul>
    </div><!-- container closing tag -->
  {!! Form::close() !!}

  <div class="bottom-btn-wrapper">
    <button type="submit" class="btn">追加</button>
    <a href="{{ route('admin.user.index') }}" class="bottom-btn">研修生一覧へ</a>
  </div> 

  


@endsection