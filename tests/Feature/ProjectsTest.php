<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectsTest extends TestCase
{

    use WithFaker, RefreshDatabase;


    public function test_a_user_can_create_a_project(): void
    {

        $this->withoutExceptionHandling();

        //Given
        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->text,
            'user_id' => User::factory()->create()->id,
        ];

        //When
        $this->post('projects', $attributes)->assertRedirect('/projects');

        //Then
        $this->assertDatabaseHas('projects', $attributes);
        $this->get('/projects')->assertSee($attributes['title']);

    }

    public function test_a_use_can_view_a_project()
    {
        //Given
        $project = Project::factory()->create();

        //When
        $action = $this->get($project->path());

        //Then
        $action->assertStatus(200);
        $action->assertSee($project->title);
        $action->assertSee($project->description);

    }


    public function test_a_project_requires_a_title()
    {
        $attributes = Project::factory()->raw(['title' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    public function test_a_project_requires_a_description()
    {
        $attributes = Project::factory()->raw(['description' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

    public function test_a_project_requires_an_owner()
    {

        //$this->withoutExceptionHandling();

        $attributes = Project::factory()->raw(['owner_id' => null]);

        // Intentar crear el proyecto con los atributos y verificar los errores de validación
        $this->post('/projects', $attributes)->assertSessionHasErrors('owner_id');

        // Verificar que la sesión tenga errores de validación

    }


}
