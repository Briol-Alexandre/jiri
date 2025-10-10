<?php

use App\Models\Project;

use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

beforeEach(function (){
    $user = User::factory()->create();

    actingAs($user);
});
it('creates a project and redirects to the projects index',
    function () {
        $project = Project::factory()->make()->toArray();

        $response = $this->post('/projects', $project);

        $response->assertStatus(302);
        $response->assertRedirect('/projects');
        assertDatabaseHas('projects', $project);
    }
);

it('shows all the projects in the projects index', function () {
    $projects = Project::factory()->count(10)->create();

    $response = $this->get('/projects');

    foreach ($projects as $project) {
        $response->assertSee($project->name);
    }
});

it('can update a project', function () {
    $project = Project::factory()->create();

    $this->patch('/projects/'.$project->id, ['name' => 'Projet Web']);

    assertDatabaseHas('projects', ['name' => 'Projet Web']);
});

it('shows a specific', function () {
    $project = Project::factory()->create();

    $response = $this->get('/projects/'.$project->id);

    $response->assertSee($project->name);
});

it('deletes a project', function () {
    $project = Project::factory()->create();

    $this->delete('/projects/'.$project->id);

    assertDatabaseMissing('projects', ['name' => $project->name]);
});

it('checks if fields are valid', function () {
    $project = [
        'name' => '',
        'description' => '',
    ];

    $response = $this->post('/projects', $project);

    $response->assertInvalid();
});
