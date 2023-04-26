<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use App\Http\Services\CursoService;
use App\Models\Curso;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CursosServiceTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function curso_function_return_an_object(): void
    {
        /** Comprobamos que el servicio esta conectado con
         *  el modelo de curso y que este es llamado
         *  por el metodo "Cursos" a travez de una request.
         */
        $curso = new Curso();
        $request = "";

        $service = new CursoService($curso);
        $service->Cursos($request);

        $this->assertIsObject($service);
    }

    /** @test */
    public function curso_function_get_curso_return_results(): void
    {
        $curso = new Curso();
        $testcurso = $curso::factory()->create();

        $service = new CursoService($curso);
        $checkCurso = $service->Curso($testcurso->id);

        $this->assertEquals($checkCurso->name, $testcurso->name);
        $this->assertIsObject($service);
    }
}
