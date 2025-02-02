<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function registering(Request $request)
    {
        /*
        $custom_error_message = [
            'name.required' => 'The Username field is required.',
            'name.string' => 'The Username must be a string.',
            'name.max' => 'The Username may not be greater than 255 characters.',
            'name.min' => 'The Username may not be less than 3 characters.',

            'email.required' => 'The Email field is required.',
            'email.email' => 'The Email must be a valid email address.',
            'email.unique' => 'The Email has already been taken.',

            'password.required' => 'The Password field is required.',
            'password.min' => 'The Password must be at least 8 characters.',
            'password.max' => 'The Password may not be greater than 255 characters.',
            'password.string' => 'The Password must be a string.',
        ];
        */

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
}
