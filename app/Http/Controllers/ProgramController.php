<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgramRequest;
use App\Http\Resources\ProgramResource;
use App\Models\Program;
use App\Services\ProgramService;
use Inertia\Inertia;

class ProgramController extends Controller
{
    /**
     * Create a new ProgramController instance.
     */
    public function __construct(private readonly ProgramService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = $this->service->getAllPrograms();

        return Inertia::render('Program/Index', [
            'programs' => ProgramResource::collection($programs)->toArray(request()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProgramRequest $request)
    {
        $this->service->createProgram($request->validated());

        return back()->with('success', 'Program created successfully!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProgramRequest $request, Program $program)
    {
        $this->service->updateProgram($program, $request->validated());

        return back()->with('success', 'Program updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        $this->service->deleteProgram($program);

        return back()->with('success', 'Program deleted successfully!');
    }
}
