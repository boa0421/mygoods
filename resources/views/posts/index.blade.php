@extends('layouts.posts')
@section('title', '登録済みPostの一覧')

@section('content')
@include('users/show')
@include('navbar')

    <div class="container">
        <div class="row">
            <h2>Post一覧</h2>
        </div>
        <div class="row">
            @if (Auth::id() == $user->id)
                <div class="col-md-4">
                    <a href="{{ action('Admin\PostsController@add') }}" role="button" class="btn btn-primary">新規作成</a>
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
                                    {{ \Str::limit($post->title, 100) }}
                                </div>
                            </div>
                            <div class="card-content-index">
                                <p class="card-text-index">{{ \Str::limit($post->content, 250) }}</p>
                            </div>
                            @if (Auth::id() == $user->id)
                                <div class="card-link-index">
                                    <div class="card-link-edit-index">
                                        <a href="{{ action('Admin\PostsController@edit', ['id' => $post->id]) }}">編集</a>
                                    </div>
                                    <div class="card-link-delete-index">
                                        <a href="{{ action('Admin\PostsController@delete', ['id' => $post->id]) }}">削除</a>
                                    </div>
                                </div>
                            @endif
                        </section>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection


