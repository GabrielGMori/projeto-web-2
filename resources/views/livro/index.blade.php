@extends('layouts.main_layout')

@section('content')
    @include('componentes.top_bar')

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-1 text-white">Livros</h1>
            <a href="{{ route('livros.criar') }}" class="btn btn-primary">Novo livro</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                @if ($livros->isEmpty())
                    <div class="p-4 text-center text-muted">
                        Nenhum livro cadastrado até o momento.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Título</th>
                                    <th>Autor</th>
                                    <th>Editora</th>
                                    <th>Ano</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($livros as $livro)
                                    <tr>
                                        <td>{{ $livro->titulo }}</td>
                                        <td>{{ $livro->autor }}</td>
                                        <td>{{ $livro->editora }}</td>
                                        <td>{{ $livro->ano_publicacao }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('livros.editar', $livro->id) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                                                <a href="{{ route('livros.deletar', $livro->id) }}" class="btn btn-sm btn-outline-danger">Excluir</a>
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
