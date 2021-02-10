<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_project_can_have_tasks()
    {
        $this->signIn();
        $project = Project::factory()->create(['owner_id' => auth()->id()]);

        $this->post($project->path() . '/tasks', ['body' => 'New Task']);

        // if the request was successful, the task should be added
        // to the current project.

        $this->get($project->path())
            ->assertSee('New Task');
    }
    /** @test */
    public function only_the_owner_of_a_project_can_add_tasks()
    {
        $this->signIn();
        $project = Project::factory()->create();

        $this->post($project->path() . "/tasks", ['body' => 'New Task'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'New Task']);

    }

    /** @test */

    public function a_task_requires_a_body()
    {
        $this->signIn();

        $project = auth()->user()->projects()->create(
            Task::factory()->raw()
        );

        $attributes = Task::factory()->raw(['body' => '']);

        $this->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');
    }
}
