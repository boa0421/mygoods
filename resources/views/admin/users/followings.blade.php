@extends('layouts.posts')
@section('title', 'フォロー一覧')

@section('content')
@include('admin/users/show')
@include('navbar')

    <div class="container">
        <div class="row">
            <h2>フォロー一覧</h2>
        </div>
        <div class="row">
            <div class="main-index">
                @if(isset($users))
                @foreach($followings as $following)
                    <section class="card-main-index">
                        @if (isset($following->profile_image))
                            <div class="image">
                                <img class="card-img-index" src="{{ asset('storage/image/' . $following->profile_image) }}" alt="プロフィール 画像">
                            </div>
                        @endif
                        <div class="card-content">
                            <div class="card-title-index">
                            <a href="{{ action('UsersController@show', ['id' => $following->id]) }}">{{ \Str::limit($following->name, 100) }}</a>
                            </div>
                        </div>
                        <div class="card-content-index">
                            <p class="card-text-index">{{ \Str::limit($following->profile, 250) }}</p>
                        </div>
                        <!--<div class="card-link-index">-->

                        <!--</div>-->
                    </section>
                @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
