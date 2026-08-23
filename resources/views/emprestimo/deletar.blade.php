@extends('layouts.main_layout')

@section('content')
    @include('componentes.top_bar')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-danger shadow-sm">
                    <div class="card-body p-4 text-center">
                        <h1 class="h3 text-danger mb-3">Confirmar exclusão</h1>
                        <p class="mb-4">
                            Tem certeza que deseja excluir o empréstimo do livro
                            <strong>{{ $emprestimo->livro->titulo ?? '—' }}</strong>?
                        </p>

                        <form method="POST" action="{{ route('emprestimos.deletarSubmit', App\Services\Operations::encryptId($emprestimo->id)) }}">
                            @csrf
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('emprestimos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection