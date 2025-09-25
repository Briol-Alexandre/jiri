<?php

test('the application returns a successful response', function () {
    $response = $this->get('/'); // action

    $response->assertStatus(200); // assert
});
