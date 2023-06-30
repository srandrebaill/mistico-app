<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;

use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{

    public function index()
    {
        return view('layouts.login');
    } 


    public function customLogin(Request $request)
    {
        //
        
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard')
                ->withSuccess('Login efetuado com sucesso!');
        }

        return redirect("login")->withError('Estes dados de acesso não são válidos.');
    }

    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }

        return redirect("login")->withSuccess('Seja bem vindo à sua Área de Trabalho!');
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }

    
}
