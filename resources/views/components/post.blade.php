@php
    use App\Models\User;

    $post = $post ?? null;

    if ($post) {
        $post_id = $post->id;
        $post_type = $post->type;
        $post_title = $post->title;
        $post_content = $post->content;
        $user = User::find($post->user_id);
    }
@endphp
<div class="post post-type-{{ $post->type }}" id="post-{{ $post_id }}">
    <div class="post-inner">
        <div class="post-top">
            @if ($post_type == "image")
                <div class="post-image">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post_title }}">
                </div>
            @endif
            <div class="post-author">
                <div class="post-author-image">
                    <a href="{{ route('profile.index', ['username' => $user->username]) }}"><img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}"></a>
                </div>
                <div class="post-author-name">
                    <h2><a href="{{ route('profile.index', ['username' => $user->username]) }}">{{ $user->name }}</a></h2>
                    <h4><a href="{{ route('profile.index', ['username' => $user->username]) }}">{{ $user->username }}</a></h4>
                </div>
            </div>
        </div>
        <div class="post-content">
            <h3>{{ $post_title }}</h3>
            <p>{{ $post_content }}</p>
        </div>
        <div class="post-stats">
            <ul>
                @php
                    $like_text = count($post->likes) === 1 ? 'Like' : 'Likes';
                    $comment_text = count($post->comments) === 1 ? 'Comment' : 'Comments';
                @endphp
                <li class="post-likes-count" id="post-likes-count-{{ $post_id }}">{{ count($post->likes) . ' ' . $like_text }}</li>

                <li class="post-comments-count" id="post-comments-count-{{ $post_id }}">{{ count($post->comments) . ' ' . $comment_text }}</li>
            </ul>
        </div>
        <div class="post-bottom">
            <div class="post-bottom-left">
                <div class="post-bottom-left-like">
                    @php
                        $liked = $post->likes->contains('user_id', auth()->user()->id);
                    @endphp
                    @if (!$liked)
                        <a data-post_id="{{ $post_id }}" href="{{ route('posts.like', ['id' => $post_id]) }}" class="post-action post-like-btn" id="post-like-btn-{{ $post_id }}">
                            <i class="fas fa-thumbs-up"></i>
                            <span>Like</span>
                        </a>
                        <a data-post_id="{{ $post_id }}" href="{{ route('posts.unlike', ['id' => $post_id]) }}" class="post-action post-unlike-btn hidden" id="post-unlike-btn-{{ $post_id }}">
                            <i class="fas fa-thumbs-up"></i>
                            <span>Unlike</span>
                        </a>
                    @else
                        <a data-post_id="{{ $post_id }}" href="{{ route('posts.like', ['id' => $post_id]) }}" class="post-action post-like-btn hidden" id="post-like-btn-{{ $post_id }}">
                            <i class="fas fa-thumbs-up"></i>
                            <span>Like</span>
                        </a>
                        <a data-post_id="{{ $post_id }}" href="{{ route('posts.unlike', ['id' => $post_id]) }}" class="post-action post-unlike-btn" id="post-unlike-btn-{{ $post_id }}">
                            <i class="fas fa-thumbs-up"></i>
                            <span>Unlike</span>
                        </a>
                    @endif
                </div>
                <div class="post-bottom-left-comment">
                    <a href="">
                        <i class="fas fa-comment"></i>
                        <span>Comment</span>
                    </a>
                </div>
            </div>
            <div class="post-bottom-right">
                <div class="post-bottom-right-delete">
                    @if (auth()->user()->id == $post->user_id)
                        <a class="delete-post" href="{{ route('posts.delete', ['id' => $post_id]) }}" data-csrf="{{ csrf_token() }}" data-post_id="{{ $post_id }}">
                            <i class="fas fa-trash"></i>
                            <span>Delete</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="post-comment-maker hidden">
            <div class="post-comment-maker-inner">
                <form action="{{ route('posts.comment', ['id' => $post_id]) }}" method="post" class="post-comment-form" id="post-comment-form-{{ $post_id }}">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post_id }}">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="text" name="comment" id="post-comment-textarea-{{ $post_id }}" data-postid="{{ $post_id }}" placeholder="Write a comment..." class="post-comment-textarea">
                </form>
            </div>
        </div>
        <div class="post-comments hidden">
            <div class="post-comments-inner" id="post-comments-inner-{{ $post_id }}">
                @php
                    $comments = $post->comments;
                @endphp
                @if (count($comments) > 0)
                    @foreach ($comments->take(3) as $comment_value)
                        {!! view('components.comment', ['comment' => $comment_value]) !!}
                    @endforeach
                    @if (count($post->comments) > 3)
                        <a href='{{ route('posts.show', ['id' => $post_id]) }}' class='view-more-comments' data-post_id='" . $post_id . "'>View more comments</a>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>