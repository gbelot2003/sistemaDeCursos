<?php

namespace App\Http\Services;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoService
{
    private $cursoModel;

    public function __construct(Curso $_curso)
    {
        $this->cursoModel = $_curso;
    }

    public function Cursos($request)
    {
        $cursos = $this->cursoModel::query()
            ->withCount('students')
            ->when($request, function ($query, $search){
                $query->where('nombre', 'LIKE', "%{$search}%");
            })
            ->orderBy('id', 'DESC')
            ->paginate(10)

            ->withQueryString();

        return $cursos;
    }

    public function Curso($request)
    {
        $curso = $this->cursoModel::findOrFail($request);
        return $curso;
    }

    public function CursoShow($request)
    {
        $curso = $this->cursoModel::where('id', $request)->with('students')->first();
        return $curso;
    }

    public function CursoCreate(Request $request)
    {
        $curso = $this->cursoModel::create($request->all());
        return $curso;
    }

    public function CursoUpdate($id, Request $request)
    {
        $curso = $this->cursoModel::findOrFail($id);
        $curso->update($request->all());
        return $curso;
    }

    public function cursoDelete($id)
    {
        Curso::where('id', '=', $id)->delete();
    }

}
