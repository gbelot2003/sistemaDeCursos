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
}
