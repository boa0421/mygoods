@foreach ($post->comments as $comment) 
  <div class="mb-2">
    @if ($comment->user->id == Auth::user()->id)
      <a class="delete-comment" data-remote="true" rel="nofollow" data-method="delete" href="admin/comments/{{ $comment->id }}"></a>
    @endif
    <span>
      <strong>
        <a class="no-text-decoration black-color" href="# {{ $comment->user->id }}">{{ $comment->user->name }}</a>
      </strong>
    </span>
    <span>{{ $comment->comment }}</span>
  </div>
@endforeach