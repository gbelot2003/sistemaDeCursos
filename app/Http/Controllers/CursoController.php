<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Curso;
use App\Http\Services\CursoService;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as RequestData;

class CursoController extends Controller
{

    private $service;

    public function __construct(CursoService $_service)
    {
        $this->service = $_service;
    }

    public function index()
    {
        return Inertia::render('Cursos/Index', [
            'cursos' => $this->service->Cursos(Request::input('search')),
            'filters' => Request::only(['search'])
        ]);
    }

    public function edit(Curso $curso)
    {
        return Inertia::render('Cursos/Edit', [
            'curso' => $this->service->curso($curso->id)
        ]);
    }
}
