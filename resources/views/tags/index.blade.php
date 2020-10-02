@extends('layouts.index')
@section('title', '登録済みPostの一覧')

@section('content')

    <div class="container">
        <div class="row">
            <nav>
                <ol class="breadcrumbs">
                    <li><a href="/"><i class="fas fa-home"></i>top</a></li>
                    <li>「{{ $tag->tag_name }}」の投稿一覧</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            @if (isset($posts))
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
            @endif
        </div>
    </div>
@endsection


