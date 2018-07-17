@extends('partials.admin_nav')

@section('content')

  <h1 class='brand-header'>貸出物種類の更新</h1>

  {!! Form::open(['route' => 'admin.item_category.updateConfirm', 'method' => 'GET']) !!}
    <div class="content-wrapper">
      <ul>

        <li>
          <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
            <h4>{!! Form::label('category', '種類') !!}</h4>
            {!! Form::hidden('id', $category['id']) !!}
            {!! Form::input('text', 'category', $category['category'], ['class' => 'form-control']) !!}
            <span class="help-block">{{ $errors->first('category') }}</span>
          </div>
        </li>

      </ul>
    </div>

    <div class="bottom-btn-wrapper">
      <button class="btn btn-success" type="submit">確認</button>
      <a href="{{ route('admin.item_category.index') }}" class="btn">一覧へ</a>
    </div>
  {!! Form::close() !!}
@endsection