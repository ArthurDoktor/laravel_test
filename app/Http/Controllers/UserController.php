<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function registering(Request $request)
    {
        $Data_from_form = $request->validate([
            'name' => 'required|string|max:255|min:3|unique:users',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|max:255',
        ]);

        # Encrypt password
        $Data_from_form['password'] = Hash::make($Data_from_form['password']);
        # Create a new user with the input from the form
        $user = User::create($Data_from_form);


        auth()->login($user);

        return redirect('/');
    }

    public function logout()
    {
        auth()->logout();

        return redirect('/');
    }

    public function login(Request $request)
    {
        $Data_from_form = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (auth()->attempt(['email'=>$Data_from_form['email'], 'password'=>$Data_from_form['password']])) {
            $request->session()->regenerate();
        }

        return redirect('/');
    }
}
