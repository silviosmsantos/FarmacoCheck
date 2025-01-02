<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::view('profile', 'profile')->middleware(['auth'])->name('profile');

Route::get('/users', [UserController::class , 'index'])->middleware(['auth', 'verified' , 'can:view users'])->name('users');

require __DIR__.'/auth.php';
