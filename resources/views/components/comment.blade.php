<?php
use App\Models\User;

// Get post comment
$comment_author = User::find($comment->user_id);

// Get the comment id
$comment_id = $comment->id;

// Get the comment content
$comment_content = $comment->comment;

// Get the comment date
$comment_date = $comment->created_at;
?>
<div class="post-comment" id="post-comment-<?php echo $comment_id; ?>">
    <div class="post-comment-inner">
        <div class="post-comment-author">
            <div class="post-comment-author-image">
                <a href="{{ route('profile.index', ['username' => $comment_author->username]) }}"><img src="<?php echo asset('storage/' . $comment_author->profile_picture); ?>" alt="<?php echo $comment_author->name; ?>"></a>
            </div>
            <div class="post-comment-author-name">
                <h2><a href="{{ route('profile.index', ['username' => $comment_author->username]) }}">{{ $comment_author->name }}</a></h2>
                <h4><a href="{{ route('profile.index', ['username' => $comment_author->username]) }}">{{ $comment_author->username }}</a></h4>
            </div>
        </div>
        <div class="post-comment-content">
            <p><?php echo $comment_content; ?></p>
        </div>
        <div class="post-actions">
            <ul>
                <li><a href="#">Like</a></li>
                <?php 
                if($comment_author->id == auth()->user()->id) {
                    ?>

                    <li><a href="#">Delete</a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>