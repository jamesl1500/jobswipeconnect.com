<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation_members extends Model
{
    use HasFactory;

    // Define fillable fields
    protected $fillable = [
        'conversation_member_uid', 
        'conversation_uid', 
        'type',
        'user_uid', 
        'user_role'
    ];

    /**
     * Get the conversation that belong to the member.
     */
    public function conversation()
    {
        return $this->belongsTo(Conversations::class, 'conversation_uid');
    }

    /**
     * Get the user that belong to the member.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_uid');
    }
}
