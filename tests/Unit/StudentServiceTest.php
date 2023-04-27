<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use App\Http\Services\StudentService;
use Tests\TestCase;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentServiceTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function student_function_return_an_object(): void
    {

        /** Comprobamos que el servicio esta conectado con
         *  el modelo de Estudiente y que este es llamado
         *  por el metodo "Estudientes" a travez de una request.
         */
        $student = new Student();
        $request = "";

        $service = new StudentService($student);
        $service->Students($request);

        $this->assertIsObject($service);
    }

    /** @test */
    public function student_function_get_student_return_results(): void
    {

        /**
         * Comprobamos que un estudiante existente se puede
         * localizar atravez de findOrFail en el servicio
         */
        $student = new Student();
        $testStudent = $student::factory()->create();

        $service = new StudentService($student);
        $checkStudent = $service->student($testStudent->id);

        $this->assertEquals($checkStudent->name, $testStudent->name);
        $this->assertIsObject($service);
    }

    /** @test */
    public function student_create_store_results(): void
    {
        // Instanciamos el modelo de estudiante
        $student = new Student();

        // Creamos manualemente un request
        // de tipo POST
        $request = new Request();
        $request->setMethod('POST');

        // Generamos los datos de un estudiante
        $studentModel = $student::factory()->make();

        // Configuramos el request
        $request->request->add([
            'nombre' => $studentModel->nombre,
            'apellido' => $studentModel->apellido,
            'edad' => $studentModel->edad,
            'email' => $studentModel->email
        ]);

        // Probamos que los datos son almacenados
        /// y replicados por el servicio
        $service = new StudentService($student);
        $test = $service->studentCreate($request);

        $this->assertEquals($test->nombre, $studentModel->nombre);
        $this->assertEquals($test->apellido, $studentModel->apellido);
        $this->assertIsObject($service);
    }

        /** @test */
        public function student_update_changes_data(): void
        {
             // Instanciamos el modelo de estudiante
            $student = new Student();

            // Creamos un estudiante en base de datos
            $test = $student::factory()->create();

            $request = new Request();
            $request->setMethod('PUT');

            // Configuramos el request
            $request->request->add([
                'nombre' => 'Alberto Matamoros',
                'apellido' => $test->apellido,
                'edad' => $test->edad,
                'email' => $test->email
            ]);

            // Instanciamos el servicio
            $service = new StudentService($student);

            // Agregamos el payload con la información
            $service->studentUpdate($test->id, $request);

            // Revisamos registro en base de datos
            $test2 = Student::findOrFail($test->id);

            // Comparamos datos
            $this->assertEquals($test2->nombre, 'Alberto Matamoros');
            $this->assertIsObject($service);
        }
}
