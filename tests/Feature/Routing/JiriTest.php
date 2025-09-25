<?php

use App\Models\Jiri;
use Carbon\Carbon;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

it('redirects to the Jiris index after the successful creation of a jiri',
    function () {
        // Arrange
        $jiri = Jiri::factory()->make()->toArray();

        // Act
        $response = $this->post(route('jiris.store'), $jiri);

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect(route('jiris.index'));

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
