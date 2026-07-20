<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $user_id
 * @property int $company_id
 * @property string $title
 * @property string $location
 * @property string $salary
 * @property string $description
 * @property string $skills
 * @property string $requirements
 * @property string $responsibilities
 * @property string $benefits
 * @property string $employment_location_type
 * @property string $status
 * @property string $experience_level
 * @property string $education_level
 * @property string $job_category
 * @property string $job_shift
 * @property string $job_status
 * @property string $job_salary_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\JobApplicants> $applicants
 * @property-read int|null $applicants_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jobs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jobs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jobs query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jobs whereBenefits($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jobs whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jobs whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jobs whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jobs whereEducationLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jobs whereEmploymentLocationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jobs whereExperienceLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jobs whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jobs whereJobCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jobs whereJobSalaryType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jobs whereJobShift($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jobs whereJobStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jobs whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jobs whereRequirements($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jobs whereResponsibilities($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jobs whereSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jobs whereSkills($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jobs whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jobs whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jobs whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jobs whereUserId($value)
 * @mixin \Eloquent
 */
class Jobs extends Model
{
    use HasFactory;

    public $fillable = [
        'title',
        'description',
        'job_category',
        'job_status',
        'location',
        'employment_location_type',
        'user_id',
        'company_id',
        'benefits',
        'salary',
        'job_salary_type',
        'responsibilities',
        'requirements',
        'experience_level',
        'education_level',
        'skills',
    ];

    public function applicants(): HasMany
    {
        return $this->hasMany(JobApplicants::class, 'job_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Companies::class, 'company_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function seekerMatchLikes(): HasMany
    {
        return $this->hasMany(JobSeekerMatchLikes::class, 'job_id');
    }
}
