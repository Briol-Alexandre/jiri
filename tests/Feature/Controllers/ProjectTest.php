<?php

use App\Models\Jiri;
use App\Models\Project;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;

beforeEach(function (){
    $this->user = User::factory()->create();

    actingAs($this->user);
});
it('is possible to directly link a jiri to the project in project.create', function (){
    $form_data = Project::factory()->raw();
    $form_data['jiris'] = Jiri::factory()
        ->for($this->user)
        ->count(4)
        ->create()
        ->pluck('id', 'id')
        ->toArray();

    $this->post(route('projects.store'), $form_data);

    assertDatabaseCount('assignments', 4);
});

