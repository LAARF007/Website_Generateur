<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register() {
        return view('register');
    }

    public function store() {
        $validated = request()->validate(
            [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|min:8|',
            ]
            );
        
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'] ),
        ]);

        return redirect()->route('welcome')
                         ->with('success', 'Registration successful! Please login.');
    }
}
