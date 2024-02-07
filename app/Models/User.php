<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'onboarding_step_1',
        'onboarding_step_2',
        'phone',
        'profile_picture',
        'address',
        'city',
        'state',
        'zip',
        'country',
        'resume',
        'cover_letter',
        'skills',
        'linkedin',
        'github',
        'portfolio',
        'twitter',
        'facebook',
        'instagram',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the user's role.
     *
     * @return string
     */
    public function getRoleAttribute()
    {
        return $this->attributes['role'];
    }

    /** 
     * Check to see if user has completed onboarding step 1
     */
    public function hasCompletedOnboardingStep1()
    {
        return $this->onboarding_step_1;
    }

    /** 
     * Check to see if user has completed onboarding step 2
     */
    public function hasCompletedOnboardingStep2()
    {
        return $this->onboarding_step_2;
    }

    /**
     * Get users privacy settings
     */
    public function privacySettings()
    {
        return $this->hasOne(PrivacySettings::class);
    }

    /**
     * Get users experience
     */
    public function experiences()
    {
        // Order by position
        return $this->hasMany(Experiences::class)->orderBy('position', 'asc');
    }

    /**
     * Get users education
     */
    public function educations()
    {
        // Order by position
        return $this->hasMany(Educations::class)->orderBy('position', 'asc');
    }
}
