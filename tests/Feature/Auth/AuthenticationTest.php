<?php
use App\Models\User;
use function Pest\Laravel\actingAs;

it('can display the login form', function () {

    $response = $this->get('/login');

    $response->assertSee('Connexion à l‘espace Jiri')
        ->assertSeeInOrder(['<form', 'Adresse mail', 'Mot de passe', '<button', 'Se connecter'], true);

});

it('logs the user and redirects him to the jiris.index', function (){
    $auth = User::factory()->create([
        'email' => 'test@test.com',
        'password' => 'toto'
    ]);

    $response = $this->post(route('login.store'),
        [
            'email' => 'test@test.com',
            'password' => 'toto'
        ]);

    $response->assertRedirect(route('jiris.index'));
});

it('registers a new user and redirects to the jiris.index', function () {

    $response = $this->post(route('register.store'), [
        'name' => 'Barthélemy Tarte',
        'email' => 'barthelemy.tarte@domain.com',
        'password' => 'password',
        'password_confirmation' => 'password'
    ]);

    $response->assertRedirect(route('jiris.index'));
});
