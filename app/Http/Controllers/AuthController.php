<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        ], [
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O campo email deve conter um endereço válido.',

            'password.required' => 'O campo senha é obrigatório.',
        ]);

        $email = $validated['email'];
        $password = $validated['password'];

        $user = User::where('email', $email)->whereNull('deleted_at')->first();

        if (!$user || !password_verify($password, $user->password)) {
            return redirect()->back()->withInput()->with('login_error', 'E-mail ou senha incorretos!');
        }

        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        session(['user' => $user]);

        return redirect()->route('dashboard');
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
        ], [
                'username.required' => 'O campo nome de usuário é obrigatório.',
                'username.email' => 'O campo de nome de usuário deve conter um endereço válido.',
                'username.max' => 'O campo de nome de usuário não pode ter mais de 255 caracteres.',

                'email.required' => 'O campo email é obrigatório.',
                'email.email' => 'O campo email deve conter um endereço válido.',
                'email.unique' => 'O email informado já está em uso.',

                'password.required' => 'O campo password é obrigatório.',
                'password.min' => 'O campo password deve ter no mínimo 6 caracteres',
                'password.confirmed' => 'A confirmação de senha não corresponde à senha informada.',
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
