<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function auth(LoginRequest $request) 
    {
        $user = $request->user;
        $pass = $request->password;

        if (Auth::attempt(['user'=>$user, 'password'=>$pass])) {
            $request->session()->regenerate();
            
            return redirect()->route('index');
        }
        return back()->withErrors([
            'password' => 'El usuario o la contraseña son incorrectos',
        ]);
    }
    
    public function logout(Request $request)
    {
        Auth::logout(); 
        $request->session()->invalidate(); 
        $request->session()->regenerateToken();    
        return redirect()->route('login');
    }
}
