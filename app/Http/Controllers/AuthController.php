<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //Register method
    public function register(Request $request){

        // Validate the request data
        $fields = $request->validate([
            'avatar' => ['nullable', 'file', 'max:2048'], 
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],  
            'password' => ['required', 'confirmed']
        ]);


        // Add the avatar
        if($request->hasFile('avatar')){
           $fields['avatar'] = Storage::disk('public')->put('avatars', $request->avatar);
        }

        // Register the user
        $user = User::create($fields);  

        //Login 
        Auth::login($user);

        //Redorect 
        return redirect()->route('dashboard')->with('success', 'Registration successful! Welcome to the dashboard.');
    }

     //Login method
    public function login(Request $request){
        $fields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($fields, $request->remember)) {
            $request->session()->regenerate();
 
            return redirect()->intended('dashboard');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

     //Logout method
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
