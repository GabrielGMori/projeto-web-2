@extends('layouts.main_layout')

@section('content')
    @include('componentes.top_bar')

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-lg-5">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h1 class="h3 mb-0 text-white">
                                {{ $modo === 'editar' ? 'Editar livro' : 'Cadastrar livro' }}
                            </h1>
                        </div>

                        <form method="POST" action="{{ $modo === 'editar' ? route('livros.editarSubmit', App\Services\Operations::encryptId($livro->id)) : route('livros.criarSubmit') }}">
                            @csrf

                            @if ($modo === 'editar')
                                <input type="hidden" name="livro_id" value="{{ \App\Services\Operations::encryptId($livro->id) }}">
                            @endif

                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título</label>
                                <input id="titulo" name="titulo" type="text" class="form-control" value="{{ old('titulo', $livro->titulo ?? '') }}">
                                @error('titulo')
                                    <p class="text-white">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="autor" class="form-label">Autor</label>
                                <input id="autor" name="autor" type="text" class="form-control" value="{{ old('autor', $livro->autor ?? '') }}">
                                @error('autor')
                                    <p class="text-white">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="editora" class="form-label">Editora</label>
                                <input id="editora" name="editora" type="text" class="form-control" value="{{ old('editora', $livro->editora ?? '') }}">
                                @error('editora')
                                    <p class="text-white">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="ano_publicacao" class="form-label">Ano de publicação</label>
                                <input id="ano_publicacao" name="ano_publicacao" type="number" min="0" class="form-control" value="{{ old('ano_publicacao', $livro->ano_publicacao ?? '') }}">
                                @error('ano_publicacao')
                                    <p class="text-white">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('livros.index') }}" class="btn btn-outline-primary">Cancelar</a>
                                <button type="submit" class="btn btn-primary">
                                    {{ $modo === 'editar' ? 'Salvar alterações' : 'Cadastrar livro' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
