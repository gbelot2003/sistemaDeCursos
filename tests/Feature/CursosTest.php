<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CursosTest extends TestCase
{

    use WithFaker, RefreshDatabase;


    /** @test */
    public function a_guest_user_can_not_see_cursos_index(): void
    {
        $response = $this->get('/cursos');

        $response->assertStatus(302)->assertRedirect();

    }

    /** @test */
    function a_user_register_can_get_cursos_index() : void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/cursos');

        $response->assertStatus(200);
    }
}
