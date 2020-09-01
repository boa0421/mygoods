@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row">
        <h2>User詳細</h2>
    </div>
    <div class="profile-wrap">
        <div class="row">
            <div class="col-md-4 text-center">
                @if ($user->profile_image)
                    <p>
                        <img class="round-img" src="{{ asset('storage/images/' . $user->profile_image) }}"/>
                    </p>
                @endif
            </div>
        <div class="col-md-8">
            <div class="row">
                <h1>{{ $user->name }}</h1>
            </div>
            <div class="row">
                <p>
                    {{ $user->profile }}
                </p>
                <p>
                    {{ $user->hobby }}
                </p>
            </div>
            <div>
                @if (Auth::id() != $user->id)
                    @if (Auth::user()->is_following($user->id))
                        <div>
                            <a href="{{ action('Admin\UserFollowController@delete', ['id' => $user->id]) }}">アンフォロー</a>
                        </div>
                    @else
                        <div>
                            <a href="{{ action('Admin\UserFollowController@create', ['id' => $user->id]) }}">フォロー</a>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
