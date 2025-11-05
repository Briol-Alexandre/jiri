<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JiriController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('/user/{user}', [UserController::class, 'update'])->name('users.update');

    Route::resources([
        'jiris' => JiriController::class,
        'projects' => ProjectController::class,
        'contacts' => ContactController::class
    ]);
});
