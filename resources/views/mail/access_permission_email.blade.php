<!DOCTYPE html>
<html>
<head>
  <title>管理者アクセス権限申請</title>
</head>
<body>
  <h1>管理者アクセス権限申請</h1>
  <p>{{ $user_name }}さんがアクセス権限を申請しています。</p>
  <p>---------------------　メッセージ　----------------------</p>
  <p>{{ $user_message }}</p>
  <p>以下をクリックし、許可する権限を選択して下さい。</p>
  <a href="{{ $url . '/admin/access_right/permission' . $query_string }}">申請許可画面</a>
</body>
</html>
