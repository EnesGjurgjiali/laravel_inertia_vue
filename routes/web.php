<?php

use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Home Route
Route::get('/', function(Request $request){
  return inertia('Home', [
    'users' => User::when($request->search, function($query) use ($request) {
      $query
      ->where('name', 'like', '%' . $request->search . '%')
      ->orWhere('email', 'like', '%' . $request->search . '%');
    }) -> paginate(5)->withQueryString(),

    'searchTerm' => $request->search,

    //If the user is authenticated, they can delete a user
    'can' => [
      'delete_user' => 
            Auth::user() ? 
                  Auth::user()->can('delete', User::class) : 
                  null
    ]
  ]);
})->name('home');

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


