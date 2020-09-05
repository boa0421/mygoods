@extends('layouts.posts')
@section('title', 'フォロワー一覧')

@section('content')
@include('admin/users/show')
@include('navbar')

    <div class="container">
        <div class="row">
            <h2>フォロワー一覧</h2>
        </div>
        <div class="row">
            <div class="main-index">
                @if(isset($user))
                    @foreach($user->followers as $follower)
                        <section class="card-main-index">
                            @if (isset($follower->pivot->profile_image))
                                <div class="image">
                                    <img class="card-img-index" src="{{ asset('storage/image/' . $follower->profile_image) }}" alt="プロフィール 画像">
                                </div>
                            @endif
                            @if(isset($follower->pivot->user_id))
                            <div class="card-content">
                                <div class="card-title-index">
                                    <a href="{{ action('UsersController@show', ['id' => $follower->pivot->user_id]) }}">{{ \Str::limit($follower->name, 100) }}</a>
                                </div>
                            </div>
                            @endif
                            @if(isset($follower->pivot->profile))
                            <div class="card-content-index">
                                <p class="card-text-index">{{ \Str::limit($follower->profile, 250) }}</p>
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
