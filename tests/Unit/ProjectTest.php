<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;
   /** @test */
    public function it_has_a_path()
    {
        $project = Project::factory()->create();

        $this->assertEquals('/projects/' . $project->id, $project->path());
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $project = Project::factory()->create();
        $this->assertInstanceOf(User::class, $project->owner);
    }
}
