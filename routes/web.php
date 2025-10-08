<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

require 'jiri.php';

require 'contact.php';

require 'project.php';
