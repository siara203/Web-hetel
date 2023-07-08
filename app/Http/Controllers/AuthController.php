<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

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
           
            if (Auth::user()->isAdmin()) {
                     return redirect('/admin-dashboard');

            } else {
                return redirect('/');
            }
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
            'phone' => 'required|digits_between:5,15',
            'address' => 'required',
            'pass' => 'required|min:8',
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
        $user->password = $validatedData['pass']; 
    
        $user->save();
    
        return redirect()->back()->with('success', 'You have successfully created');
    }    

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }
    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
    
        $findUser = User::where('email', $user->getEmail())->first();
        if ($findUser) {
            Auth::login($findUser);
            return redirect()->intended('/');
        } else {
            $newUser = new User;
            $newUser->provider_name = "Google";
            $newUser->provider_id = $user->getId();
            $newUser->full_name = $user->getName();
            $newUser->email = $user->getEmail();
            $newUser->role = 'user';
            $newUser->save();
            Auth::login($newUser);
            return redirect()->intended('/');
        }
    }
    
}
