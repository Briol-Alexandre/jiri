<?php

use App\Enums\ContactRoles;
use App\Models\Contact;
use App\Models\Jiri;
use App\Models\User;
use function Pest\Laravel\actingAs;

beforeEach(function (){
    $this->user = User::factory()->create();

    actingAs($this->user);
});

it('is possible to directly link a contact to a jiri and assign his role in the contact.create view', function (){
   $form_data = Contact::factory()->for($this->user)->raw();
   $form_data['jiris'] =  Jiri::factory()
       ->for($this->user)
       ->create()
       ->pluck('id', 'id')
       ->toArray();

    foreach ($form_data['jiris'] as $id) {
        $form_data['roles'][$id] = random_int(0, 1) ? ContactRoles::Evaluators->value : ContactRoles::Evaluated->value;
    }

   $this->post(route('contacts.store', $form_data));

    $this->assertDatabaseCount('attendances', 1);

});

