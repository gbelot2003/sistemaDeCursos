<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as RequestData;
use App\Http\Services\CursoService;

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
}
