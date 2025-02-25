<?php
use App\Models\User;

$user = User::find($message->user_uid);
?>
<div class="conversations-right-body-message <?php echo $messageClass; ?>">
    <div class="conversations-right-body-message-inner">
        <div class="conversations-right-body-message-left">
            <div class="conversations-right-body-message-left-inner">
                <a class="conversations-right-body-message-left-avatar" href="/p/<?php echo $user->username; ?>">
                    <img src="/storage/<?php echo $user->profile_picture; ?>" alt="<?php echo $user->name; ?>">
                </a>
            </div>
        </div>
        <div class="conversations-right-body-message-right">
            <div class="conversations-right-body-message-right-inner">
                <div class="conversations-right-body-message-right-head">
                    <div class="conversations-right-body-message-right-head-inner">
                        <div class="conversations-right-body-message-right-head-left">
                            <h3><?php echo ucwords($user->name); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="conversations-right-body-message-right-body">
                    <div class="conversations-right-body-message-right-body-inner">
                        <p><?php echo $message->conversation_message_content; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>