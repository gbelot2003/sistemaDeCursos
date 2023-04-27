<?php

namespace App\Http\Services;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentService
{
    private $studentModel;

    public function __construct(Student $_student)
    {
        $this->studentModel = $_student;
    }

    public function students($request)
    {
        $student = $this->studentModel::query()
            ->when($request, function ($query, $search) {
                $query->where('nombre', 'LIKE', "%{$search}%");
                $query->orWhere('apellido', 'LIKE', "%{$search}%");
                $query->orWhere('email', 'LIKE', "%{$search}%");
            })
            ->orderBy('id', 'DESC')
            ->paginate(10)
            ->withQueryString();

        return $student;
    }

    public function student($request)
    {
        $student = $this->studentModel::where('id', '=', $request)->with('cursos', function ($q) {
            $q->select('cursos.id as value', 'cursos.nombre as id', 'cursos.nombre');
        })->first();
        return $student;
    }

    public function studentCreate(Request $request)
    {
        $student = $this->studentModel::create($request->all());

        if ($request->has('cursos')) {
            $getcursos = $request->input('cursos');
            $cursosId = array_column($getcursos, 'value');
            $student->cursos()->sync($cursosId);
        }

        return $student;
    }

    public function studentUpdate($id, Request $request)
    {
        $student = $this->studentModel::findOrFail($id);
        $student->update($request->all());
        //dd($request->all());
        if ($request->has('cursos') && !empty($request->has('cursos'))) {
            $getcursos = $request->input('cursos');
            $cursosId = array_column($getcursos, 'value');
            $student->cursos()->sync($cursosId);
        }

        return $student;
    }

    public function studentDelete($id)
    {
        Student::where('id', '=', $id)->delete();
    }

}
