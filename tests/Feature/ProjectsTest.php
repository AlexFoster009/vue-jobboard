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
    public function guests_cannot_view_a_project()
    {
        $attributes = Project::factory()->raw();
        $this->post('/projects', $attributes)->assertRedirect('login');
    }

    /** @test */

    public function guests_cannot_view_projects()
    {
        $this->get('/projects')->assertRedirect('login');
    }

    /** @test */

    public function guests_cannot_view_a_single_project()
    {
        $project = Project::factory()->create();
        $this->get($project->path())->assertRedirect('login');
    }

    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->actingAs(User::factory()->create());

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
        $this->actingAs(User::factory()->create());
        $attributes = Project::factory()->raw(['title' => '']);
        $this->post('/projects')->assertSessionHasErrors($attributes['title']);
    }

    /** @test */
    public function a_project_requires_a_description()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Project::factory()->raw(['description' => '']);
        $this->post('/projects')->assertSessionHasErrors($attributes['description']);
    }


    /** @test */
    public function a_user_can_view_their_project()
    {
        $this->be(User::factory()->create());
        $project = Project::factory()->create(['owner_id' => auth()->id()]);

        $this->get('/projects/'. $project->id)
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /** @test  */
    public function a_project_requires_an_owner()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Project::factory()->raw();
        $this->post('/projects', $attributes)->assertRedirect('login');
    }
}
