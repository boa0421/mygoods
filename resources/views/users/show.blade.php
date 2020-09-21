
<div class="container_user">
    <div class="profile-wrap">
        <div class="row">
            <div class="col-md-4 text-center">
                @if (isset($user->profile_image))
                    <a href="{{ action('PostsController@index', ['id' => $user->id]) }}">
                        <img class="round-img" src="{{ asset('storage/image/' . $user->profile_image) }}"/>
                    </a>
                @else
                    <div class="profile-icon">
                        <a href="{{ action('PostsController@index', ['id' => $user->id]) }}">
                            <i class="fas fa-user-alt fa-4x fa-border plofile-icon"></i>
                        </a>
                    </div>
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
                <ul class="profile-contents">
                    <li>{{ $user->profile }}</li>
                    <li>{{ $user->interest }}</li>
                </ul>
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
            @else
                <a class="btn btn-blue" href="{{ action('Admin\UserFollowController@create', ['id' => $user->id]) }}">フォロー</a>
            @endif
            </div>
        </div>
    </div>
</div>

