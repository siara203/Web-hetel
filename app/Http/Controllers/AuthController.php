<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('users.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
         
            return redirect('/')->with('success', 'Login Success !');
        } else {
         
            return redirect()->back()->withErrors(['login' => 'Incorrect account or password.']);
        }

    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->intended('/');
    }

    public function getRegister()
    {
        return view('users.register');
    }

    public function postRegister(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'address' => 'required',
            'pass' => 'required|min:6',
            're_pass' => 'required|same:pass',
            'agree-term' => 'required',
        ], [
            'email.unique' => 'The email has already been taken.',
            're_pass.same' => 'The password confirmation does not match.',
            'agree-term.required' => 'Please accept the terms of service.',
        ]);

        $user = new User;
        $user->full_name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->phone = $validatedData['phone'];
        $user->address = $validatedData['address'];
        $user->role = 'user';
        $user->password = Hash::make($validatedData['pass']);
        $user->save();

        return redirect()->back()->with('success', 'You have successfully created');
    }


}
