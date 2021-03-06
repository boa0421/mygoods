<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>

        <!-- Scripts -->
        <script src="{{ secure_asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ secure_asset('css/posts.css') }}" rel="stylesheet">
        <link href="{{ secure_asset('css/users.css') }}" rel="stylesheet">
        <link href="{{ secure_asset('css/navbar.css') }}" rel="stylesheet">
        <link href="{{ secure_asset('css/footer.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            {{-- ナビゲーションバー --}}
            <nav class="navbar navbar-expand-md navbar-dark navbar-laravel">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        My Goods
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        {{-- ログインしていなかったらログイン画面へのリンクを表示 --}}
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        {{-- ログインしていたらユーザー名とログアウトボタンを表示 --}}
                        @else
                            <li class="nav-item dropdown"><a class="nav-link" href="{{ action('PostsController@index', ['id' => $user->id]) }}">{{ $user->name }}のマイページへ</a></li>
                            <li class="nav-item dropdown"><a class="nav-link" href="{{ action('Admin\UsersController@edit') }}">アカウント編集</a></li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                        @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            {{-- ここまでナビゲーションバー --}}
            <div>
            <div class="row top-image-post">
                <a href="{{ action('PostsController@about') }}">
                    <img class="top-image-post col-lg-12" src="/image/smallflowers.png" alt="花のイラスト" title="お気に入りを見つけよう">
                </a>
            </div>
            
            <div class="container_user">
                <div class="profile-wrap">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            @if (isset($user->profile_image))
                                <a href="{{ action('PostsController@index', ['id' => $user->id]) }}">
                                    <img class="round-img" src="{{ $user->profile_image }}"/>
                                </a>
                            @else
                                <div class="profile-icon">
                                    <a href="{{ action('PostsController@index', ['id' => $user->id]) }}">
                                        <i class="far fa-user-circle fa-7x plofile-icon"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    <div class="col-md-8">
                        <div class="row user-name">
                            @if (isset($user->nickname))
                                <h1>{{ $user->nickname }}</h1>
                            @else
                                <h1>{{ $user->name }}</h1>
                            @endif
                        </div>
                        @if (Auth::id() == $user->id)
                            <div>
                                <a class="btn btn-outline-dark common-btn edit-profile-btn" href="{{ action('Admin\UsersController@profile_create', ['id' => $user->id]) }}">プロフィールを編集</a>
                            </div>
                        @endif
                        <div class="row user-follow">
                            <ul class="profile-contents">
                                <p>{!! nl2br(e($user->profile)) !!}</p>
                                
                                <!--趣味-->
                                <!--@foreach($user->interests as $interest)-->
                                <!--    <p>{{ $interest->interest }}</p>-->
                                <!--@endforeach-->
                                
                                <!--アコーディオンボタン-->
                                <!--<div class="more-button">-->
                                <!--    <p>プロフィールをみる</p>-->
                                <!--</div>-->
                            </ul>
                            {{-- フォローボタン --}}
                            <div class="user-follow-btn">
                                @if ( Auth::check() )
                                    @if (Auth::id() != $user->id)
                                        @if (Auth::user()->is_following($user->id))
                                            <a class="btn btn-delete" href="{{ action('Admin\UserFollowController@delete', ['id' => $user->id]) }}">アンフォロー</a>
                                        @else
                                            <a class="btn btn-blue" href="{{ action('Admin\UserFollowController@create', ['id' => $user->id]) }}">フォロー</a>
                                        @endif
                                    @endif
                                @else
                                    <a class="btn btn-blue" href="{{ action('Admin\UserFollowController@create', ['id' => $user->id]) }}">フォロー</a>
                                @endif
                            </div>
                            {{-- フォローボタンここまで --}}
                        </div>
                    </div>
                </div>
            </div>
            <main class="py-4">
                @yield('content')
            </main>
        </div>
        </div>
        <footer>
            <ul class="footer-menu">
                <li><a href="/">投稿一覧</a></li>
                <li><a href="{{ action('UsersController@index' ) }}">ユーザー一覧</a></li>
                <li><a href="{{ action('ItemsController@index' ) }}">アイテム一覧</a></li>
                <li><a href="{{ action('PostsController@about') }}">はじめての方へ</a></li>
            </ul>
            <p>© All rights reserved by ai_sogabe.</p>
        </footer>
    </body>

</html>
