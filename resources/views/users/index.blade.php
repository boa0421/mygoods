@extends('layouts.index')
@section('title', 'ユーザー一覧')

@section('content')
    <div class="container">
        <div class="row">
            <nav>
                <ol class="breadcrumbs breadcrumbs-user-in">
                    <li><a href="/"><i class="fas fa-home"></i>top</a></li>
                    <li>ユーザー一覧</li>
                </ol>
            </nav>
        </div>
        <!--<div class="row side-navigation">-->
        <!--    <div class="side-user">-->
        <!--        <div class="search-link">-->
        <!--            <p class="link-title">カテゴリー検索</p>-->
        <!--            <p><a href="#">Books</a></p>-->
        <!--            <p><a href="#">Sports</a></p>-->
        <!--            <p><a href="#">Beauty</a></p>-->
        <!--            <p><a href="#">Home</a></p>-->
        <!--            <p><a href="#">Fashion</a></p>-->
        <!--            <p><a href="#">Cooking</a></p>-->
        <!--            <p><a href="#">Pets</a></p>-->
        <!--            <p><a href="#">Business</a></p>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--    <hr>-->
        <!--</div>-->
        <div class="row">
            <div class="users-list-index">
                @foreach($users as $user)
                    <div class="post">
                        <section class="card-main-user-index">
                            <div class="profile_user-image image">
                                @if (isset($user->profile_image))
                                    <a href="{{ action('PostsController@index', ['id' => $user->id]) }}">
                                        <img class="card-img-user-index" src="{{ $user->profile_image }}" alt="プロフィール画像">
                                    </a>
                                @else
                                    <div class="profile-icon">
                                        <a href="{{ action('PostsController@index', ['id' => $user->id]) }}">
                                            <i class="fas fa-user-circle fa-7x plofile-icon card-img-user-index"></i>
                                        </a>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="card-user-content">
                                <div class="user-name">
                                    @if (isset($user->nickname))
                                        <h1>{{ $user->nickname }}</h1>
                                    @else
                                        <h1>{{ $user->name }}</h1>
                                    @endif
                                </div>
                                <div class="user-profile">
                                    {{ str_limit($user->profile, 1500) }}
                                </div>
                            </div>
                            
                            <div class="follow-btn">
                                @if ( Auth::check() )
                                    @if (Auth::id() != $user->id)
                                        @if (Auth::user()->is_following($user->id))
                                            <a class="btn btn-delete-user-index" href="{{ action('Admin\UserFollowController@delete', ['id' => $user->id]) }}">アンフォロー</a>
                                        @else
                                            <a class="btn btn-blue-user-index" href="{{ action('Admin\UserFollowController@create', ['id' => $user->id]) }}">フォロー</a>
                                        @endif
                                    @endif
                                @else
                                    <a class="btn btn-blue-user-index" href="{{ action('Admin\UserFollowController@create', ['id' => $user->id]) }}">フォロー</a>
                                @endif
                            </div>
                            
                        </section>
                    </div>
                @endforeach
            </div>
        </div>
        {{ $users->links() }}
    </div>
@endsection