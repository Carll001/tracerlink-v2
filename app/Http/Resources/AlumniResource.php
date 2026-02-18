<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AlumniResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,

            'student_number' => $this->student_number,
            'first_name' => $this->first_name,
            'middle_initial' => $this->middle_initial,
            'last_name' => $this->last_name,
            'contact_number' => $this->contact_number,
            'email' => $this->email,
            'address' => $this->address,

            'program_taken' => $this->program_taken,
            'year_batch_graduated' => $this->year_batch_graduated,

            'employment_status' => $this->employment_status,
            'employment_sector' => $this->employment_sector,
            'company_name' => $this->company_name,
            'work_location' => $this->work_location,

            'overall_rating' => (int) $this->overall_rating,
            'created_at' => $this->created_at?->toISOString(),
        ];
    }
}
