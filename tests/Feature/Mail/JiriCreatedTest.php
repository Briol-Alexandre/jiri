<?php

use App\Events\JiriCreatedEvent;
use App\Mail\JiriCreatedMail;
use App\Models\Jiri;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;
use \Illuminate\Support\Facades\Mail;
use \Illuminate\Support\Facades\Event;
use App\Listeners\SendJiriCreatedEmailListener;

it('fires an event asking to queue an email to send to the author after the creation of a Jiri', closure: function () {
    Event::fake();
    //Mail::fake();
    $user = User::factory()->create();
    actingAs($user);

    $jiri = Jiri::factory()->for($user)->raw();

    post(route('jiris.store'), $jiri);

    $jiri = Jiri::first();

    Event::assertListening(
        JiriCreatedEvent::class,
        SendJiriCreatedEmailListener::class
    );

    Event::assertDispatched(JiriCreatedEvent::class);

    //Mail::assertQueued(App\Mail\JiriCreatedMail::class);
});

it('fills correctly the email with the values of the created Jiri', function () {
    $jiri = Jiri::factory()->for(User::factory())->create();

    $mail = new JiriCreatedMail($jiri);

    $mail->assertSeeInHtml($jiri->name);
});

it('sends the email using the configured transport layout', function () {
    $user = User::factory()->create();
    $jiri = Jiri::factory()->for($user)->create();

    Mail::to($user->email)->send(new JiriCreatedMail($jiri));

    $response = file_get_contents('http://localhost:8025/api/v1/messages');

    $message = json_decode($response, true);

    $this->assertNotEmpty($message['messages']);

});

it('queues the sending of the jiri created mail after JiriCreatedEvent has been fired', function () {
    Mail::fake();
    $jiri = Jiri::factory()->for(User::factory())->create();
    event(new JiriCreatedEvent($jiri));

    Mail::assertQueued(App\Mail\JiriCreatedMail::class);
});













