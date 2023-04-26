<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Http\Services\StudentService;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as RequestData;

class StudentController extends Controller
{

    private $service;

    public function __construct(StudentService $_service)
    {
        $this->service = $_service;
    }

    public function index()
    {
        return Inertia::render('Students/Index', [
            'students' => $this->service->students(Request::input('search')),
            'filters' => Request::only(['search'])
        ]);
    }
}
