<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $role
 * @property string|null $address
 * @property string|null $city
 * @property string|null $state
 * @property string|null $zip
 * @property string|null $country
 * @property string|null $phone
 * @property string|null $profile_picture
 * @property string|null $resume
 * @property string|null $cover_letter
 * @property string|null $skills
 * @property string|null $linkedin
 * @property string|null $github
 * @property string|null $portfolio
 * @property string|null $twitter
 * @property string|null $facebook
 * @property string|null $instagram
 * @property int $onboarding_step_1
 * @property int $onboarding_step_2
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Companies> $companies
 * @property-read int|null $companies_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Conversation_members> $conversations
 * @property-read int|null $conversations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Educations> $educations
 * @property-read int|null $educations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Experiences> $experiences
 * @property-read int|null $experiences_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Followings> $followers
 * @property-read int|null $followers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Followings> $followings
 * @property-read int|null $followings_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\JobApplicants> $jobApplicants
 * @property-read int|null $job_applicants_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Jobs> $jobs
 * @property-read int|null $jobs_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Posts> $posts
 * @property-read int|null $posts_count
 * @property-read \App\Models\PrivacySettings|null $privacySettings
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProfileViews> $profileViews
 * @property-read int|null $profile_views_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCoverLetter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereGithub($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereInstagram($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLinkedin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereOnboardingStep1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereOnboardingStep2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePortfolio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereProfilePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereResume($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereSkills($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTwitter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereZip($value)
 * @mixin \Eloquent
 */
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
     */
    public function getRoleAttribute(): string
    {
        return $this->attributes['role'];
    }

    /**
     * Check to see if user has completed onboarding step 1
     */
    public function hasCompletedOnboardingStep1(): bool
    {
        return $this->onboarding_step_1;
    }

    /**
     * Check to see if user has completed onboarding step 2
     */
    public function hasCompletedOnboardingStep2(): bool
    {
        return $this->onboarding_step_2;
    }

    /**
     * Get users privacy settings
     */
    public function privacySettings(): HasOne
    {
        return $this->hasOne(PrivacySettings::class);
    }

    /**
     * Get users experience
     */
    public function experiences(): HasMany
    {
        return $this->hasMany(Experiences::class)->orderBy('position', 'asc');
    }

    /**
     * Get users education
     */
    public function educations(): HasMany
    {
        return $this->hasMany(Educations::class)->orderBy('position', 'asc');
    }

    /**
     * Posts
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Posts::class);
    }

    /**
     * Get the followings that belong to the user.
     */
    public function followings(): HasMany
    {
        return $this->hasMany(Followings::class, 'user_id');
    }

    /**
     * Get the followers that belong to the user.
     */
    public function followers(): HasMany
    {
        return $this->hasMany(Followings::class, 'following_id');
    }

    /**
     * Get users companies
     */
    public function companies(): HasMany
    {
        return $this->hasMany(Companies::class);
    }

    /**
     * Get users profile views
     */
    public function profileViews(): HasMany
    {
        return $this->hasMany(ProfileViews::class, 'profile_id');
    }

    /**
     * Get the conversations that belong to the user.
     */
    public function conversations(): HasMany
    {
        return $this->hasMany(Conversation_members::class, 'user_uid');
    }

    /**
     * Get jobs that belong to the user
     */
    public function jobs(): HasMany
    {
        return $this->hasMany(Jobs::class);
    }

    /**
     * Get job applications that belong to the user
     */
    public function jobApplicants(): HasMany
    {
        return $this->hasMany(JobApplicants::class);
    }

    /**
     * Get the job-seeker swipe likes/dislikes made by this user
     */
    public function jobSeekerMatchLikes(): HasMany
    {
        return $this->hasMany(JobSeekerMatchLikes::class, 'job_seeker_id');
    }

    /**
     * Get the job-poster swipe likes/dislikes made by this user
     */
    public function jobPosterMatchLikes(): HasMany
    {
        return $this->hasMany(JobPosterMatchLikes::class, 'job_poster_id');
    }

    /**
     * Get the matches where this user is the job seeker
     */
    public function seekerMatches(): HasMany
    {
        return $this->hasMany(Matches::class, 'job_seeker_id');
    }

    /**
     * Get the matches where this user is the job poster
     */
    public function posterMatches(): HasMany
    {
        return $this->hasMany(Matches::class, 'job_poster_id');
    }
}
