<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $table = 'alumni'; // ✅ IMPORTANT FIX

    protected $fillable = [
        'student_number',
        'first_name',
        'middle_initial',
        'last_name',
        'contact_number',
        'sex',
        'email',
        'address',

        'program_taken',
        'year_batch_graduated',
        'further_studies',

        'employment_status',
        'employment_sector',
        'employment_classification',
        'company_name',
        'work_location',

        // NEW
        'position_nature_of_work',
        'job_aligned_with_course',

        'overall_rating',
    ];
}
