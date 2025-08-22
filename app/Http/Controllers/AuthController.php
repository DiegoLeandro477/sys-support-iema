<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
                return redirect()->route('dev.dashboard');
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

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // Create the user
        $user = \App\Models\User::create([
            'name' => $request->name, // Default name as 'Cliente'
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'role_id' => \App\Models\Role::where('name', 'CLIENT')->first()->id, // Default role as CLIENT
        ]);

        // Log the user in
        Auth::login($user);

        // Redirect to client dashboard
        return redirect()->route('client.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
