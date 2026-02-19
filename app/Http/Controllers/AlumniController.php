<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlumniRequest;
use App\Http\Resources\AlumniResource;
use App\Services\AlumniService;
use Inertia\Inertia;

class AlumniController extends Controller
{
    public function __construct(
        protected AlumniService $service
    ) {}

    public function create()
    {
        return Inertia::render('Alumni/Form');
    }

    public function store(AlumniRequest $request)
    {
        $alumni = $this->service->store($request->validated());

        return redirect()
            ->route('alumni.create')
            ->with('success', 'Submitted successfully!')
            ->with('alumni', (new AlumniResource($alumni))->resolve());
    }
}
