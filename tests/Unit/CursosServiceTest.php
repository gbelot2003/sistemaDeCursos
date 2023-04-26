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
    public function curso_create_store_results(): void
    {
        // Instanciamos el modelo de curso
        $curso = new Curso();

        // Creamos manualemente un request
        // de tipo POST
        $request = new Request();
        $request->setMethod('POST');

        // Generamos los datos de un curso
        $cursoModelo = $curso::factory()->make();

        // Configuramos el request
        $request->request->add([
            'nombre' => $cursoModelo->nombre,
            'horario' => $cursoModelo->horario,
            'inicio' => $cursoModelo->inicio,
            'final' => $cursoModelo->final
        ]);

        // Probamos que los datos son almacenados
        /// y replicados por el servicio
        $service = new CursoService($curso);
        $test = $service->CursoCreate($request);

        $this->assertEquals($test->name, $cursoModelo->name);
    }

    /** @test */
    public function curso_update_changes_data(): void
    {
         // Instanciamos el modelo de curso
        $curso = new Curso();

        // Creamos un curso en base de datos
        $test = $curso::factory()->create();

        $request = new Request();
        $request->setMethod('PUT');

        // Configuramos el request
        $request->request->add([
            'nombre' => 'Alberto Matamoros',
            'horario' => $test->horario,
            'inicio' => $test->inicio,
            'final' => $test->final
        ]);

        // Instanciamos el servicio
        $service = new CursoService($curso);

        // Agregamos el payload con la información
        $service->CursoUpdate($test->id, $request);

        // Revisamos registro en base de datos
        $test2 = Curso::findOrFail($test->id);

        // Comparamos datos
        $this->assertEquals($test2->nombre, 'Alberto Matamoros');
        $this->assertIsObject($service);
    }
}
