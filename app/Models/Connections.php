<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Connections newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Connections newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Connections query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Connections whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Connections whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Connections whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Connections extends Model
{
    use HasFactory;
}
