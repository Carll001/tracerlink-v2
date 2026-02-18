<?php

namespace App\Repositories;

use App\Models\Alumni;

class AlumniRepository
{
    public function create(array $data): Alumni
    {
        return Alumni::create($data);
    }

    public function update(Alumni $alumni, array $data): Alumni
    {
        $alumni->update($data);
        return $alumni->refresh();
    }
}
