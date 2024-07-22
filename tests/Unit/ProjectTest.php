<?php

namespace Tests\Unit;

use App\Models\Project;
use Tests\TestCase;



class ProjectTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_it_has_a_path(): void
    {

        $project = Project::factory()->create();

        $path = $project->path();

        $this->assertEquals("/projects/{$project->id}", $path);
    }
}
