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

    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->withExceptionHandling();

        $attributes = [
          'title' => $this->faker->sentence,
          'description' => $this->faker->paragraph,

        ];

        $this->post('/projects', $attributes)->assertRedirect('/projects');
        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    /** @test */
    public function a_project_requires_a_title()
    {
        $attributes = Project::factory()->raw(['title' => '']);
        $this->post('/projects')->assertSee($attributes['title']);
    }

    /** @test */
    public function a_project_requires_a_description()
    {
        $attributes = Project::factory()->raw(['description' => '']);
        $this->post('/projects')->assertSee($attributes['description']);
    }


    /** @test */
    public function a_user_can_view_a_project()
    {
        $project = Project::factory()->make();

        $this->get('/projects/'. $project->id)->assertSee($project->title);
    }
}
