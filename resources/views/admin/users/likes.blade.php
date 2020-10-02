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
            <nav>
                <ol class="breadcrumbs">
                    <li><a href="/"><i class="fas fa-home"></i>top</a></li>
                    <li><a href="{{ action('PostsController@index', ['id' => $user->id]) }}">{{ $user->name }}</a></li>
                    <li>{{ $user->name }}のお気に入り一覧</li>
                </ol>
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
                                        <img class="card-img-index" src="{{ $like->image }}" alt="画像">
                                    </a>
                                </div>
                            @endif
                            @if(isset($like->pivot->post_id))
                            <div class="card-content">
                                <div class="card-title-index">
                                    {{ \Str::limit($like->title, 10) }}
                                </div>
                            </div>
                            @endif
                            @if(isset($like->content))
                            <div class="card-content-index">
                                <p class="card-text-index">{{ \Str::limit($like->content, 37) }}</p>
                            </div>
                            @endif
                        </section>
                    @endforeach
                @endif
            </div>
        </div>
        {{ $likes->links() }}
    </div>
@endsection
