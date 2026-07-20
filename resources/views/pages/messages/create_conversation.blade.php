@php
    $title = "Messages";
    $description = "Start conversation with " . $user->name;
@endphp

@extends('layouts.authorized')

@section('content')
    <div class="page page-messages">
        <div class="messages-page-header page-header">
            <div class="container page-header-container">
                <div class="page-header-title">
                    <h1>Messages</h1>
                </div>
                <div class="page-header-subtext">
                    <h2>{{ $description }}</h2>
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
                    </div>
                </div>
                <div class="page-conversations-right col-lg-9">
                    <div class="conversations-right-inner">
                        <div class="conversations-right-head">
                            <div class="conversations-right-head-inner">
                                <div class="conversations-right-head-left">
                                    <h2>Conversation with {{ $user->name }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="conversations-right-body">

                        </div>
                        <div class="conversations-right-footer">
                            <div class="conversations-right-footer-inner">
                                <div class="conversations-right-footer-left">
                                    <form action="{{ route('messages.create_conversation', $user->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        @if(isset($_GET['job_id']))
                                            <input type="hidden" name="job_id" value="{{ $_GET['job_id'] }}">
                                        @endif
                                        <textarea name="message" placeholder="Type your message here..."></textarea>
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