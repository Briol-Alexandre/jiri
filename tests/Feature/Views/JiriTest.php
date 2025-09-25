<?php

it('verifies that the jiris.create route displays a form to create a jiri',
    function (string $locale, string $main_heading) {
        App::setLocale($locale);
        $response = $this->get(route('jiris.create'));
        $response->assertSee("<h1 class=\"text-3xl text-center font-bold text-blue-500 my-10\">$main_heading</h1>", false);
        $response->assertStatus(200);
    })
    ->with([
            ['fr', 'Créer un jiri'],
            ['en', 'Create a jiri'],
        ]);
