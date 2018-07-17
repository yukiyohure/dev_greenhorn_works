@extends('partials.user_nav')

@section('content')
  <h1 class="brand-header">
    Error
  </h1>

  <h2 class="page-header text-align">{{ $error_message }}</h2>

@endsection
