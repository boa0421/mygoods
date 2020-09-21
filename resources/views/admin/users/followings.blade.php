@extends('layouts.posts')
@section('title', 'フォロー一覧')

@section('content')

    <div class="container">
        <div class="row">
            <nav class= "nav-user">
                <ul>
                    <li><a href="{{ action('PostsController@index', ['id' => $user->id]) }}">投稿</a></li>
                    <li><a href="{{ action('Admin\UsersController@likes', ['id' => $user->id]) }}">お気に入り</a></li>
                    <li><a style="background-color: #DDDDDD" href="{{ action('Admin\UsersController@followings', ['id' => $user->id]) }}">フォロー</a></li>
                    <li><a href="{{ action('Admin\UsersController@followers', ['id' => $user->id]) }}">フォロワー</a></li>
                </ul>
            </nav>
        </div>
        <div class="row">
            <nav>
                <ol class="breadcrumbs">
                    <li><a href="/"><i class="fas fa-home"></i>top</a></li>
                    <li><a href="{{ action('PostsController@index', ['id' => $user->id]) }}">{{ $user->name }}</a></li>
                    <li>{{ $user->name }}のフォロー一覧</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="main-user-index">
                @if(isset($user))
                    @foreach($user->followings as $following)
                        <section class="card-main-user-index">
                            @if (isset($following->profile_image))
                                <div class="image">
                                    <a href="{{ action('PostsController@index', ['id' => $following->pivot->following_user_id]) }}">
                                        <img class="card-img-user-index" src="{{ asset('storage/image/' . $following->profile_image) }}" alt="プロフィール 画像">
                                    </a>
                                </div>
                            @else
                                <div class="profile-icon">
                                    <a href="{{ action('PostsController@index', ['id' => $following->pivot->following_user_id]) }}">
                                        <i class="fas fa-user-circle plofile-icon"></i>
                                    </a>
                                </div>
                            @endif
                            <div class="user-follow">
                                @if(isset($following->pivot->following_user_id))
                                    <div class="card-title-follow">
                                        {{ \Str::limit($following->name, 100) }}
                                    </div>
                                @endif
                                @if(isset($following->profile))
                                    <div class="card-content-follow">
                                        {{ \Str::limit($following->profile, 250) }}
                                    </div>
                                @endif
                            </div>
                        </section>
                    @endforeach
                @endif
            </div>
        </div>
        {{ $followings->links() }}
    </div>
@endsection
