@extends('layouts.users')
@section('title', 'ユーザー一覧')

@section('content')
    <div class="container">
        <div class="row side-navigation">
            <div class="side-user">
                <div class="search-link">
                    <p class="link-title">カテゴリー検索</p>
                    <p><a href="#">Books</a></p>
                    <p><a href="#">Sports</a></p>
                    <p><a href="#">Beauty</a></p>
                    <p><a href="#">Home</a></p>
                    <p><a href="#">Fashion</a></p>
                </div>
            </div>
            <hr>
        </div>
        <div class="row">
            <div class="user-main-user-index">
                @foreach($users as $user)
                    <div class="post">
                        <section class="card-main-user-index">
                            <div class="profile_user-image image">
                                @if (isset($user->profile_image))
                                    <a href="{{ action('UsersController@show', ['id' => $user->id]) }}">
                                        <img class="card-img-index" src="{{ asset('storage/image/' . $user->profile_image) }}" alt="プロフィール画像">
                                    </a>
                                @else
                                    <a href="{{ action('PostsController@index', ['id' => $user->id]) }}">
                                        <i class="fas fa-user-alt fa-4x fa-border plofile-icon"></i>
                                    </a>
                                @endif
                            </div>
                            
                            <div class="card-user-content">
                                <div class="user-name">
                                    <div>
                                        {{ str_limit($user->name, 150) }}
                                    </div>
                                </div>
                                <div class="user-profile">
                                    {{ str_limit($user->profile, 1500) }}
                                </div>
                            </div>
                        </section>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection