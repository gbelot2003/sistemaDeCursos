<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use App\Http\Services\CursoService;
use App\Models\Curso;
use Illuminate\Http\Request;
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

        /**
         * Comprobamos que un curso existente se puede
         * localizar atravez de findOrFail en el servicio
         */
        $curso = new Curso();
        $testcurso = $curso::factory()->create();

        $service = new CursoService($curso);
        $checkCurso = $service->Curso($testcurso->id);

        $this->assertEquals($checkCurso->name, $testcurso->name);
        $this->assertIsObject($service);
    }

    /** @test */
    public function curso_create_function_store_results(): void
    {
        $curso = new Curso();
        $request = new Request();
        $request->setMethod('POST');
        $cursoModelo = $curso::factory()->make();

        $request->request->add([
            'nombre' => $cursoModelo->nombre,
            'horario' => $cursoModelo->horario,
            'inicio' => $cursoModelo->inicio,
            'final' => $cursoModelo->final
        ]);

        $service = new CursoService($curso);
        $test = $service->CursoCreate($request);

        $this->assertEquals($test->name, $cursoModelo->name);

    }
}
