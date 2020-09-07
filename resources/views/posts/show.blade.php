@extends('layouts.posts')
@section('title', '登録済みPostの詳細')

@section('content')

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
                    <!--<div class="card-content">-->
                    <!--</div>-->
                    <div class="card-link">
                        <div>
                            <div class="like-show">
                                <div class="row parts">
                                    @if (Auth::id() != $post->user_id)
                                        @if (Auth::user()->is_like($post->id))
                                            <a href="{{ action('Admin\LikesController@delete', ['id' => $post->id]) }}">いいね取り消す</a></a>
                                                @else
                                            <a href="{{ action('Admin\LikesController@create', ['id' => $post->id]) }}">いいね</a>
                                        @endif
                                    @endif
                                </div>
                            </div>
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
                        <!--<div class="card-link">-->

                        <!--</div>-->
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
                            <!--<div class="card-link-items">-->

                            <!--</div>-->
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
                            <!--<div class="card-link-tags">-->

                            <!--</div>-->
                        </section>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
