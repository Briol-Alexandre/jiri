<?php

use App\Models\Jiri;
use App\Models\Project;
use function Pest\Laravel\assertDatabaseCount;

it('is possible to directly link a jiri to the project in project.create', function (){
    $form_data = Project::factory()->raw();
    $form_data['jiris'] = Jiri::factory()
        ->count(4)
        ->create()
        ->pluck('id', 'id')
        ->toArray();

    $this->post(route('projects.store'), $form_data);

    assertDatabaseCount('assignments', 4);
});

it('is possible to directly link a user to ', function () {
    
});

