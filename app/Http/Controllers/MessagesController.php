<?php

namespace App\Http\Controllers;

use App\Events\MessagePosted;
use App\Libraries\Conversation;
use App\Models\Conversation_members;
use App\Models\Conversation_messages;
use App\Models\Conversations;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MessagesController extends Controller
{
    protected Conversation $conversation;

    public function __construct()
    {
        $this->conversation = new Conversation();
    }

    public function index(): View
    {
        return view('pages.messages.index', ['conversation_m' => $this->conversation]);
    }

    public function conversation(int $id): RedirectResponse|View
    {
        $conversation = $this->conversation->CheckIfConversationExistsByUid($id);

        if (!$conversation) {
            return redirect('/messages')->with('error', 'Conversation does not exist.');
        }

        return view('pages.messages.conversation', ['id' => $id, 'conversation_m' => $this->conversation]);
    }

    public function createConversation(int $user_id): RedirectResponse|View
    {
        // Check if they have a conversation already
        $conversation = $this->conversation->CheckIfConversationExists(Auth::user()->id, $user_id);

        if ($conversation) {
            return redirect('/messages/conversation/' . $conversation->conversation_uid);
        }

        $user = User::where('id', $user_id)->first();

        return view('pages.messages.create_conversation', ['user' => $user]);
    }

    public function createConversationPost(Request $request): RedirectResponse
    {
        $request->validate([
            'user_id' => 'required',
            'message' => 'required',
            'job_id'  => '',
        ]);

        $user = User::where('id', $request->input('user_id'))->first();

        if (!$user) {
            return redirect('/messages')->with('error', 'User does not exist.');
        }

        // Check if they have a conversation already
        $conversation = $this->conversation->CheckIfConversationExists(Auth::user()->id, $request->input('user_id'));

        if ($conversation) {
            return redirect('/messages/conversation/' . $conversation->conversation_uid);
        }

        $conversation = Conversations::create([
            'conversation_uid' => $this->conversation->GenerateUid(),
            'conversation_sender' => Auth::user()->id,
            'conversation_receiver' => $request->input('user_id'),
            'conversation_name' => '',
            'job_id' => $request->input('job_id') ?? null,
            'status' => 'active',
            'applicant_notes' => '',
            'job_poster_notes' => '',
            'conversation_description' => 'Conversation between ' . Auth::user()->name . ' and ' . $user->name,
        ]);

        Conversation_messages::create([
            'conversation_message_uid' => $this->conversation->GenerateUid(),
            'conversation_uid' => $conversation->id,
            'user_uid' => Auth::user()->id,
            'conversation_message_content' => $request->input('message'),
            'conversation_message_type' => 'text',
            'status' => 'sent',
        ]);

        // Sender joins as the conversation admin
        Conversation_members::create([
            'conversation_member_uid' => $this->conversation->GenerateUid(),
            'conversation_uid' => $conversation->id,
            'user_uid' => Auth::user()->id,
            'user_role' => 'admin',
        ]);

        // Receiver joins as a regular member
        Conversation_members::create([
            'conversation_member_uid' => $this->conversation->GenerateUid(),
            'conversation_uid' => $conversation->id,
            'user_uid' => $request->input('user_id'),
            'user_role' => 'member',
        ]);

        return redirect('/messages/conversation/' . $conversation->conversation_uid);
    }

    public function sendMessagePost(Request $request): RedirectResponse|JsonResponse
    {
        $request->validate([
            'conversation_uid' => 'required',
            'message' => 'required',
        ]);

        $conversation = $this->conversation->CheckIfConversationExistsByUid($request->input('conversation_uid'));

        if (!$conversation) {
            return redirect('/messages')->with('error', 'Conversation does not exist.');
        }

        $conversation_member = $this->conversation->CheckIfUserIsConversationMember($request->input('conversation_uid'), Auth::user()->id);

        if (!$conversation_member) {
            return redirect('/messages')->with('error', 'You are not a member of this conversation.');
        }

        $conversation_message = Conversation_messages::create([
            'conversation_message_uid' => $this->conversation->GenerateUid(),
            'conversation_uid' => $conversation->id,
            'user_uid' => Auth::user()->id,
            'conversation_message_content' => $request->input('message'),
            'conversation_message_type' => 'text',
            'status' => 'sent',
        ]);

        $conversation_message['author'] = [
            'name' => Auth::user()->name,
            'username' => Auth::user()->username,
            'avatar' => Auth::user()->profile_picture,
        ];

        $conversation_message['html'] = view('components.message', ['message' => $conversation_message, 'messageClass' => 'conversations-right-body-message-me'])->render();

        event(new MessagePosted($conversation_message));

        return response()->json($conversation_message);
    }
}
