<?php

use App\Http\Controllers\InteractionsController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Auths routes
Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])->name('profile');

// Users routes
Route::get('/users', [UserController::class, 'index'])
    ->middleware(['auth', 'verified', 'can:view users'])->name('users');

Route::get('/users/create', [UserController::class, 'create'])
    ->middleware(['auth', 'verified', 'can:manage users'])->name('users.create');

Route::post('/users/create', [UserController::class, 'store'])
    ->middleware(['auth', 'verified', 'can:manage users'])->name('users.store');

Route::get('/users/{user}/edit', [UserController::class, 'edit'])
    ->middleware(['auth', 'verified', 'can:manage users'])->name('users.edit');

Route::put('/users/{user}/edit', [UserController::class, 'update'])
    ->middleware(['auth', 'verified', 'can:manage users'])->name('users.update');

Route::get('/users/{user}/delete', [UserController::class, 'delete'])
    ->middleware(['auth', 'verified', 'can:manage users'])->name('users.delete');

Route::delete('/users/{user}/delete', [UserController::class, 'destroy'])
    ->middleware(['auth', 'verified', 'can:manage users'])->name('users.destroy');

// Medicines routes
Route::get('/medicines', [MedicineController::class, 'index'])
    ->middleware(['auth', 'verified', 'can:view medicines'])->name('medicines');

Route::get('/medicines/create', [MedicineController::class, 'create'])
    ->middleware(['auth', 'verified', 'can:create medicines'])->name('medicines.create');

Route::post('/medicines/create', [MedicineController::class, 'store'])
    ->middleware(['auth', 'verified', 'can:create medicines'])->name('medicines.store');

Route::get('/medicines/{medicine}/edit', [MedicineController::class, 'edit'])
    ->middleware(['auth', 'verified', 'can:edit medicines'])->name('medicines.edit');

Route::put('/medicones/{medicine}/edit', [MedicineController::class, 'update'])
    ->middleware(['auth', 'verified', 'can:edit medicines'])->name('medicines.update');

Route::get('/medicines/{medicine}/delete', [MedicineController::class, 'delete'])
    ->middleware(['auth', 'verified', 'can:delete medicines'])->name('medicines.delete');

Route::delete('/medicines/{medicine}/delete', [MedicineController::class, 'destroy'])
    ->middleware(['auth', 'verified', 'can:delete medicines'])->name('medicines.destroy');

// interactions route
Route::get('/interactions', [InteractionsController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('interactions');

Route::get('/interactions/create', [InteractionsController::class, 'create'])
    ->middleware(['auth', 'verified', 'can:create interactions'])->name('interactions.create');

Route::post('/interactions/create', [InteractionsController::class, 'store'])
    ->middleware(['auth', 'verified', 'can:create interactions'])->name('interactions.store');

Route::get('/interactions/{interaction}/edit', [InteractionsController::class, 'edit'])
    ->middleware(['auth', 'verified', 'can:edit interactions'])->name('interactions.edit');

Route::put('/interactions/{interaction}/edit', [InteractionsController::class, 'update'])
    ->middleware(['auth', 'verified', 'can:edit interactions'])->name('interactions.update');

Route::get('/interactions/{interaction}/delete', [InteractionsController::class, 'delete'])
    ->middleware(['auth', 'verified', 'can:delete interactions'])->name('interactions.delete');

Route::delete('/interactions/{interaction}/delete', [InteractionsController::class, 'destroy'])
    ->middleware(['auth', 'verified', 'can:delete interactions'])->name('interactions.destroy');

// Consultas
Route::get('/interactions/search', [InteractionsController::class, 'search'])
    ->middleware(['auth', 'verified'])->name('interactions.search');

Route::get('/reset', function () {
    return redirect()->route('dashboard');
})->name('interactions.reset');

require __DIR__.'/auth.php';
