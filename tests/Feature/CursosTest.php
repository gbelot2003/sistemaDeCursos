<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Curso;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CursosTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    protected $cursoTested = [];
    protected $curso;

    protected $user;


    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->cursoTested = $this->validFields();
        $this->curso = Curso::factory()->create();

    }

    protected function validFields($override = [])
    {
        $cursoFiller = Curso::factory()->make();

        return array_merge([
            'nombre' => $cursoFiller->nombre,
            'horario' => $cursoFiller->horario,
            'inicio' => $cursoFiller->inicio,
            'final' => $cursoFiller->final
        ], $override);
    }

    /** @test */
    public function a_guest_user_can_not_see_cursos_index(): void
    {
        $response = $this->get('/cursos');

        $response->assertStatus(302)->assertRedirect();
    }

    /** @test */
    function a_user_registered_can_get_cursos_index(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/cursos');

        $response->assertStatus(200);
    }

    /** @test */
    public function a_guest_user_can_not_see_cursos_edit(): void
    {
        $curso = Curso::factory()->create();

        $response = $this->get("cursos/{$curso->id}/edit");

        $response->assertStatus(302)->assertRedirect();
    }

    /** @test */
    function a_user_registered_can_get_cursos_edit(): void
    {
        $user = User::factory()->create();
        $curso = Curso::factory()->create();

        $response = $this->actingAs($user)->get("cursos/{$curso->id}/edit");

        $response->assertStatus(200);
    }

    /** @test */
    public function a_guest_user_can_not_see_cursos_create(): void
    {
        $response = $this->get("cursos/create");

        $response->assertStatus(302)->assertRedirect();
    }

    /** @test */
    function a_user_registered_can_get_cursos_create(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get("cursos/create");

        $response->assertStatus(200);
    }

    /** @test */
    public function can_store_new_curso(): void
    {
        $this->actingAs($this->user)->post(
            "cursos",
            $this->validFields(),
            ['Accept' => 'application/json']
        )
            ->assertSessionHasNoErrors()
            ->assertStatus(302)->assertRedirect();
    }

    /** @test */
    public function endpoint_fail_on_nombre_validation_error()
    {

        $errorRequest = $this->validFields(['nombre' => '']);

        $this->actingAs($this->user)->post(
            "cursos",
            $errorRequest,
            ['Accept' => 'application/json']
        )
            ->assertStatus(422);
    }

    /** @test */
    public function endpoint_fail_on_horario_validation_error()
    {

        $errorRequest = $this->validFields(['horario' => '']);

        $this->actingAs($this->user)->post(
            "cursos",
            $errorRequest,
            ['Accept' => 'application/json']
        )
            ->assertStatus(422);
    }

    /** @test */
    public function endpoint_fail_on_inicio_validation_error()
    {

        $errorRequest = $this->validFields(['inicio' => '']);

        $this->actingAs($this->user)->post(
            "cursos",
            $errorRequest,
            ['Accept' => 'application/json']
        )
            ->assertStatus(422);
    }

    /** @test */
    public function endpoint_fail_on_final_validation_error()
    {

        $errorRequest = $this->validFields(['final' => '']);

        $this->actingAs($this->user)->post(
            "cursos",
            $errorRequest,
            ['Accept' => 'application/json']
        )
            ->assertStatus(422);
    }

    /** @test */
    public function update_student_information()
    {
        $curso = Curso::factory()->create();
        $cursoUpdate = Curso::factory()->make();
        $changes = [
            'nombre' => $cursoUpdate->nombre,
            'horario' => $cursoUpdate->horario,
            'inicio' => $cursoUpdate->inicio,
            'final' => $cursoUpdate->final,
        ];

        $request = $this->actingAs($this->user)->post(
            "cursos/{$curso->id}",
            $changes,
            ['Accept' => 'application/json']
        );

        $changedName = Curso::findOrFail($curso->id);

        $request
            ->assertStatus(302)
            ->assertRedirect();

        $this->assertEquals($changedName->nombre, $cursoUpdate->nombre);
        $this->assertEquals($changedName->horario, $cursoUpdate->horario);
        $this->assertEquals($changedName->inicio, $cursoUpdate->inicio);
        $this->assertEquals($changedName->final, $cursoUpdate->final);
    }


}
