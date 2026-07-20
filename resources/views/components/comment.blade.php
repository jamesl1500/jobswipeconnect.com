@php
    use App\Models\User;

    $comment_author = User::find($comment->user_id);
    $comment_id = $comment->id;
    $comment_content = $comment->comment;
@endphp
<div class="post-comment" id="post-comment-{{ $comment_id }}">
    <div class="post-comment-inner">
        <div class="post-comment-author">
            <div class="post-comment-author-image">
                <a href="{{ route('profile.index', ['username' => $comment_author->username]) }}"><img src="{{ asset('storage/' . $comment_author->profile_picture) }}" alt="{{ $comment_author->name }}"></a>
            </div>
            <div class="post-comment-author-name">
                <h2><a href="{{ route('profile.index', ['username' => $comment_author->username]) }}">{{ $comment_author->name }}</a></h2>
                <h4><a href="{{ route('profile.index', ['username' => $comment_author->username]) }}">{{ $comment_author->username }}</a></h4>
            </div>
        </div>
        <div class="post-comment-content">
            <p>{{ $comment_content }}</p>
        </div>
        <div class="post-actions">
            <ul>
                <li><a href="#">Like</a></li>
                @if ($comment_author->id == auth()->user()->id)
                    <li><a href="#">Delete</a></li>
                @endif
            </ul>
        </div>
    </div>
</div>