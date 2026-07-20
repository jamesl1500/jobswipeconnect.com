@php($title = "Messages")
@extends('layouts.authorized')

@section('content')
    <div class="page page-messages">
        <div class="messages-page-header page-header">
            <div class="container page-header-container">
                <div class="page-header-title">
                    <h1>Messages</h1>
                </div>
                <div class="page-header-subtext">
                    <h2>View your messages</h2>
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
                        @php
                            // Get users conversations
                            $conversations = Auth::user()->conversations()->orderBy('updated_at', 'desc')->get();
                        @endphp
                        @foreach($conversations as $conversation)
                            @php
                                // Get other user
                                $otherUser = $conversation_m->GetOtherConversationMember($conversation->conversation_uid, Auth::user()->id);

                                // Get user info
                                $otherUserInfo = App\Models\User::find($otherUser->user_uid);

                                // Get last conversation message
                                $lastMessage = $conversation_m->GetLastMessage($conversation->conversation_uid);

                                // Get conversation unique id
                                $uid = $conversation_m->GetConversationUniqueId($conversation->conversation_uid);
                            @endphp
                                    <li class="conversation-list-item">
                                        <div class="conversations-left-all-inner">
                                            <div class="conversations-left-all-left">
                                                <div class="conversations-left-all-left-inner">
                                                    <a href="/p/{{ $otherUserInfo->username }}">
                                                        <img src="/storage/{{ $otherUserInfo->profile_picture }}" alt="{{ $otherUserInfo->name }}">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="conversations-left-all-right">
                                                <a href="{{ route('messages.conversation', $uid) }}">
                                                    <h3>{{ $otherUserInfo->name }}</h3>
                                                    <p>{{ $lastMessage->conversation_message_content }}</p>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
                <div class="page-conversations-right col-lg-9">
                    <div class="conversations-right-inner">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection