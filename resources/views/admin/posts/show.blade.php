@extends('layouts.posts')
@section('title', '登録済みPostの詳細')

@section('content')
@include('admin/users/show')
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
                        <!--<h1 class="card-title">画像</h1>-->
                    </div>
                    <div class="card-link">
                        <div>
                            <h3>いいねボタン</h3>
                        </div>
                        <div>
                            <h3>フォローボタン</h3>
                        </div>
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
                        </div>
                    </section>
                    
                    @foreach($post->items as $item)
                        <section class="card-items">
                            <div class="image-item">
                                <img class="card-img-item" src="{{ asset('storage/image/' . $item->item_image) }}" alt="アイテム画像">
                            </div>
                            <div class="card-content-items">
                                <div class="card-title-items">
                                    {{ \Str::limit($item->item_name, 100) }}
                                </div>
                            </div>
                            <div class="card-content-items">
                                <p class="card-text-items">{{ \Str::limit($item->shop, 100) }}</p>
                            </div>
                            <div class="card-link-items">
                                <div class="card-link-delete-items">
                                    <a href="{{ action('Admin\ItemsController@delete', ['id' => $item->id]) }}">削除</a>
                                </div>
                            </div>
                        </section>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
