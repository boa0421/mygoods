<nav class= "nav">
    <ul>
        <li><a class=”current” href=”#”>Home</a></li>
        <li><a href=”#”>投稿</a></li>
        <li><a href=”#”>お気に入り</a></li>
        <li><a href="{{ action('Admin\UsersController@followings', ['id' => $user->id]) }}">フォロー</a></li>
        <li><a href="{{ action('Admin\UsersController@followers', ['id' => $user->id]) }}">フォロワー</a></li>
    </ul>
</nav>