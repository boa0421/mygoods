@extends('layouts.posts')
@section('title', '登録済みPostの詳細')

@section('content')
@include('admin/users/show')
@include('navbar')
    <div class="container">
        <div class="row">
            <h2>Post詳細</h2>
        </div>
        <div class="row">
            <div class="main">
                <section class="card-main">
                    <div class="image">
                        <img class="card-img" src="{{ asset('storage/image/' . $post->image) }}" alt="post 画像">
                    </div>
                    <div class="card-content">
                        <div id="like-icon-post-{{ $post->id }}">
                            @if (Auth::user() != $post->user_id)
                                @if ($post->likedBy(Auth::user())->count() > 0)
                                    <a class="loved hide-text" data-remote="true" rel="nofollow" data-method="DELETE" href="/admin/likes/{{ $post->likedBy(Auth::user())->firstOrFail()->id }}">いいねを取り消す</a>
                                @else
                                    <a class="love hide-text" data-remote="true" rel="nofollow" data-method="POST" href="/admin/posts/{{ $post->id }}/likes">いいね</a>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="card-link">
                        <div>
                            <h3>コメント蘭</h3>
                        </div>
                    </div>
                </section>
            </div>
            
            <div id="sidebar">
                <div class="banner">
                    <section class="card-side">
                        <div class="card-content">
                            <h1 class="card-title">{{ \Str::limit($post->title, 100) }}</h1>
                            <p class="card-text">{{ \Str::limit($post->content, 250) }}</p>
                        </div>
                        <div class="card-link">
                            <div>
                                <a href="{{ action('Admin\PostsController@edit', ['id' => $post->id]) }}">編集</a>
                            </div>
                            <div>
                                <a href="{{ action('Admin\PostsController@delete', ['id' => $post->id]) }}">削除</a>
                            </div>
                            <div>
                                <a href="{{ action('Admin\ItemsController@add', ['post_id' => $post->id]) }}">アイテム追加</a>
                            </div>
                            <div>
                                <a href="{{ action('Admin\TagsController@add', ['post_id' => $post->id]) }}">タグ追加</a>
                            </div>
                        </div>
                    </section>
                    <div class="item_list">
                        <h3>アイテムリスト</h3>
                    </div>
                    @foreach($post->items as $item)
                        <section class="card-items">
                            <div class="image-items">
                                <img class="card-img-items" src="{{ asset('storage/image/' . $item->item_image) }}" alt="アイテム画像">
                            </div>
                            <div class="card-content-items">
                                <div class="card-title-items">
                                    {{ \Str::limit($item->item_name, 100) }}
                                </div>
                            </div>
                            <div class="card-content-items">
                                <a target="_blank" href="{{ $item->shop }}">ショップはこちら</a>
                            </div>
                            <div class="card-link-items">
                                <div class="card-link-delete-items">
                                    <a href="{{ action('Admin\ItemsController@delete', ['id' => $item->id]) }}">削除</a>
                                </div>
                            </div>
                        </section>
                    @endforeach
                    <div class="tag_list">
                        <h3>タグ一覧</h3>
                    </div>
                    @foreach($post->tags as $tag)
                        <section class="card-tags">
                            <div class="card-content-tags">
                                <div class="card-title-tags">
                                    {{ $tag->tag_name }}
                                </div>
                            </div>
                            <div class="card-link-tags">
                                <div class="card-link-delete-tags">
                                    <a href="{{ action('Admin\TagsController@delete', ['id' => $tag->id]) }}">削除</a>
                                </div>
                            </div>
                        </section>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
