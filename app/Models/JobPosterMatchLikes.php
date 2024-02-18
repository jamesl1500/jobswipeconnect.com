<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosterMatchLikes extends Model
{
    use HasFactory;

    protected $fillable = [
        "job_id",
        "job_poster_id",
        "job_seeker_id",
        "type",
    ];
}
