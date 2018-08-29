@extends('partials.admin_nav')
@section('content')

<h3>メッセージが送信されました。</h3>
<p>※５秒後にホームに自動で移動します。</p>
<!-- <a href="{{ route('admin.') }}">ホームに戻る</a> -->

<script>
  setTimeout(function(){
    window.location.href = 'http://localhost:8080/admin';
  }, 6*1000);
</script>
@endsection
