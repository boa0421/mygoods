@extends('layouts.posts')
@section('title', 'お気に入り一覧')

@section('content')

    <div class="container">
        <div class="row">
            <nav class= "nav-user">
                <ul>
                    <li><a href="{{ action('PostsController@index', ['id' => $user->id]) }}">投稿</a></li>
                    <li><a style="background-color: #DDDDDD" href="{{ action('Admin\UsersController@likes', ['id' => $user->id]) }}">お気に入り</a></li>
                    <li><a href="{{ action('Admin\UsersController@followings', ['id' => $user->id]) }}">フォロー</a></li>
                    <li><a href="{{ action('Admin\UsersController@followers', ['id' => $user->id]) }}">フォロワー</a></li>
                </ul>
            </nav>
        </div>
        <div class="row">
            <div class="main-index">
                @if(isset($user))
                    @foreach($user->likes as $like)
                        <section class="card-main-index">
                            @if (isset($like->image))
                                <div class="image">
                                    <a href="{{ action('PostsController@show', ['id' => $like->pivot->post_id]) }}">
                                        <img class="card-img-index" src="{{ asset('storage/image/' . $like->image) }}" alt="画像">
                                    </a>
                                </div>
                            @endif
                            @if(isset($like->pivot->post_id))
                            <div class="card-content">
                                <div class="card-title-index">
                                    {{ \Str::limit($like->title, 100) }}
                                </div>
                            </div>
                            @endif
                            @if(isset($like->content))
                            <div class="card-content-index">
                                <p class="card-text-index">{{ \Str::limit($like->content, 250) }}</p>
                            </div>
                            @endif
                            <!--<div class="card-link-index">-->
    
                            <!--</div>-->
                        </section>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
