<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $type
 * @property string $notifiable_type
 * @property int $notifiable_id
 * @property string $data
 * @property string|null $read_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notifications newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notifications newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notifications query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notifications whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notifications whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notifications whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notifications whereNotifiableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notifications whereNotifiableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notifications whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notifications whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notifications whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Notifications extends Model
{
    use HasFactory;
}
