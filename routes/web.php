<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

//Home Route
Route::inertia('/', 'Home')->name('home');

//Middleware for authenticated users
  Route::middleware(['auth'])->group(function () {
  //Dashboard Route
  Route::inertia('/dashboard', 'Dashboard')->name('dashboard');
  //Logout Route
  Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

//Middleware for guest users
Route::middleware(['guest'])->group(function () {
  //Register Routes
  Route::inertia('/register', 'Auth/Register')->name('register');
  Route::post('/register', [AuthController::class, 'register']);
  //Login Routes
  Route::inertia('/login', 'Auth/Login')->name('login');
  Route::post('/login', [AuthController::class, 'login']);
});


