<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Curso;
use App\Models\Student;
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

    public function create()
    {
        return Inertia::render('Students/Create', [
            'cursos' => Curso::all()->pluck('nombre', 'id')
        ]);
    }

    public function store(RequestData $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'edad' => 'required',
            'email' => 'required|email'
        ]);

        $this->service->studentCreate($request);

        return to_route('students.index');
    }

    public function edit(Student $student)
    {
        return Inertia::render('Students/Edit', [
            'student' => $this->service->student($student->id),
            'cursos' => Curso::all()->pluck('nombre', 'id')
        ]);
    }

    public function update(Student $student, RequestData $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'edad' => 'required|max:2',
            'email' => ['required', 'email', 'unique:students,email,' . $student->id],
        ]);

        $this->service->studentUpdate($student->id, $request);

        return to_route('students.index');
    }

    public function delete($id)
    {
        $this->service->studentDelete($id);
        return to_route('students.index');
    }
}
