<?php

use App\Enums\ContactRoles;
use App\Models\Contact;
use App\Models\Jiri;
use App\Models\Project;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

beforeEach(function (){
    $user = User::factory()->create();

    actingAs($user);
});
it('is possible to retrieve many evaluated and many evaluators from a jiri', function () {
    $jiri = Jiri::factory()
        ->hasAttached(
            Contact::factory()->count(3),
            ['role' => ContactRoles::Evaluated->value]

        )
        ->hasAttached(
            Contact::factory()->count(7),
            ['role' => ContactRoles::Evaluators->value]
        )
        ->create();

    $this->assertDatabaseCount('attendances', 10);
    expect($jiri->evaluators->count())->toBe(7)
        ->and($jiri->evaluated->count())->toBe(3)
        ->and($jiri->contacts->count())->toBe(10)
        ->and($jiri->attendances->count())->toBe(10);
});

it('ìs possible to retrieve many homework from a jiri', function () {
    $jiri = Jiri::factory()
        ->hasAttached(
            Project::factory()->count(2)
        )
        ->create();

    $this->assertDatabaseCount('assignments', 2);
    expect($jiri->projects->count())->toBe(2)
        ->and($jiri->assignments()->count())->toBe(2);
});
