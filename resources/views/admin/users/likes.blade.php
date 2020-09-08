@extends('layouts.posts')
@section('title', 'お気に入り一覧')

@section('content')
@include('admin/users/show')
@include('navbar')

    <div class="container">
        <div class="row">
            <h2>お気に入り一覧</h2>
        </div>
        <div class="row">
            <div class="main-index">
                @if(isset($user))
                    @foreach($user->likes as $like)
                        <section class="card-main-index">
                            @if (isset($like->pivot->image))
                                <div class="image">
                                    <img class="card-img-index" src="{{ asset('storage/image/' . $like->image) }}" alt="プロフィール 画像">
                                </div>
                            @endif
                            @if(isset($like->pivot->post_id))
                            <div class="card-content">
                                <div class="card-title-index">
                                    <a href="{{ action('PostsController@show', ['id' => $like->pivot->post_id]) }}">{{ \Str::limit($like->title, 100) }}</a>
                                </div>
                            </div>
                            @endif
                            @if(isset($like->pivot->content))
                            <div class="card-content-index">
                                <p class="card-text-index">{{ \Str::limit($like->content, 250) }}</p>
                            </div>
                            @endif
                            <!--<div class="card-link-index">-->
    
                            <!--</div>-->
                        </section>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
