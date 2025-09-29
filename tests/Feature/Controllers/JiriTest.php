<?php

use App\Enums\ContactRoles;
use App\Models\Contact;
use App\Models\Jiri;
use App\Models\Project;
use Carbon\Carbon;

use Illuminate\Database\QueryException;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseEmpty;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

it('creates a Jiri from the data provided by the request',
    function () {
        // Arrange
        $jiri = Jiri::factory()->make()->toArray();

        // Act
        $response = $this->post('/jiris', $jiri);

        // Assert
        assertDatabaseHas('jiris', $jiri);

    }
);

it('shows the jiris on the jiris index page', function () {
    // Arrange
    $jiris = Jiri::factory()->count(5)->create();

    // Act

    $response = $this->get('/jiris');

    // Assert
    foreach ($jiris as $jiri) {
        $response->assertSee($jiri->name);
    }

});

it('can update a jiri', function () {
    $jiri = Jiri::factory()->create();

    $this->patch('/jiris/' . $jiri->id, ['name' => 'toto']);

    assertDatabaseHas('jiris', ['name' => 'toto']);
});

it('shows a specific jiri', function () {
    $jiri = Jiri::factory()->create();

    $response = $this->get('/jiris/' . $jiri->id);

    $response->assertSee($jiri->name);
});

it('deletes a jiri', function () {
    $jiri = Jiri::factory()->create();

    $this->delete('/jiris/' . $jiri->id);

    assertDatabaseMissing('jiris', ['name' => $jiri->name]);
});

it('checks if field are invalid', function () {
    $jiri = [
        'name' => '',
        'date' => Carbon::now()->format('Y-m-d H:i:s'),
    ];

    $response = $this->post('/jiris', $jiri);

    $response->assertInvalid();
});

it('fails to create a new jiri in database when the name is missing data in the request', function () {
    $jiri = Jiri::factory()
        ->withoutName()
        ->raw();

    $response = $this->post('/jiris', $jiri);

    $response->assertInvalid('name');

    assertDatabaseEmpty('jiris');
});

it('fails to create a new jiri in database when the date is missing data in the request', function () {
    $jiri = Jiri::factory()
        ->withoutDate()
        ->raw();

    $response = $this->post('/jiris', $jiri);

    $response->assertInvalid('date');

    assertDatabaseEmpty('jiris');
});

it('fails to create a new jiri in database when the date is in wrong format data in the request', function () {
    $jiri = Jiri::factory()
        ->withInvalidDate()
        ->raw();

    $response = $this->post('/jiris', $jiri);

    $response->assertInvalid('date');

    assertDatabaseEmpty('jiris');
});

it('is possible to add contact to the jiri in the jiri create form', function () {
    //Arrange
    $form_data = Jiri::factory()->raw();

    $form_data['contacts'] = Contact::factory()
        ->count(5)
        ->create()
        ->pluck('id', 'id')
        ->toArray();
    foreach ($form_data['contacts'] as $id) {
        $form_data['roles'][$id] = random_int(0, 1) ? ContactRoles::Evaluators->value : ContactRoles::Evaluated->value;
    }

    //Act
    $this->post(route('jiris.store'), $form_data);

    //Assert
    assertDatabaseCount('attendances', 5);
});

it('is possible to add project to the jiri in the jiri create form', function () {
    $form_data = Jiri::factory()->raw();
    $form_data['projects'] = Project::factory()
        ->count(5)
        ->create()
        ->pluck('id', 'id')
        ->toArray()
    ;

    $this->post('/jiris', $form_data);

    assertDatabaseCount('assignments', 5);
});

it('is possible to add projects and contacts to the jiri in the jiri create form', function () {
    $form_data = Jiri::factory()->raw();
    $form_data['projects'] = Project::factory()
        ->count(5)
        ->create()
        ->pluck('id', 'id')
        ->toArray()
    ;
    $form_data['contacts'] = Contact::factory()
        ->count(5)
        ->create()
        ->pluck('id', 'id')
        ->toArray();
    foreach ($form_data['contacts'] as $id) {
        $form_data['roles'][$id] = random_int(0, 1) ? ContactRoles::Evaluators->value : ContactRoles::Evaluated->value;
    }

    $this->post('/jiris', $form_data);

    assertDatabaseCount('assignments', 5);
    assertDatabaseCount('attendances', 5);
});

it('creates the correct implementations with the project and contact linked to the created jiri', function () {
    $form_data = Jiri::factory()->raw();
    $form_data['projects'] = Project::factory()
        ->count(5)
        ->create()
        ->pluck('id', 'id')
        ->toArray()
    ;
    $form_data['contacts'] = Contact::factory()
        ->count(5)
        ->create()
        ->pluck('id', 'id')
        ->toArray();
    foreach ($form_data['contacts'] as $id) {
        $form_data['roles'][$id] = random_int(0, 1) ? ContactRoles::Evaluators->value : ContactRoles::Evaluated->value;
    }

    $evaluatedCount = collect($form_data['roles'])
        ->filter(fn($role) => $role === ContactRoles::Evaluated->value)
        ->count();

    $count = $evaluatedCount * count($form_data['projects']);


    $this->post('/jiris', $form_data);

    assertDatabaseCount('implementations', $count);
});
