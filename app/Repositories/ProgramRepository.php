<?php

namespace App\Repositories;

use App\Models\Program;
use Illuminate\Database\Eloquent\Collection;

class ProgramRepository
{
    /**
     * Get all programs ordered by newest first.
     */
    public function getAll(): Collection
    {
        return Program::orderBy('created_at', 'desc')->get();
    }

    /**
     * Get a program by ID.
     */
    public function getById(int $id): ?Program
    {
        return Program::find($id);
    }

    /**
     * Create a new program.
     */
    public function create(array $data): Program
    {
        return Program::create($data);
    }

    /**
     * Update a program.
     */
    public function update(Program $program, array $data): bool
    {
        return $program->update($data);
    }

    /**
     * Delete a program.
     */
    public function delete(Program $program): bool
    {
        return $program->delete();
    }
}
