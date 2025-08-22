<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\ElseIf_;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function loginAttempt(Request $request)
    {
        $credencion = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($credencion)) {
            // Authentication passed, regenerate session
            $request->session()->regenerate();
            // Redirect based on user role
            $user = Auth::user();

            if ($user->role->name === 'DEV') {
                return redirect()->route('tech.dashboard');
            }
            if ($user->role->name === 'CLIENT') {
                return redirect()->route('client.dashboard');
            }
            return redirect()->route('login')->with('error', 'Acesso não autorizado.');
        }
        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
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
