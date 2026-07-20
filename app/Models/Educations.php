<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $school
 * @property string $degree
 * @property string $field_of_study
 * @property string $start_date
 * @property string|null $end_date
 * @property string|null $description
 * @property int $is_current_study
 * @property string $education_level
 * @property string|null $grade
 * @property int $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Educations newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Educations newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Educations query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Educations whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Educations whereDegree($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Educations whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Educations whereEducationLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Educations whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Educations whereFieldOfStudy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Educations whereGrade($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Educations whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Educations whereIsCurrentStudy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Educations wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Educations whereSchool($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Educations whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Educations whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Educations whereUserId($value)
 * @mixin \Eloquent
 */
class Educations extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'school',
        'degree',
        'field_of_study',
        'start_date',
        'end_date',
        'description',
        'is_current_study',
        'education_level',
        'grade',
        'position',
    ];
}
