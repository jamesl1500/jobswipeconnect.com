<?php
// Get the user model
use App\Models\User;

// Get data from a post model object
$post = $post ?? null;

// Check if the post object is not null
if ($post) {
    // Get the post id
    $post_id = $post->id;

    // Post type
    $post_type = $post->type;

    // Get the post title
    $post_title = $post->title;

    // Get the post content
    $post_content = $post->content;

    $user = User::find($post->user_id);
}
?>
<div class="post post-type-<?php echo $post->type; ?>" id="post-<?php echo $post_id; ?>">
    <div class="post-inner">
        <div class="post-top">
            <?php if ($post_type == "image") { ?>
                <div class="post-image">
                    <img src="<?php echo asset('storage/' . $post->image); ?>" alt="<?php echo $post_title; ?>">
                </div>
            <?php } ?>
            <div class="post-author">
                <div class="post-author-image">
                    <a href="{{ route('profile.index', ['username' => $user->username]) }}"><img src="<?php echo asset('storage/' . $user->profile_picture); ?>" alt="<?php echo $user->name; ?>"></a>
                </div>
                <div class="post-author-name">
                    <h2><a href="{{ route('profile.index', ['username' => $user->username]) }}"><?php echo $user->name; ?></a></h2>
                    <h4><a href="{{ route('profile.index', ['username' => $user->username]) }}"><?php echo $user->username; ?></a></h4>
                </div>
            </div>
        </div>
        <div class="post-content">
            <h3><?php echo $post_title; ?></h3>
            <p><?php echo $post_content; ?></p>
        </div>
        <div class="post-stats">
            <ul>
                <?php
                // Get the post likes 
                $likes = $post->likes;

                if(count($likes) === 1) {
                    $like_text = "Like";
                } else {
                    $like_text = "Likes";
                }
                ?>
                <li class="post-likes-count" id="post-likes-count-<?php echo $post_id; ?>"><?php echo count($post->likes) . " " . $like_text; ?></li>
                
                <?php
                // Get the post comments
                $comments = $post->comments;

                if(count($comments) === 1) {
                    $comment_text = "Comment";
                } else {
                    $comment_text = "Comments";
                }
                ?>
                <li class="post-comments-count" id="post-comments-count-<?php echo $post_id; ?>"><?php echo count($post->comments) . " " . $comment_text; ?></li>
            </ul>
        </div>
        <div class="post-bottom">
            <div class="post-bottom-left">
                <div class="post-bottom-left-like">
                    <?php
                    // Check if the user has liked the post
                    $liked = $post->likes->contains('user_id', auth()->user()->id);
                    
                    if (!$liked) {
                    ?>
                        <a data-post_id="<?php echo $post_id; ?>" href="<?php echo route('posts.like', ['id' => $post_id]); ?>" class="post-action post-like-btn" id="post-like-btn-<?php echo $post_id; ?>">
                            <i class="fas fa-thumbs-up"></i>
                            <span>Like</span>
                        </a>
                        <a data-post_id="<?php echo $post_id; ?>" href="<?php echo route('posts.unlike', ['id' => $post_id]); ?>" class="post-action post-unlike-btn hidden" id="post-unlike-btn-<?php echo $post_id; ?>">
                            <i class="fas fa-thumbs-up"></i>
                            <span>Unlike</span>
                        </a>
                    <?php } else { ?>
                        <a data-post_id="<?php echo $post_id; ?>" href="<?php echo route('posts.like', ['id' => $post_id]); ?>" class="post-action post-like-btn hidden" id="post-like-btn-<?php echo $post_id; ?>">
                            <i class="fas fa-thumbs-up"></i>
                            <span>Like</span>
                        </a>
                        <a data-post_id="<?php echo $post_id; ?>" href="<?php echo route('posts.unlike', ['id' => $post_id]); ?>" class="post-action post-unlike-btn" id="post-unlike-btn-<?php echo $post_id; ?>">
                            <i class="fas fa-thumbs-up"></i>
                            <span>Unlike</span>
                        </a>
                    <?php } ?>
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
                    <?php
                    // Check if the user is the owner of the post
                    if (auth()->user()->id == $post->user_id) {
                    ?>
                        <a class="delete-post" href="<?php echo route('posts.delete', ['id' => $post_id]); ?>" data-csrf="<?php echo csrf_token(); ?>" data-post_id="<?php echo $post_id; ?>">
                            <i class="fas fa-trash"></i>
                            <span>Delete</span>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="post-comment-maker hidden">
            <div class="post-comment-maker-inner">
                <form action="<?php echo route('posts.comment', ['id' => $post_id]); ?>" method="post" class="post-comment-form" id="post-comment-form-<?php echo $post_id; ?>">
                    @csrf
                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                    <input type="hidden" name="user_id" value="<?php echo auth()->user()->id; ?>">
                    <input type="text" name="comment" id="post-comment-textarea-<?php echo $post_id; ?>" data-postid="<?php echo $post_id; ?>" placeholder="Write a comment..." class="post-comment-textarea">
                </form>
            </div>
        </div>
        <div class="post-comments hidden">
            <div class="post-comments-inner" id="post-comments-inner-<?php echo $post_id; ?>">
                <?php
                // Get the post comments
                $comments = $post->comments;

                if(count($comments) > 0) {
                    // Show the first 3 comments
                    $comments = $comments->take(3);

                    foreach($comments as $comment => $comment_value) {
                        echo view('components.comment', ['comment' => $comment_value]);
                    }

                    // Check if the comments are more than 3
                    if(count($post->comments) > 3) {
                        ?>
                            <a href='<?php echo route('posts.show', ['id' => $post_id]); ?>' class='view-more-comments' data-post_id='" . $post_id . "'>View more comments</a>
                        <?php
                    }
                } 
                ?>
            </div>
        </div>
    </div>
</div>