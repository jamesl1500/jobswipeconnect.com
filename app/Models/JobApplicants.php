<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplicants extends Model
{
    use HasFactory;

    protected $fillable = [
        "job_id",
        "user_id",
        "job_seeker_id",
        "status",
        "cover_letter",
        "resume",
        "skills",
        "notes",
        "interview_date",
        "interview_time",
        "interview_location",
        "interview_notes",
        "offer_date",
        "offer_salary",
        "offer_notes",
        "hired_date",
    ];
}
