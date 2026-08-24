@extends('layouts.main_layout')

@section('content')
    @include('componentes.top_bar')

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-1 text-primary">Empréstimos</h1>
            <a href="{{ route('emprestimos.criar') }}" class="btn btn-primary">Novo empréstimo</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                @if ($emprestimos->isEmpty())
                    <div class="p-4 text-center text-muted">
                        Nenhum empréstimo cadastrado até o momento.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Livro</th>
                                    <th>Dias</th>
                                    <th>Extensões de prazo</th>
                                    <th>Funcionário</th>
                                    <th>Devolvido</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($emprestimos as $emprestimo)
                                    <tr>
                                        <td>{{ $emprestimo->livro->titulo ?? '—' }}</td>
                                        <td>{{ $emprestimo->dias }}</td>
                                        <td>{{ $emprestimo->extensoes_de_prazo }}</td>
                                        <td>{{ $emprestimo->funcionario }}</td>
                                        <td>
                                            @if ($emprestimo->devolvido)
                                                Sim
                                            @else
                                                Não
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('emprestimos.editar', App\Services\Operations::encryptId($emprestimo->id)) }}"
                                                    class="btn btn-sm btn-outline-primary">Editar</a>
                                                <a href="{{ route('emprestimos.deletar', App\Services\Operations::encryptId($emprestimo->id)) }}"
                                                    class="btn btn-sm btn-outline-danger">Excluir</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection