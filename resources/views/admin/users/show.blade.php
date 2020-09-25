<div class="container">
    <div class="row">
        <h2> admin User詳細</h2>
    </div>
    <div class="profile-wrap">
        <div class="row">
            <div class="col-md-4 text-center">
                @if (isset($user->profile_image))
                    <a href="{{ action('PostsController@index', ['id' => $user->id]) }}">
                        <img class="round-img" src="{{ asset('storage/images/' . $user->profile_image) }}"/>
                    </a>
                @endif
            </div>
        <div class="col-md-8">
            <div class="row">
                <h1>{{ $user->name }}</h1>
                <div>
                    <a class="btn btn-outline-dark common-btn edit-profile-btn" href="{{ action('Admin\ProfilesController@create', ['id' => $user->id]) }}">プロフィールを編集</a>
                </div>
            </div>
            <div class="row">
                <p>
                    {{ $user->profile }}
                </p>
                <p>
                    {{ $user->interest }}
                </p>
            </div>
        </div>
    </div>
</div>

