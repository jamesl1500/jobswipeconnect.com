<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivacySettings extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'show_email',
        'show_phone',
        'show_location',
        'show_social_links',
        'show_resume',
        'show_skills',
        'show_education',
        'show_experience',
    ];

    /**
     * Get the user that owns the privacy settings
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
