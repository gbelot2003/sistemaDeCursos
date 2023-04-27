<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Student;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    protected $userTested = [];
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->userTested = $this->validFields();
        $this->user = User::factory()->create();

    }

    protected function validFields($override = [])
    {
        return array_merge([
            'nombre' => 'Arturo Antonio',
            'apellido' => 'mejia Soriano',
            'edad' => 14,
            'email' => 'mejia@test.com'
        ], $override);
    }

    /** @test */
    public function a_guest_user_can_not_see_students_index(): void
    {
        $response = $this->get('/estudiantes');

        $response->assertStatus(302)->assertRedirect();
    }

    /** @test */
    function a_user_registered_can_get_students_index(): void
    {

        $response = $this->actingAs($this->user)->get('/estudiantes');

        $response->assertStatus(200);
    }

    /** @test */
    public function a_guest_user_can_not_see_student_edit(): void
    {
        $student = Student::factory()->create();

        $response = $this->get("estudiantes/{$student->id}/edit");

        $response->assertStatus(302)->assertRedirect();
    }

    /** @test */
    function a_user_registered_can_get_student_edit(): void
    {
        $student = Student::factory()->create();

        $response = $this->actingAs($this->user)->get("estudiantes/{$student->id}/edit");

        $response->assertStatus(200);
    }

    /** @test */
    public function a_guest_user_can_not_see_student_create(): void
    {
        $response = $this->get("estudiantes/create");

        $response->assertStatus(302)->assertRedirect();
    }

    /** @test */
    function a_user_registered_can_get_student_create(): void
    {

        $response = $this->actingAs($this->user)->get("estudiantes/create");

        $response->assertStatus(200);
    }

    /** @test */
    public function can_store_new_students(): void
    {

        $postUser = $this->validFields(['cursos' => [1, 2]]);

        $this->actingAs($this->user)->post(
            "estudiantes",
            $postUser,
            ['Accept' => 'application/json']
        )
            ->assertSessionHasNoErrors()
            ->assertStatus(302)->assertRedirect();

        $this->assertDatabaseHas('students', $this->validFields());
    }

    /** @test */
    public function endpoint_fail_on_name_validation_error()
    {

        $errorRequest = $this->validFields(['nombre' => '']);

        $this->actingAs($this->user)->post(
            "estudiantes",
            $errorRequest,
            ['Accept' => 'application/json']
        )
            ->assertStatus(422);
    }

    /** @test */
    public function endpoint_fail_on_lastname_validation_error()
    {

        $errorRequest = $this->validFields(['apellido' => '']);

        $this->actingAs($this->user)->post(
            "estudiantes",
            $errorRequest,
            ['Accept' => 'application/json']
        )
            ->assertStatus(422);
    }

    /** @test */
    public function endpoint_fail_on_age_validation_error()
    {

        $errorRequest = $this->validFields(['edad' => '']);

        $this->actingAs($this->user)->post(
            "estudiantes",
            $errorRequest,
            ['Accept' => 'application/json']
        )
            ->assertStatus(422);
    }

    /** @test */
    public function endpoint_fail_on_email_validation_error()
    {

        $errorRequest = $this->validFields(['email' => '']);

        $this->actingAs($this->user)->post(
            "estudiantes",
            $errorRequest,
            ['Accept' => 'application/json']
        )
            ->assertStatus(422);
    }

    /** @test */
    public function endpoint_fail_on_email_not_email_validation_error()
    {

        $errorRequest = $this->validFields(['email' => 'cualquiercosa']);

        $this->actingAs($this->user)->post(
            "estudiantes",
            $errorRequest,
            ['Accept' => 'application/json']
        )
            ->assertStatus(422);
    }

    /** @test */
    public function update_student_information()
    {
        $student = Student::factory()->create();

        $changes = [
            'nombre' => 'nuevo nombre',
            'apellido' => 'nuevo apellido',
            'edad' => 55,
            'email' => 'nuevo@apellido.com'
        ];

        $request = $this->actingAs($this->user)->post(
            "estudiantes/{$student->id}", $changes,
            ['Accept' => 'application/json']
        );

        $changedName = Student::findOrFail($student->id);

        $request
        ->assertStatus(302)
        ->assertRedirect();

        $this->assertEquals($changedName->nombre, 'nuevo nombre');
        $this->assertEquals($changedName->apellido, 'nuevo apellido');
        $this->assertEquals($changedName->edad, 55);
        $this->assertEquals($changedName->email, 'nuevo@apellido.com');
    }
}
