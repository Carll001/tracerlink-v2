<?php

namespace App\Services;

use App\Models\Alumni;
use App\Repositories\AlumniRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class AlumniService
{
    public function __construct(
        protected AlumniRepository $repo
    ) {}

    public function store(array $validated): Alumni
    {
        return DB::transaction(function () use ($validated) {
            $data = $this->normalize($validated);
            return $this->repo->create($data);
        });
    }

    public function update(Alumni $alumni, array $validated): Alumni
    {
        return DB::transaction(function () use ($alumni, $validated) {
            $data = $this->normalize($validated);
            return $this->repo->update($alumni, $data);
        });
    }

    private function normalize(array $data): array
    {
        // middle initial uppercase (optional)
        if (!empty($data['middle_initial'])) {
            $data['middle_initial'] = strtoupper($data['middle_initial']);
        }

        // if not employed => null work fields
        $status = Arr::get($data, 'employment_status');

        if (in_array($status, ['Unemployed', 'No Answer'], true)) {
            $data['employment_sector'] = null;
            $data['employment_classification'] = null;
            $data['company_name'] = null;
            $data['work_location'] = null;

            // NEW
            $data['position_nature_of_work'] = null;
            $data['job_aligned_with_course'] = null;
        }

        return $data;
    }
}
