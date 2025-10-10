<?php

use App\Enums\ContactRoles;
use App\Models\Contact;
use App\Models\Assignment;
use App\Models\Jiri;
use App\Models\Project;
use App\Models\User;
use function Pest\Laravel\actingAs;

beforeEach(function (){
    $user = User::factory()->create();

    actingAs($user);
});
it('is possible retrieve implementations from the students', function () {

    /*
     * Créer deux jiris
     * Attacher deux projets -> assignments
     * Attacher un étudiant -> attendances -> implementations
     *
     * Vérifier au minimum qu'on a 4 implémentations associées à l'étudiant
     */
    $contact = Contact::factory()->create();
    $jiris = Jiri::factory()
        ->hasAttached(
            Project::factory()
                ->count(2)
        )
        ->count(2)
        ->create()
        ->each(function ($jiri) use ($contact) {
            $jiri->contacts()->attach($contact, ['role' => ContactRoles::Evaluated->value]);
        });


    $jiris->each(function ($jiri) use ($contact){
       $jiri->assignments()->each(function ($assignment) use ($contact){
           $assignment->contacts()->attach($contact->id);
       });
    });

    $this->assertDatabaseCount('assignments', 4);
    foreach ($jiris as $jiri) {
        expect($jiri->projects->count())->toBe(2)
            ->and($jiri->assignments()->count())->toBe(2);
    }

    $this->assertDatabaseCount('attendances', 2);
    foreach ($jiris as $jiri) {
        expect($jiri->contacts->count())->toBe(1)
            ->and($jiri->attendances->count())->toBe(1);

    }

    $this->assertDatabaseCount('implementations', 4);
    foreach ($jiris as $jiri) {
        $contact = $jiri->contacts->first();
        expect($contact->assignments->count())->toBe(4)
            ->and($contact->implementations->count())->toBe(4);

    }
});
