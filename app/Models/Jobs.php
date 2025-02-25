<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'salary_type',
        'responsibilities',
        'requirements',
        'experience_level',
        'education_level',
        'skills',

    ];

    // Applicants
    public function applicants()
    {
        return $this->hasMany(JobApplicants::class, 'job_id');
    }
    
}
