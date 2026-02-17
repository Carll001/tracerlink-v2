<?php

namespace App\Services;

use App\Models\Program;
use App\Repositories\ProgramRepository;
use Illuminate\Database\Eloquent\Collection;

class ProgramService
{
    /**
     * Create a new ProgramService instance.
     */
    public function __construct(private readonly ProgramRepository $repository)
    {
    }

    /**
     * Get all programs.
     */
    public function getAllPrograms(): Collection
    {
        return $this->repository->getAll();
    }

    /**
     * Get a program by ID.
     */
    public function getProgramById(int $id): ?Program
    {
        return $this->repository->getById($id);
    }

    /**
     * Create a new program.
     */
    public function createProgram(array $data): Program
    {
        return $this->repository->create($data);
    }

    /**
     * Update an existing program.
     */
    public function updateProgram(Program $program, array $data): bool
    {
        return $this->repository->update($program, $data);
    }

    /**
     * Delete a program.
     */
    public function deleteProgram(Program $program): bool
    {
        return $this->repository->delete($program);
    }
}
