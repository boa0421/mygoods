@extends('layouts.posts')
@section('title', 'フォロワー一覧')

@section('content')

    <div class="container">
        <div class="row">
            <nav class= "nav-user">
                <ul>
                    <li><a href="{{ action('PostsController@index', ['id' => $user->id]) }}">投稿</a></li>
                    <li><a href="{{ action('Admin\UsersController@likes', ['id' => $user->id]) }}">お気に入り</a></li>
                    <li><a href="{{ action('Admin\UsersController@followings', ['id' => $user->id]) }}">フォロー</a></li>
                    <li><a style="background-color: #DDDDDD" href="{{ action('Admin\UsersController@followers', ['id' => $user->id]) }}">フォロワー</a></li>
                </ul>
            </nav>
        </div>
        <div class="row">
            <div class="main-index">
                @if(isset($user))
                    @foreach($user->followers as $follower)
                        <section class="card-main-index">
                            @if (isset($follower->profile_image))
                                <div class="image">
                                    <img class="card-img-index" src="{{ asset('storage/image/' . $follower->profile_image) }}" alt="プロフィール 画像">
                                </div>
                            @endif
                            @if(isset($follower->pivot->user_id))
                            <div class="card-content">
                                <div class="card-title-index">
                                    <a href="{{ action('PostsController@index', ['id' => $follower->pivot->user_id]) }}">{{ \Str::limit($follower->name, 100) }}</a>
                                </div>
                            </div>
                            @endif
                            @if(isset($follower->profile))
                            <div class="card-content-index">
                                <p class="card-text-index">{{ \Str::limit($follower->profile, 250) }}</p>
                            </div>
                            @endif
                            <!--<div class="card-link-index">-->
    
                            <!--</div>-->
                        </section>
                    @endforeach
                @endif
            </div>
        </div>
        {{ $followers->links() }}
    </div>
@endsection
