<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'greenhorn_works') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <!--<link href="{{ asset('css/admin.css') }}" rel="stylesheet">-->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container z-index">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ route('admin.home') }}">
                        {{ config('app.name', 'greenhorn_works') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                      &nbsp;
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                          勤退&nbsp;<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                          <li>
                            <a href="{{ route('admin.schedule.index') }}">
                              勤退表一覧
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="dropmenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                          日報&nbsp;<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                          <li>
                            <a href="{{ route('admin.report.index') }}">
                              日報一覧
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="dropmenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                          解答&nbsp;<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                          <li>
                            <a href="{{ route('admin.report.index') }}">
                              質問一覧
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="dropmenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                          店舗&nbsp;<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                          <li>
                            <a href="{{ route('admin.store.index') }}">
                              店舗一覧
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="dropmenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                          貸出物&nbsp;<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                          <li>
                            <a href="{{ route('admin.rent.index') }}">
                              貸出物一覧
                            </a>
                          </li>
                          <li>
                            <a href="{{ route('admin.item_category.index') }}">
                              貸出物種類一覧
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="dropmenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                          研修生&nbsp;<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                          <li>
                            <a href="{{ route('admin.user.index') }}">
                              研修生一覧
                            </a>
                          </li>
                          <li>
                            <a href="{{ route('admin.user.create') }}">
                              研修生を追加
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="dropmenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                          管理者&nbsp;<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                          <li>
                            <a href="{{ route('admin.adminuser.index') }}">
                              管理者一覧
                            </a>
                          </li>
                          <li>
                            <a href="{{ route('admin.adminuser.create') }}">
                              管理者の作成
                            </a>
                        </ul>
                      </li>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">ログイン</a></li>
                            <!-- <li><a href="{{ route('register') }}">Register</a></li> -->
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('admin.logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            ログアウト
                                        </a>

                                        <form id="logout-form" action="{{ url('admin/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>
    @section('script')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @show
</body>
</html>
