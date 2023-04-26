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
            ->when($request, function ($query, $search){
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
        $student = $this->studentModel::findOrFail($request);
        return $student;
    }

    public function studentCreate(Request $request)
    {
        $student = $this->studentModel::create($request->all());
        return $student;
    }

    public function studentUpdate($id, Request $request)
    {
        $student = $this->studentModel::findOrFail($id);
        $student->update($request->all());
        return $student;
    }

}
