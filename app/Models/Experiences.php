<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $company
 * @property string $start_date
 * @property string|null $end_date
 * @property string|null $description
 * @property int $is_current_job
 * @property string $employment_type
 * @property int $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Experiences newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Experiences newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Experiences query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Experiences whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Experiences whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Experiences whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Experiences whereEmploymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Experiences whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Experiences whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Experiences whereIsCurrentJob($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Experiences wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Experiences whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Experiences whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Experiences whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Experiences whereUserId($value)
 * @mixin \Eloquent
 */
class Experiences extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'company',
        'start_date',
        'end_date',
        'description',
        'is_current_job',
        'employment_type',
        'position',
    ];
}
