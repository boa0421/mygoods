@extends('layouts.top')
@section('title', '登録済みPostの一覧')

@section('content')

    <div class="container">
        {{-- ナビバーをもう一つ作るか検討 --}}
        <!--<div class="row user-category">-->
        <!--    <p>同じ趣味の-->
        <!--    ユーザーを探す</p>-->
        <!--    <nav class= "nav-top">-->
        <!--        <ul>-->
        <!--            <li><a href="#">Books</a></li>-->
        <!--            <li><a href="#">Sports</a></li>-->
        <!--            <li><a href="#">Beauty</a></li>-->
        <!--            <li><a href="#">Home</a></li>-->
        <!--            <li><a href="#">Fashion</a></li>-->
        <!--        </ul>-->
        <!--    </nav>-->
        <!--</div>-->
        <div class="row side-navigation">
            <div class="side-top">
                {{-- サイドバー 検索リンク --}}
                <div class="search-link">
                    <p class="link-title">探す</p>
                    <p><a href="{{ action('UsersController@index' ) }}"><i class="fas fa-user fa-lg icon-gray"></i>ユーザーを探す</a></p>
                    <p><a href="{{ action('ItemsController@index' ) }}"><i class="fas fa-shopping-bag fa-lg icon-gray"></i>アイテムを探す</a></p>
                </div>
                <hr>
                {{-- サイドバー 新しいユーザー一覧 --}}
                <div class="link-user">
                    <p class="link-title">NEW ユーザー</p>
                    @foreach($users as $user)
                        <section class="side-top-user">
                            <div class="side-user">
                                @if(isset($user->profile_image))
                                    <div class="side-user-image">
                                        <a href="{{ action('PostsController@index', ['id' => $user->id]) }}">
                                            <img class="side-user-image" src="{{ $user->profile_image }}" alt="user 画像">
                                        </a>
                                    </div>
                                @else
                                    <div class="side-user-image">
                                        <a href="{{ action('PostsController@index', ['id' => $user->id]) }}">
                                            <i class="fas fa-user-circle fa-3x"></i>
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="side-user-name">
                                @if (isset($user->nickname))
                                    <p>{{ $user->nickname }}</p>
                                @else
                                    <p>{{ $user->name }}</p>
                                @endif
                            </div>
                        </section>
                    @endforeach
                    <p><a class="more-look" href="{{ action('UsersController@index' ) }}">もっと見る</a></p>
                </div>
                <hr>
                {{-- サイドバー 最近のタグ一覧 --}}
                <div class="link-tags">
                    <p class="link-title">最近のタグ</p>
                    @foreach($tags as $tag)
                        <section class="side-top-tag">
                            <p><a class="side-tag" href="{{ action('TagsController@index', ['id' => $tag->id]) }}">#{{ $tag->tag_name }}</p></a>
                        </section>
                    @endforeach
                    <hr>
                </div>
            </div>
        </div>
        {{-- 最近のポスト一覧 --}}
        <div class="row">
            <div class="main-index">
                @foreach($posts as $post)
                    <section class="card-main-index">
                        <div class="image">
                            <a href="{{ action('PostsController@show', ['id' => $post->id]) }}">
                                <img class="card-img-index" src="{{ $post->image }}" alt="post 画像">
                            </a>
                        </div>
                        <div class="card-content">
                            <div class="card-title-index">
                                {{ \Str::limit($post->title, 10) }}
                            </div>
                        </div>
                        <div class="card-content-index">
                            <p class="card-text-index">{{ \Str::limit($post->content, 45) }}</p>
                        </div>
                    </section>
                @endforeach
            </div>
        </div>
        {{ $posts->links() }}
    </div>
@endsection