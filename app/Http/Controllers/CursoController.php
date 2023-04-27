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

    public function create()
    {
        return Inertia::render('Cursos/Create');
    }

    public function store(RequestData $request)
    {
        $request->validate([
            'nombre' => 'required',
            'horario' => 'required',
            'inicio' => 'required',
            'final' => 'required'
        ]);

        $this->service->CursoCreate($request);

        return to_route('cursos.index');
    }

    public function edit(Curso $curso)
    {
        return Inertia::render('Cursos/Edit', [
            'curso' => $this->service->curso($curso->id)
        ]);
    }
}
