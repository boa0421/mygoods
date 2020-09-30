@extends('layouts.posts')
@section('title', '登録済みPostの一覧')

@section('content')

    <div class="container">
        <div class="row">
            <nav class= "nav-user">
                <ul>
                    <li><a style="background-color: #DDDDDD" href="{{ action('PostsController@index', ['id' => $user->id]) }}">投稿</a></li>
                    <li><a href="{{ action('Admin\UsersController@likes', ['id' => $user->id]) }}">お気に入り</a></li>
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
                    <li>{{ $user->name }}の投稿一覧</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            @if (Auth::id() == $user->id)
                <div class="post-new-create col-md-4 offset-md-4">
                    <a href="{{ action('Admin\PostsController@add') }}" role="button" class="post-new-create-btn btn btn-primary">新規作成</a>
                </div>
            @endif
            @if (isset($posts))
                <div class="main-index">
                    @foreach($posts as $post)
                        <section class="card-main-index">
                            <div class="image">
                                <a href="{{ action('PostsController@show', ['id' => $post->id]) }}">
                                    <img class="card-img-index" src="{{ asset('storage/image/' . $post->image) }}" alt="post 画像">
                                </a>
                            </div>
                            <div class="card-content">
                                <div class="card-title-index">
                                    {{ \Str::limit($post->title, 10) }}
                                </div>
                            </div>
                            <div class="card-content-index">
                                <p class="card-text-index">{{ \Str::limit($post->content, 37) }}</p>
                            </div>
                            <!--@if (Auth::id() == $user->id)-->
                            <!--    <div class="card-link-index">-->
                            <!--        <div class="card-link-edit-index">-->
                            <!--            <a href="{{ action('Admin\PostsController@edit', ['id' => $post->id]) }}">編集</a>-->
                            <!--        </div>-->
                            <!--        <div class="card-link-delete-index">-->
                            <!--            <a href="{{ action('Admin\PostsController@delete', ['id' => $post->id]) }}">削除</a>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--@endif-->
                        </section>
                    @endforeach
                </div>
            @endif
        </div>
        <!--{{ $posts->links() }}-->
    </div>
@endsection


