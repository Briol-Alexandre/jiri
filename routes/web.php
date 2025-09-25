<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

require 'jiri.php';

require 'contact.php';

require 'project.php';
