@extends('layouts.main_layout')

@section('content')
    @include('componentes.top_bar')

    <div class="container py-4">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h2 class="h4 mb-0 text-primary">Livros</h2>
                        </div>
                        <p class="text-muted mb-4">Gerencie os livros da biblioteca.</p>
                        <a href="{{ route('livros.index') }}" class="btn btn-primary">Acessar livros</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h2 class="h4 mb-0 text-primary">Empréstimos</h2>
                        </div>
                        <p class="text-muted mb-4">Gerencie os empréstimos de livros da biblioteca.</p>
                        <a href="{{ route('emprestimos.index') }}" class="btn btn-primary">Acessar empréstimos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
