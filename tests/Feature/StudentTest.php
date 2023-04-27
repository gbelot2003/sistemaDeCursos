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

    public function setUp(): void
    {
        parent::setUp();

        $this->userTested = $this->validFields();
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
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/estudiantes');

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
        $user = User::factory()->create();
        $student = Student::factory()->create();

        $response = $this->actingAs($user)->get("estudiantes/{$student->id}/edit");

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
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get("estudiantes/create");

        $response->assertStatus(200);
    }

    /** @test */
    public function can_store_new_students(): void
    {
        $user = User::factory()->create();

        $postUser = $this->validFields(['cursos' => [1, 2]]);

        $this->actingAs($user)->post(
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
        $user = User::factory()->create();

        $errorRequest = $this->validFields(['nombre' => '']);

        $this->actingAs($user)->post(
            "estudiantes",
            $errorRequest,
            ['Accept' => 'application/json']
        )
            ->assertStatus(422);
    }

    /** @test */
    public function endpoint_fail_on_lastname_validation_error()
    {
        $user = User::factory()->create();

        $errorRequest = $this->validFields(['apellido' => '']);

        $this->actingAs($user)->post(
            "estudiantes",
            $errorRequest,
            ['Accept' => 'application/json']
        )
            ->assertStatus(422);
    }

    /** @test */
    public function endpoint_fail_on_age_validation_error()
    {
        $user = User::factory()->create();

        $errorRequest = $this->validFields(['edad' => '']);

        $this->actingAs($user)->post(
            "estudiantes",
            $errorRequest,
            ['Accept' => 'application/json']
        )
            ->assertStatus(422);
    }

    /** @test */
    public function endpoint_fail_on_email_validation_error()
    {
        $user = User::factory()->create();

        $errorRequest = $this->validFields(['email' => '']);

        $this->actingAs($user)->post(
            "estudiantes",
            $errorRequest,
            ['Accept' => 'application/json']
        )
            ->assertStatus(422);
    }

    /** @test */
    public function endpoint_fail_on_email_not_email_validation_error()
    {
        $user = User::factory()->create();

        $errorRequest = $this->validFields(['email' => 'cualquiercosa']);

        $this->actingAs($user)->post(
            "estudiantes",
            $errorRequest,
            ['Accept' => 'application/json']
        )
            ->assertStatus(422);
    }
}
