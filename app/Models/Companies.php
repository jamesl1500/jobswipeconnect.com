<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'website',
        'logo',
        'address',
        'city',
        'state',
        'zip',
        'country',
        'industry',
        'description',
        'size',
        'founded',
        'type',
        'revenue',
        'ownership',
    ];

    /**
     * Get the user that owns the company
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the jobs for the company
     */
    public function jobs()
    {
        return $this->hasMany(Jobs::class);
    }
}
