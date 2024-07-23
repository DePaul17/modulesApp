<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        // Validation des données du formulaire
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        // Vérification des informations d'identification
        $credentials = $request->only('email', 'password');
        $remember_me = $request->has('remember_me');

        if (Auth::attempt($credentials, $remember_me)) {
            // Si l'authentification réussie
            return redirect()->intended('dashboard');
        }

        // Si l'authentification échoue
        return redirect()->route('login')
            ->withErrors(['error' => 'Email ou mot de passe incorrect'])
            ->withInput();
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
