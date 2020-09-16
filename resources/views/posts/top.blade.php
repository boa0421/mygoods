@extends('layouts.top')
@section('title', '登録済みPostの一覧')

@section('content')

    <div class="container">
        <div class="row">
            <h2>Post一覧</h2>
        </div>
        <div class="row">
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
                            <p class="card-text-index">{{ \Str::limit($post->content, 45) }}</p>
                        </div>
                        <div class="card-link-index">

                        </div>
                    </section>
                @endforeach
            </div>
        </div>
    </div>
@endsection