<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Auths routes
Route::view('/', 'welcome');
Route::view('dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');
Route::view('profile', 'profile')->middleware(['auth'])->name('profile');

// Users routes
Route::get('/users', [UserController::class, 'index'])->middleware(['auth', 'verified', 'can:view users'])->name('users');
Route::get('/users/create', [UserController::class, 'create'])->middleware(['auth', 'verified', 'can:manage users'])->name('users.create');
Route::post('/users/create', [UserController::class, 'store'])->middleware(['auth', 'verified', 'can:manage users'])->name('users.store');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->middleware(['auth', 'verified', 'can:manage users'])->name('users.edit');
Route::put('/users/{user}/edit', [UserController::class, 'update'])->middleware(['auth', 'verified', 'can:manage users'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware(['auth', 'verified', 'can:manage users'])->name('users.destroy');


require __DIR__.'/auth.php';
