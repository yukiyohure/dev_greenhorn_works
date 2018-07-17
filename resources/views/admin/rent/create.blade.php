@extends('partials.admin_nav')

@section('content')

  <h1 class="brand-header">貸出物の登録</h1>
  {{ Form::open(['route' => 'admin.rent.confirm', 'method' => 'GET']) }}
    <div class="content">
      <ul class="">
        <li>
          <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <h4>{{ Form::label('name', '名称') }}</h4>
            {{ Form::input('text', 'name', $data['name'], ['class' => 'form-control']) }}
             <span class="help-block">{{ $errors->first('name') }}</span>
          </div>
        </li>

        <li>
          <div class="form-group">
            <h4>{{ Form::label('item_category_id', '種類') }}</h4>
            <select name="item_category_id">
              @foreach($categories as $category)
              <option value="{{ $category->id }}" {{ $data['item_category_id'] == $category->id ? 'selected' : '' }}>
                {{ $category->category }}
              </option>
              @endforeach
            </select>
          </div>

        </li>

        <li>
          <div class="form-group {{ $errors->has('item_info') ? 'has-error' : '' }}">
            <h4>{{ Form::label('item_info', '概要・説明') }}</h4>
            {{ Form::textarea('item_info', $data['item_info'], ['maxlength' => '255', 'class' => 'form-control']) }}
            <span class="help-block">{{ $errors->first('item_info') }}</span>
          </div>
        </li>
      </ul>

      <div class="bottom-btn-wrapper">
        <button type="submit" class="btn">確認</button>
        <a href="{{ route('admin.rent.index') }}" class="bottom-btn">一覧へ</a>
      </div>

    </div>
  {{ Form::close() }}

@endsection