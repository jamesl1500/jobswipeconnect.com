<?php

$title = "Messages";
$description = "Conversation with ";

// Get conversation id
$cid = $conversation_m->GetConversationNumericalId($id);

// Get other user
$otherUser = $conversation_m->GetOtherConversationMember($cid, Auth::user()->id);
$user = App\Models\User::find($otherUser->user_uid);

// Get conversation messages
$messages = $conversation_m->GetConversationMessages($id);

?>

@extends('layouts.authorized')

@section('content')
    <div class="page page-messages">
        <div class="messages-page-header page-header">
            <div class="container page-header-container">
                <div class="page-header-title">
                    <h1>Messages</h1>
                </div>
                <div class="page-header-subtext">
                    <h2><?php echo $description; ?> <?php echo $user->name; ?></h2>
                </div>
            </div>
        </div>
        <div class="page-content container-lg container-md container-sm">
            <div class="row">
                <div class="page-coversations-left col-lg-3">
                    <div class="conversations-left-head">
                        <div class="conversations-left-head-inner">
                            <div class="conversations-left-head-left">
                                <h2>Conversations</h2>
                            </div>
                        </div>
                    </div>
                    <div class="conversations-left-all">
                        <ul>
                        <?php 
                            // Get users conversations
                            $conversations = Auth::user()->conversations()->orderBy('updated_at', 'desc')->get();

                            // Loop through conversations
                            foreach($conversations as $conversation) {
                            // Get other user
                            $otherUser = $conversation_m->GetOtherConversationMember($conversation->conversation_uid, Auth::user()->id);

                            // Get user info
                            $otherUserInfo = App\Models\User::find($otherUser->user_uid);

                            // Get last conversation message
                            $lastMessage = $conversation_m->GetLastMessage($conversation->conversation_uid);

                            // Get conversation unique id
                            $uid = $conversation_m->GetConversationUniqueId($conversation->conversation_uid);
                                ?>
                                    <li class="conversation-list-item">
                                        <div class="conversations-left-all-inner">
                                            <div class="conversations-left-all-left">
                                                <div class="conversations-left-all-left-inner">
                                                    <a href="/p/<?php echo $otherUserInfo->username; ?>">
                                                        <img src="/storage/<?php echo $otherUserInfo->profile_picture; ?>" alt="<?php echo $otherUserInfo->name; ?>">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="conversations-left-all-right">
                                                <a href="{{ route('messages.conversation', $uid) }}">
                                                    <h3><?php echo $otherUserInfo->name; ?></h3>
                                                    <p><?php echo $lastMessage->conversation_message_content; ?></p>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                <?php
                            }
                        ?>
                        </ul>
                    </div>
                </div>
                <div class="page-conversations-right col-lg-9">
                    <div class="conversations-right-inner">
                        <div class="conversations-right-head">
                            <div class="conversations-right-head-inner">
                                <div class="conversations-right-head-left">
                                    <?php
                                        // Get name of other user
                                        $user = App\Models\User::find($otherUser->user_uid);
                                    ?>
                                    <h2>Conversation with <?php echo $user->name; ?></h2>
                                </div>
                            </div>
                        </div>
                        <div id="conversations-right-body" class="conversations-right-body">
                            <?php
                                foreach($messages as $message)
                                {
                                    $user = App\Models\User::find($message->user_uid);

                                    // Check if message is from current user
                                    if($message->user_uid == Auth::user()->id)
                                    {
                                        $messageClass = "conversations-right-body-message-me";   
                                    }else{
                                        $messageClass = "conversations-right-body-message-other";
                                    }
                                    
                                    // Render message
                                    echo view('components.message', ['message' => $message, 'messageClass' => $messageClass])->render();
                                }
                            ?>
                        </div>
                        <div class="conversations-right-footer">
                            <div class="conversations-right-footer-inner">
                                <div class="conversations-right-footer-left">
                                    <form action="<?php echo route('messages.sendMessage'); ?>" id="message-form" method="POST">
                                        @csrf
                                        <input type="hidden" id="conversation_uid" name="conversation_uid" value="<?php echo $id; ?>">
                                        <textarea name="message" id="message-textarea" placeholder="Type your message here..."></textarea>
                                        <button class="btn btn-primary" type="submit">Send</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection