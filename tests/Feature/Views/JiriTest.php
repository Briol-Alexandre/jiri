<?php

it('verifies that the jiris.create route displays a form to create a jiri',
    function (string $locale, string $main_heading) {
        App::setLocale($locale);
        $response = $this->get(route('jiris.create'));
        $response->assertSeeText($main_heading, false);
        $response->assertStatus(200);
    })
    ->with([
            ['fr', 'Créer un jiri'],
            ['en', 'Create a jiri'],
        ]);
