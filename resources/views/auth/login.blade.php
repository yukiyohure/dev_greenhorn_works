<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slack_login.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>

<body class="body-color screen_size">
                <div class="just_for_fun_Dont_delete"><a class="maker" href="Credit"></a></div>
  <main class="main">
    <div class="outline_loginform">
      <div class="loginform">
        <div class="loginform_sizer">
          <div class="formtop">
            <div class="title_sizer">
              <h1 class="title">Greenhorn Works</h1>
              <h1 class='subtitle'>- User Login page -</h1>
            </div>
          </div>

          <img class="giz_icon" src="/image/gizumo_icon_360.jpg" alt="GIZMO">

          <div class="formbottom">
            <button class="btn_def" type="button" onclick="location.href='slack/login'">

              <img class="signin" src="/image/signin.jpg" alt="Sign in with Slack" />
            </button>
            <p class="none_account">Slackアカウントをお持ちでない方は&nbsp;&nbsp;<span><u><a class="here" href="https://join.slack.com/giztech/invite/MTkwOTk3OTc1MTA5LTE0OTYyODAxMzAtY2JlYTcwNjgyNw?t=x-86274042113-190902972674">こちら</a></u></span></p>
          </div>
        </div>
      </div>
    </div>
  </main>



<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script>
$(function(){if (location.href.match(/login/)) {
  var html = document.getElementsByTagName('html');
  var body = document.getElementsByTagName('body');
  html[0].classList.add('is-login');
  body[0].classList.add('is-login');
  }
});
</script>
<script type="text/javascript">
  const html = document.querySelector('html');
  const body = document.querySelector('body');
  const main = document.querySelector('main');
  const formTop = document.querySelector('.formtop');
  const formBottom = document.querySelector('.formbottom');
  const gizIcon = document.querySelector('.giz_icon');
  let sWidth;
  let sHeight;
  let flag = true;
  let display = true;

  window.addEventListener('resize', window_load);
  window_load();
  // ウィンドウのサイズが変更される度にこのイベントが発火
  // 関数window_loadを走らせる
  // heightとwidthを比較し短い方をbodyのheightとwidthに代入

  function window_load() {
    sWidth = window.innerWidth;
    sHeight = window.innerHeight;

    if (sWidth > sHeight) {
      body.style.width = sHeight + 'px';
      body.style.height = sHeight + 'px';
    }

    if(sWidth < sHeight){
      body.style.width = sWidth + 'px';
      body.style.height = sWidth + 'px';
    }
  }

  main.addEventListener('mouseenter', async function(e) {
    // mainにマウスが入った際に発火
    // falgにtureを代入ののち順番にanimationさせ最後に
    // flagがtureであればdisplayをブロックに
    // falseであればnoneに


    flag = true;

    await animation(this, ratio(sHeight, '50'), .3);
    await animation(this, ratio(sHeight, '30'), .5);
    await animation(this, sWidth < sHeight ? sWidth : sHeight, .5);
    flag ? await displayChange('block')　: await displayChange('none');
  });

  main.addEventListener('mouseleave', async function(e) {
      // mainからマウスが出た際に発火
      // falgにfalseを代入ののちdisplayをnoneにし
      // 順番にanimationさせる

      flag = false;

      await displayChange('none');
      await animation(this, ratio(sWidth, '30'), .5);
      await animation(this, ratio(sWidth, '50'), .3);
      await animation(this, 200, .5);

  });

    function animation(target, size, transition) {
      // 第一引数の高さと幅に第二引数を与える。
      // 第三引数を変化時間としているのでsettmeoutにも流用。
      return new Promise(resolve => {
        target.style.width = `${size}px`;
        target.style.height = `${size}px`;
        target.style.transition = `${transition}s`;

        setTimeout(resolve, transition * 1000);
      });
    }

    function displayChange(style) {
      // formTop & formBottom　のdisplayのstyleを引数に変更します
      return new Promise(resolve => {
        formTop.style.display = `${style}`;
        formBottom.style.display = `${style}`;
        resolve();
      })
    }

    function ratio(Screensize, ratio) {
        // 比率を求めています
        // 第一引数に100%とする値
        // 第二引数に比率を代入します
        // ratio(100, 10) == 10
      var ratioInt = Math.round((ratio / 100)* Screensize);

      return ratioInt;
    }

</script>
<!-- <script type="text/javascript">
  const html = document.querySelector('html');
  const body = document.querySelector('body');
  const main = document.querySelector('main');
  const formTop = document.querySelector('.formtop');
  const formBottom = document.querySelector('.formbottom');
  const gizIcon = document.querySelector('.giz_icon');
  let sWidth;
  let sHeight;
  let enterFlg = true;
  let leaveFlg = false;

  window.addEventListener('resize', window_load);
  window_load();

  function window_load() {
    sWidth = window.innerWidth;
    sHeight = window.innerHeight;

    if (sWidth > sHeight) {
      body.style.width = sHeight + 'px';
      body.style.height = sHeight + 'px';
    }

    if(sWidth < sHeight){
      body.style.width = sWidth + 'px';
      body.style.height = sWidth + 'px';
    }
  }

  main.addEventListener('mouseenter', async function(e) {
    e.stopPropagation();

    // enterFlg = true;

    if (enterFlg) {
      await animation(this, ratio(sHeight, '50%'), .3);
      await animation(this, ratio(sHeight, '30%'), .5);
      await animation(this, sWidth < sHeight ? sWidth : sHeight, .5);
      await displayChange(formTop, formBottom, 'block');

      leaveFlg = true;
      enterFlg = false;
    }
  });

  main.addEventListener('mouseleave', async function(e) {
    e.stopPropagation();

    if (leaveFlg) {
      await displayChange(formTop, formBottom, 'none');
      await animation(this, ratio(sWidth, '30%'), .5);
      await animation(this, ratio(sWidth, '50%'), .3);
      await animation(this, 200, .5);

      enterFlg = true;
      leaveFlg = false;
    }
  });

    function animation(target, size, transition) {
      return new Promise(resolve => {
        target.style.width = `${size}px`;
        target.style.height = `${size}px`;
        target.style.transition = `${transition}s`;

        setTimeout(resolve, transition * 1000);
      });
    }

    function displayChange(target1, target2, style, transition) {
      return new Promise(resolve => {
        target1.style.display = `${style}`;
        target2.style.display = `${style}`;
        resolve();
      })
    }

    function ratio(Screensize, ratio) {

      var ratioNum = ratio.slice( 0,-1 );

      var ratioInt = Math.round((ratioNum / 100)* Screensize);

      return ratioInt;
    }

</script> -->
</body>
</html>
