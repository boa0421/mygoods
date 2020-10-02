@foreach ($post->comments as $comment) 
    <div class="comments">
        <span class="comment-icon">
            @if (isset($comment->user->profile_image))
                <a href="{{ action('PostsController@index', ['id' => $comment->user->id]) }}">
                    <img class="round-img-comment" src="{{ $comment->user->profile_image }}"/>
                </a>
            @else
                <a href="{{ action('PostsController@index', ['id' => $comment->user->id ]) }}">
                    <i class="fas fa-user-circle fa-2x plofile-icon-comment"></i>
                </a>
            @endif
        </span>
        <span class="comment-contents">{{ $comment->comment }}</span>
        <div class="comment-delete">
            @if ( Auth::check() )
                @if ($comment->user->id == Auth::user()->id)
                    <a class="delete-comment" href="{{ action('Admin\CommentsController@delete', ['id' => $comment->id]) }}"><i class="far fa-times-circle icon-delete-comment"></i></a>
                @endif
            @endif
        </div>
    </div>
@endforeach