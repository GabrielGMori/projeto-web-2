<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginSubmit(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $validated['email'];
        $password = $validated['password'];

        $user = User::where('email', $email)->whereNull('deleted_at')->first();

        if (!$user || !password_verify($password,$user->password)) {
            return redirect()->back()->withInput()->with('login_error', 'E-mail ou senha incorretos!');
        }

        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        session([
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
            ]
        ]);

        return redirect('/');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerSubmit(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = new User();
        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->password = password_hash($validated['password'], PASSWORD_DEFAULT);
        $user->save();

        return redirect()->route('login')->with('success', 'Cadastro realizado com sucesso! Faça login para continuar.');
    }

    public function logout()
    {
        session()->forget('user');

        return redirect()->route('login');
    }
}
