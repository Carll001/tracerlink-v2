<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AlumniRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // kung may route model binding sa update:
        // Route::put('/alumni/{alumni}', ...)
        $alumniId = $this->route('alumni')?->id;

        return [

            // ===============================
            // PERSONAL INFORMATION
            // ===============================

            'student_number' => [
                'required',
                'string',
                'max:50',
                // optional unique (safe for update)
                Rule::unique('alumni', 'student_number')->ignore($alumniId),
            ],

            'first_name' => ['required', 'string', 'max:100'],
            'middle_initial' => ['nullable', 'string', 'max:5'],
            'last_name' => ['required', 'string', 'max:100'],

            'contact_number' => [
                'required',
                'string',
                'max:30',
            ],

            'sex' => [
                'required',
                'in:Male,Female,Prefer not to say',
            ],

            'email' => [
                'required',
                'email',
                'max:150',
                Rule::unique('alumni', 'email')->ignore($alumniId),
            ],

            'address' => ['required', 'string', 'max:5000'],

            // ===============================
            // ACADEMIC INFORMATION
            // ===============================

            'program_taken' => ['required', 'string', 'max:150'],
            'year_batch_graduated' => ['required', 'string', 'max:50'],

            'further_studies' => [
                'required',
                'in:Yes,No,No Answer',
            ],

            // ===============================
            // EMPLOYMENT INFORMATION
            // ===============================

            'employment_status' => [
                'required',
                'in:Employed,Unemployed,No Answer'
            ],

            'employment_sector' => [
                'nullable',
                'in:Government,Private,Self Employment',
            ],

            'employment_classification' => [
                'nullable',
                'in:Local Company PH,Foreign Company in PH,Foreign Company in Abroad,I am Self Employed',
            ],

            'company_name' => ['nullable', 'string', 'max:150'],
            'work_location' => ['nullable', 'string', 'max:150'],

            // NEW (EMPLOYMENT DETAILS)
            'position_nature_of_work' => ['nullable', 'string', 'max:150'],
            'job_aligned_with_course' => [
                'nullable',
                'in:Yes,No,No Answer',
            ],

            // ===============================
            // FEEDBACK
            // ===============================

            'overall_rating' => ['required', 'integer', 'between:1,5'],
        ];
    }

    public function messages(): array
    {
        return [
            'overall_rating.between' => 'Rating must be between 1 and 5.',
            'employment_status.in' => 'Invalid employment status selected.',
            'employment_sector.in' => 'Invalid employment sector selected.',
            'employment_classification.in' => 'Invalid employment classification selected.',
            'sex.in' => 'Invalid sex selected.',
            'further_studies.in' => 'Invalid further studies option selected.',
            'job_aligned_with_course.in' => 'Invalid option selected for job alignment.',
        ];
    }
}
