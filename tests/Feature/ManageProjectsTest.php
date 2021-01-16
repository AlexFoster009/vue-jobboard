<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class ManageProjectsTest extends TestCase
{

    use WithFaker, RefreshDatabase;


    /** @test */
    public function guests_cannot_create_projects()
    {
        $project = Project::factory()->create();
        $this->post('/projects', $project->toArray())->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->get('/projects')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
    }


    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->actingAs(User::factory()->create());

        $this->get('/projects/create')->assertStatus(200);

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

    /** @test */

    public function an_authenticated_user_cannot_vew_the_projects_of_others()
    {
        $this->be(User::factory()->create());

        $project = Project::factory()->create();
        $this->get($project->path())->assertStatus(403);
    }
}
