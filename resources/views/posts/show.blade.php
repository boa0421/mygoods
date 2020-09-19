@extends('layouts.show')
@section('title', '登録済みPostの詳細')

@section('content')

    <div class="container">
        <div class="row">
            <nav>
                <ol class="breadcrumbs">
                    <li><a href="#"><i class="fas fa-home"></i>top</a></li>
                    <li><a href="#">{{ $user->name }}</a></li>
                    <li>{{ $post->created_at }}の投稿</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="main">
                <section class="card-main">
                    <div class="image">
                        <img class="card-img original-img" src="{{ asset('storage/image/' . $post->image) }}" alt="post 画像">
                    </div>
                    <div class="card-link">
                        <div>
                            <div class="like-show">
                                <div class="row parts">
                                    @if ( Auth::check() )
                                        @if (Auth::id() != $post->user_id)
                                            @if (Auth::user()->is_like($post->id))
                                                <a class="btn btn-delete" href="{{ action('Admin\LikesController@delete', ['id' => $post->id]) }}"><i class="fas fa-heart"></i></a>
                                            @else
                                                <a class="btn btn-blue" href="{{ action('Admin\LikesController@create', ['id' => $post->id]) }}"><i class="fas fa-heart"></i></a>
                                            @endif
                                        @endif
                                    @else
                                        @if (Auth::id() != $post->user_id)
                                            <a class="btn btn-blue" href="{{ action('Admin\LikesController@create', ['id' => $post->id]) }}"><i class="fas fa-heart"></i></a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <div class="comment-post">
                                @if(isset($post->comments))
                                    @include('posts.comment_list')
                                @else
                                    <p>コメントはまだありません</p>
                                @endif
                            <hr>
                            </div>
                            @if ( Auth::check() )
                                <div class="row actions" id="comment-form-post-{{ $post->id }}">
                                    <form action="{{ action('Admin\CommentsController@create', ['id' => $post->id]) }}" method="post" enctype="multipart/form-data">
                                        <input value="{{ Auth::user()->id }}" type="hidden" name="user_id" >
                                        <input value="{{ $post->id }}" type="hidden" name="post_id" >
                                        <input class="form-control comment-input border-0" placeholder="コメントを書く" autocomplete="off" type="text" name="comment" >
                                        {{csrf_field()}} 
                                        <input type="submit" class="btn btn-blue" value="更新">
                                    </form>
                                </div>
                            @endif
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
                            <hr>
                            <p class="card-text">{{ $post->created_at }}</p>
                        </div>
                        @if (Auth::id() == $user->id)
                            <div class="card-link">
                                <div>
                                    <a href="{{ action('Admin\PostsController@edit', ['id' => $post->id]) }}">編集</a>
                                </div>
                                <div>
                                    <a href="{{ action('Admin\PostsController@delete', ['id' => $post->id]) }}">削除</a>
                                </div>
                            </div>
                        @endif
                    </section>
                    <div class="item_list">
                        @if(isset($post->items))
                            <h3>アイテムリスト</h3>
                        @endif
                        @if (Auth::id() == $user->id)
                            <div class="items">
                                <div class="btn btn-outline-dark " id='create-items'>アイテムを追加する+</div>
                            </div>
                            @include('admin.items.create')
                        @endif
                        @foreach($post->items as $item)
                            <section class="card-items">
                                <div class="image-items">
                                    <img class="card-img-items" src="{{ asset('storage/image/' . $item->item_image) }}" alt="アイテム画像">
                                </div>
                                <div class="card-content-items">
                                    <div class="card-title-items">
                                        {{ \Str::limit($item->item_name, 100) }}
                                    </div>
                                    <div class="card-link-bottun">
                                        <div class="card-shop-items">
                                            <a target="_blank" href="{{ $item->shop }}" class="btn btn-blue"><i class="fas fa-shopping-basket fa-position-left"></i>ショップはこちら</a>
                                        </div>
                                        @if (Auth::id() == $user->id)
                                            <div class="card-link-items">
                                                <div class="card-link-delete-items">
                                                    <a href="{{ action('Admin\ItemsController@delete', ['id' => $item->id]) }}" class="item-cercle-icon"><i class="far fa-times-circle"></i></a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </section>
                        @endforeach
                    </div>
                    <div class="tag_list">
                        @if(isset($post->tags))
                            <h3>タグ一覧</h3>
                        @endif
                        @if (Auth::id() == $user->id)
                            <div class="tag-create">
                                <div class="btn btn-outline-dark" id='create-tags'>タグを追加する+</div>
                            </div>
                            @include('admin.tags.create', ['post_id' => $post->id])
                        @endif
                        @foreach($post->tags as $tag)
                            <section class="card-tags">
                                <div class="card-content-tags">
                                    #{{ $tag->tag_name }}
                                </div>
                                @if (Auth::id() == $user->id)
                                    <div class="card-link-tags">
                                        <div class="card-link-delete-tags">
                                            <a href="{{ action('Admin\TagsController@delete', ['id' => $tag->id]) }}" class="tag-cercle-icon"><i class="far fa-times-circle"></i></a>
                                        </div>
                                    </div>
                                @endif
                            </section>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


