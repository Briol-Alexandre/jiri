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

    Route::livewire('/jiris', 'pages::jiris.index')->name('jiris.index');
    /*Route::resources([
        'jiris' => JiriController::class,
        'projects' => ProjectController::class,
        'contacts' => ContactController::class
    ]);*/

    // Jiris
/*    Route::get('/jiris', [JiriController::class, 'index'])->name('jiris.index');*/
    Route::get('/jiris/create', [JiriController::class, 'create'])->name('jiris.create');
    Route::post('/jiris', [JiriController::class, 'store'])->name('jiris.store');
    Route::get('/jiris/{jiri}', [JiriController::class, 'show'])->name('jiris.show');
    Route::get('/jiris/{jiri}/edit', [JiriController::class, 'edit'])->name('jiris.edit');
    Route::put('/jiris/{jiri}', [JiriController::class, 'update'])->name('jiris.update');
    Route::delete('/jiris/{jiri}', [JiriController::class, 'destroy'])->name('jiris.destroy');

// Projects
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

// Contacts
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
    Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
    Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');
    Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
    Route::put('/contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');




});
