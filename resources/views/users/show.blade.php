<div class="container">
    <div class="row">
        <h2>User詳細</h2>
    </div>
    <div class="profile-wrap">
        <div class="row">
            <div class="col-md-4 text-center">
                @if (isset($user->profile_image))
                    <p>
                        <img class="round-img" src="{{ asset('storage/images/' . $user->profile_image) }}"/>
                    </p>
                @endif
            </div>
        <div class="col-md-8">
            <div class="row">
                <h1>{{ $user->name }}</h1>
            </div>
            @if (Auth::id() == $user->id)
                <div>
                    <a class="btn btn-outline-dark common-btn edit-profile-btn" href="{{ action('Admin\UsersController@profile_create', ['id' => $user->id]) }}">プロフィールを編集</a>
                </div>
            @endif
            <div class="row">
                <p>
                    {{ $user->profile }}
                </p>
                <p>
                    {{ $user->hobby }}
                </p>
            </div>
            <div>
            @if ( Auth::check() )
                @if (Auth::id() != $user->id)
                    @if (Auth::user()->is_following($user->id))
                        <a class="btn btn-delete" href="{{ action('Admin\UserFollowController@delete', ['id' => $user->id]) }}">アンフォロー</a>
                    @else
                        <a class="btn btn-blue" href="{{ action('Admin\UserFollowController@create', ['id' => $user->id]) }}">フォロー</a>
                    @endif
                @endif
            @endif
            </div>
        </div>
    </div>
</div>
