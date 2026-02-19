<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AlumniResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,

            // ===============================
            // PERSONAL INFORMATION
            // ===============================
            'student_number' => $this->student_number,
            'first_name' => $this->first_name,
            'middle_initial' => $this->middle_initial,
            'last_name' => $this->last_name,
            'contact_number' => $this->contact_number,
            'sex' => $this->sex,
            'email' => $this->email,
            'address' => $this->address,

            // ===============================
            // ACADEMIC INFORMATION
            // ===============================
            'program_taken' => $this->program_taken,
            'year_batch_graduated' => $this->year_batch_graduated,
            'further_studies' => $this->further_studies,

            // ===============================
            // EMPLOYMENT INFORMATION
            // ===============================
            'employment_status' => $this->employment_status,
            'employment_sector' => $this->employment_sector,
            'employment_classification' => $this->employment_classification,
            'company_name' => $this->company_name,
            'work_location' => $this->work_location,

            // NEW (EMPLOYMENT DETAILS)
            'position_nature_of_work' => $this->position_nature_of_work,
            'job_aligned_with_course' => $this->job_aligned_with_course,

            // ===============================
            // FEEDBACK
            // ===============================
            'overall_rating' => (int) $this->overall_rating,

            'created_at' => $this->created_at?->toISOString(),
        ];
    }
}
