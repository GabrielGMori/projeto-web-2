@extends('layouts.main_layout')

@section('content')
    @include('componentes.top_bar')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-lg-5">
                        <h1 class="h3 text-white mb-4 text-center">Criar conta</h1>

                        <form method="POST" action="{{ route('register.submit') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="username" class="form-label">Nome de usuário</label>
                                <input id="username" name="username" type="text" class="form-control"
                                    value="{{ old('username') }}">
                                @error('username')
                                    <p class="text-white">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input id="email" name="email" type="email" class="form-control" value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-white">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input id="password" name="password" type="password" class="form-control">
                                @error('password')
                                    <p class="text-white">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirmar senha</label>
                                <input id="password_confirmation" name="password_confirmation" type="password"
                                    class="form-control">
                                @error('password_confirmation')
                                    <p class="text-white">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
                        </form>

                        <p class="text-center mt-3 mb-0">
                            Já possui conta?
                            <a href="{{ route('login') }}">Entrar</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
