@extends('partials.admin_nav')

@section('content')

  <h1 class="brand-header">貸出物種類の登録</h1>

  {{ Form::open(['route' => 'admin.item_category.confirm', 'method' => 'GET']) }}
    <div class="content">
      <ul>
        <li>
          <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
            <h4>{{ Form::label('category', '種類') }}</h4>
            {{ Form::input('text', 'category', $data['category'], array('class' => 'form-control')) }}
             <span class="help-block">{{ $errors->first('category') }}</span>
          </div>
        </li>

      </ul>

      <div class="bottom-btn-wrapper">
        <button type="submit" class="btn">確認</button>
        <a href="{{ route('admin.item_category.index') }}" class="bottom-btn">一覧へ</a>
      </div>

    </div>
  {{ Form::close() }}

@endsection