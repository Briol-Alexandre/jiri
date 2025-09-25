<?php

use App\Models\Contact;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

it('creates a contact and redirects to the contacts index',
    function () {
        $contact = Contact::factory()->make()->toArray();

        $response = $this->post('/contacts', $contact);

        $response->assertStatus(302);
        $response->assertRedirect('/contacts');
        assertDatabaseHas('contacts', $contact);
    }
);

it('shows all the contacts in the contacts index', function () {
    $contacts = Contact::factory()->count(10)->create();

    $response = $this->get('/contacts');

    foreach ($contacts as $contact) {
        $response->assertSee($contact->name);
    }
});

it('can modify a contact', function () {
    $contact = Contact::factory()->create();

    $this->patch('/contacts/'.$contact->id, [
        'name' => 'Raoul Bagarre',
        'email' => $contact->email,
    ]);

    assertDatabaseHas('contacts', ['name' => 'Raoul Bagarre']);
});

it('shows a specific contact', function () {
    $contact = Contact::factory()->create();

    $response = $this->get('/contacts/'.$contact->id);

    $response->assertSee($contact->name);

});

it('deletes a contact', function () {
    $contact = Contact::factory()->create();

    $this->delete('/contacts/'.$contact->id);

    assertDatabaseMissing('contacts', ['name' => $contact->name]);

});

it('checks if field are invalid', function () {
    $contact = [
        'name' => '',
        'email' => 'test',
    ];

    $response = $this->post('/contacts', $contact);

    $response->assertInvalid();

});
