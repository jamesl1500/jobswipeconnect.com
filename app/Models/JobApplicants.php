<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $job_id
 * @property int $user_id
 * @property string $status
 * @property string|null $cover_letter
 * @property string|null $resume
 * @property string|null $skills
 * @property string|null $notes
 * @property string|null $interview_date
 * @property string|null $interview_time
 * @property string|null $interview_location
 * @property string|null $interview_notes
 * @property string|null $offer_date
 * @property string|null $offer_salary
 * @property string|null $offer_notes
 * @property string|null $hired_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Jobs $job
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicants newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicants newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicants query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicants whereCoverLetter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicants whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicants whereHiredDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicants whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicants whereInterviewDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicants whereInterviewLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicants whereInterviewNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicants whereInterviewTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicants whereJobId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicants whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicants whereOfferDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicants whereOfferNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicants whereOfferSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicants whereResume($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicants whereSkills($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicants whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicants whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicants whereUserId($value)
 * @mixin \Eloquent
 */
class JobApplicants extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'user_id',
        'status',
        'cover_letter',
        'resume',
        'skills',
        'notes',
        'interview_date',
        'interview_time',
        'interview_location',
        'interview_notes',
        'offer_date',
        'offer_salary',
        'offer_notes',
        'hired_date',
    ];

    public function job(): BelongsTo
    {
        return $this->belongsTo(Jobs::class);
    }
}
