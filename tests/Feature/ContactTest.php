<?php

use App\Models\Contact;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Laravel\Facades\Image;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use Illuminate\Support\Facades\Storage;


beforeEach(function () {
    $this->user = User::factory()->create();

    actingAs($this->user);
});
it('creates a contact and redirects to the contacts index',
    function () {
        Storage::fake('public');
        $avatar = UploadedFile::fake()->image('photo.jpg');

        $contact = [
            'name' => 'Tiffany Baignoire',
            'email' => 'a@a.a',
            'avatar' => $avatar,
        ];

        $response = $this->post(route('contacts.store'), $contact);

        $response->assertStatus(302);
        $contact = Contact::first();
        Storage::disk('public')->assertExists($contact->avatar);

        $image = Image::read(Storage::disk('public')->get($contact->avatar));
        expect($image->width())
            ->toBeLessThanOrEqual(300)
            ->and($image->height())
            ->toBeLessThanOrEqual(300);
        $response->assertRedirect(route("contacts.show", $contact));
        assertDatabaseHas('contacts', ['name' => 'Tiffany Baignoire', 'email' => 'a@a.a']);
    }
);

it('shows all the contacts in the contacts index', function () {
    $contacts = Contact::factory()->for($this->user)->count(10)->create();

    $response = $this->get('/contacts');

    foreach ($contacts as $contact) {
        $response->assertSee($contact->name);
    }
});

it('can modify a contact', function () {
    $contact = Contact::factory()->for($this->user)->create();

    $this->patch('/contacts/' . $contact->id, [
        'name' => 'Raoul Bagarre',
        'email' => $contact->email,
    ]);

    assertDatabaseHas('contacts', ['name' => 'Raoul Bagarre']);
});

it('shows a specific contact', function () {
    $contact = Contact::factory()->for($this->user)->create();

    $response = $this->get('/contacts/' . $contact->id);

    $response->assertSee($contact->name);

});

it('deletes a contact', function () {
    $contact = Contact::factory()->for($this->user)->create();

    $this->delete('/contacts/' . $contact->id);

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
