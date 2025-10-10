<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\JiriController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function (){
    Route::resources([
        'jiris'=> JiriController::class,
        'projects' => ProjectController::class,
        'contacts' => ContactController::class
    ]);
});
