<?php

use App\Models\Jiri;
use App\Models\User;
use Carbon\Carbon;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

beforeEach(function () {
    $this->user = User::factory()->create();

    actingAs($this->user);
});

it('redirects to the Jiris index after the successful creation of a jiri',
    function () {
        // Arrange
        $jiri = Jiri::factory()->raw();

        // Act
        $response = $this->post(route('jiris.store'), $jiri);

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect(route('jiris.index'));

    }
);

it('refuses a unauthenticated user to the route', function () {
    auth()->logout();

    $response = $this->get(route('jiris.index'));

    $response->assertRedirect(route('login'));
});


it('shows the jiris on the jiris index page', function () {
    // Arrange
    $jiris = Jiri::factory()
        ->for($this->user)
        ->count(5)
        ->create();

    // Act

    $response = $this->get('/jiris');

    // Assert
    foreach ($jiris as $jiri) {
        $response->assertSee($jiri->name);
    }

});

it('can update a jiri', function () {
    $jiri = Jiri::factory()->for($this->user)->create();

    $this->patch('/jiris/' . $jiri->id, ['name' => 'toto']);

    assertDatabaseHas('jiris', ['name' => 'toto']);
});

it('shows a specific jiri', function () {
    $jiri = Jiri::factory()->for($this->user)->create();

    $response = $this->get('/jiris/' . $jiri->id);

    $response->assertSee($jiri->name);
});

it('deletes a jiri', function () {
    $jiri = Jiri::factory()->for($this->user)->create();

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
