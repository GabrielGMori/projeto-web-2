@extends('layouts.main_layout')

@section('content')
    @include('componentes.top_bar')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-lg-5">
                        <h1 class="h3 text-primary mb-4 text-center">Entrar</h1>

                        @if (session('login_error'))
                            <p class="alert alert-danger">{{ session('login_error') }}</p>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form method="POST" action="{{ route('login.submit') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input id="email" name="email" type="email" class="form-control" value="{{ old('email') }}">
                                @error('email')
                                    <p class="text-primary">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input id="password" name="password" type="password" class="form-control">
                                @error('password')
                                    <p class="text-primary">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Entrar</button>
                        </form>

                        <p class="text-center mt-3 mb-0">
                            Ainda não tem conta?
                            <a href="{{ route('register') }}">Criar conta</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
