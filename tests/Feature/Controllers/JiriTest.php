<?php

use App\Models\Jiri;
use Carbon\Carbon;

use Illuminate\Database\QueryException;
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

    $this->patch('/jiris/'.$jiri->id, ['name' => 'toto']);

    assertDatabaseHas('jiris', ['name' => 'toto']);
});

it('shows a specific jiri', function () {
    $jiri = Jiri::factory()->create();

    $response = $this->get('/jiris/'.$jiri->id);

    $response->assertSee($jiri->name);
});

it('deletes a jiri', function () {
    $jiri = Jiri::factory()->create();

    $this->delete('/jiris/'.$jiri->id);

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

