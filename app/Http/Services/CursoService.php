<?php

namespace App\Http\Services;

use App\Models\Curso;

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
            ->when($request, function ($query, $search){
                $query->where('name', 'LIKE', "%{$search}%");
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
}
