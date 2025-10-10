<?php

use App\Models\Jiri;
use App\Models\User;
use function Pest\Laravel\actingAs;

beforeEach(function (){
   $this->user = User::factory()->create();

   actingAs($this->user);
});

it('prevents a user to modify a jiri of another user', function (){
    $newUser = User::factory()->create();

    $jiri = Jiri::factory()->for($newUser)->create();

    $response = $this->patch(route('jiris.update', $jiri), [
        'name' => 'toto',
    ]);

    $response->assertStatus(403);
});


it('prevents a user to delete another user‘s jiri', function () {
    $newUser = User::factory()->create();

    $jiri = Jiri::factory()->for($newUser)->create();

    $response = $this->delete(route('jiris.destroy', $jiri));

    $response->assertStatus(403);
});
