@extends('partials.admin_nav')

<?php
 $birthday = date("Y-m-d", strtotime($user->info->birthday));
 $hireDate = date("Y-m-d", strtotime($user->info->hire_date));
?>

@section('content')

  {{ Form::open(array('route'=> ['admin.adminuser.update', $user->id], 'method'=>'put')) }}
    <h2 class="brand-header">研修生の編集</h2>

    <div class="container">
      <ul class="user-info-list">
        <li>
          <h4>{!! Form::label('name', 'ユーザー名'); !!}</h4>
          <div class="form-group {{ $errors->has('name') ? 'has-error' :''}}">
            {!! Form::input('text', 'name', old("name", $user->name), array('class' => 'form-control-custom','placeholder' => 'Giztaro')) !!}
            <span class="help-block">{{$errors->first('name')}}</span>
          </div>
        </li>
        
        <li>
          <h4>{!! Form::label('last_name', '苗字'); !!}</h4>
          <div class="form-group {{ $errors->has('last_name') ? 'has-error' :''}}">
              {!! Form::input('text', 'last_name', old("name", $user->info->last_name), array('class' => 'form-control-custom','placeholder' => 'Giz')) !!}
              <span class="help-block">{{$errors->first('last_name')}}</span>
          </div>
        </li>

        <li>
          <h4>{!! Form::label('first_name', '名前'); !!}</h4>
          <div class="form-group {{ $errors->has('first_name') ? 'has-error' :''}}">
              {!! Form::input('text', 'first_name', old("name", $user->info->first_name), array('class' => 'form-control-custom','placeholder' => 'mo')) !!}
              <span class="help-block">{{$errors->first('first_name')}}</span>
          </div>
        </li>

        <li>
          <div class="form-group {{ $errors->has('sex') ? 'has-error' :''}}">
              <h4>{!! Form::label('sex', '性別'); !!}</h4>
              {!! Form::label('sex', '男性'); !!}
              {!! Form::radio('sex', '男', old("male", $user->info->sex)) !!}
              {!! Form::label('sex', '女性'); !!}
              {!! Form::radio('sex', '女', old("female", $user->info->sex)) !!}
              <span class="help-block">{{$errors->first('sex')}}</span>
          </div>
        </li>

        <li>
          <div class="form-group {{ $errors->has('birthday') ? 'has-error' :''}}">
              <h4>{!! Form::label('birthday', '生年月日'); !!}</h4>
              {!! Form::input('date', 'birthday', old("birthday", $birthday), array('class' => 'form-control-custom','placeholder' => '1992年7月30日')) !!}
              <span class="help-block">{{$errors->first('birthday')}}</span>
          </div>
        </li>

        <li>
          <div class="form-group {{ $errors->has('email') ? 'has-error' :''}}">
              <h4>{!! Form::label('email', 'メールアドレス'); !!}</h4>
              {!! Form::input('text', 'email', old("email", $user->info->email), array('class' => 'form-control-custom','placeholder' => 'greenhorn@gizumo.com')) !!}
              <span class="help-block">{{$errors->first('email')}}</span>
          </div>
        </li>

        <li>
          <div class="form-group {{ $errors->has('tel') ? 'has-error' :''}}">
              <h4>{!! Form::label('tel', '電話番号'); !!}</h4>
              {!! Form::input('int', 'tel', old("tel", $user->info->tel), array('class' => 'form-control-custom','placeholder' => '0333532720')) !!}
              <span class="help-block">{{$errors->first('tel')}}</span>
          </div>

        <li>
          <div class="form-group {{ $errors->has('hire_date') ? 'has-error' :''}}">
            <h4>{!! Form::label('hire_date', '入社日'); !!}</h4>
            {!! Form::input('date','hire_date', old("hire_date", $hireDate), array('class' => 'form-control-custom')) !!}
            <span class="help-block">{{$errors->first('email')}}</span>
          </div>
        </li>

        <li>
          </h4>{!! Form::label('store_name', '店舗名'); !!}</h4>
          <select name="store_id">
            @foreach($stores as $store)
              <option value="{{ $store->id }}" {{$store->id === $user->info->store_id ? 'selected':''}} >{{ $store->name }}</option> 
            @endforeach
          </select>
        </li>
      </ul>
    </div><!-- container closing tag -->
  {!! Form::close() !!}

  <div class="btn-wrapper">
    <a href="{{ route('admin.user.index') }}" class="btn">ユーザーの一覧画面に戻る</a>  
    <button type="submit" class="btn btn-success">更新</button>
  </div>

@endsection
