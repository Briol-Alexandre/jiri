<?php

use App\Enums\ContactRoles;
use App\Models\Contact;
use App\Models\Homework;
use App\Models\Jiri;
use App\Models\Project;

it('is possible retrieve implementations from the students', function () {

    /*
     * Créer deux jiris
     * Attacher deux projets -> homeworks
     * Attacher un étudiant -> attendances -> implementations
     *
     * Vérifier au minimum qu'on a 4 implémentations associées à l'étudiant
     */

    $jiris = Jiri::factory()
        ->hasAttached(
            Project::factory()
                ->count(2)
        )
        ->count(2)
        ->hasAttached(
            Contact::factory()
                ->count(1),
            ['role' => ContactRoles::Evaluated->value]
        )
        ->create();

    $this->assertDatabaseCount('homeworks', 4);
    foreach ($jiris as $jiri) {
        expect($jiri->projects->count())->toBe(2)
            ->and($jiri->homeworks->count())->toBe(2);
    }

    $this->assertDatabaseCount('attendances', 2);
    foreach ($jiris as $jiri) {
        expect($jiri->contacts->count())->toBe(1)
            ->and($jiri->attendances->count())->toBe(1);

    }

    $this->assertDatabaseCount('implementations', 4);
    foreach ($jiris as $jiri) {
        $contact = $jiri->contacts;
        expect($contact->homeworks->count())->toBe(2)
            ->and($contact->implementations->count())->toBe(2);

    }
});
