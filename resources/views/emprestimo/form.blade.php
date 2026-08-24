@extends('layouts.main_layout')

@section('content')
    @include('componentes.top_bar')

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-lg-5">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h1 class="h3 mb-0 text-primary">
                                {{ $modo === 'editar' ? 'Editar empréstimo' : 'Cadastrar empréstimo' }}
                            </h1>
                        </div>

                        <form method="POST" action="{{ $modo === 'editar' ? route('emprestimos.editarSubmit', App\Services\Operations::encryptId($emprestimo->id)) : route('emprestimos.criarSubmit') }}">
                            @csrf

                            @if ($modo === 'editar')
                                <input type="hidden" name="emprestimo_id" value="{{ \App\Services\Operations::encryptId($emprestimo->id) }}">
                            @endif

                            <div class="mb-3">
                                <label for="livro_id" class="form-label">Livro</label>
                                <select id="livro_id" name="livro_id" class="form-select">
                                    <option value="">Selecione um livro</option>
                                    @foreach ($livros as $livro)
                                        <option value="{{ $livro->id }}"
                                            {{ old('livro_id', $emprestimo->livro_id ?? '') == $livro->id ? 'selected' : '' }}>
                                            {{ $livro->titulo }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('livro_id')
                                    <p class="text-primary">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="dias" class="form-label">Dias</label>
                                <input id="dias" name="dias" type="number" min="1" class="form-control" value="{{ old('dias', $emprestimo->dias ?? '') }}">
                                @error('dias')
                                    <p class="text-primary">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="extensoes_de_prazo" class="form-label">Extensões de prazo</label>
                                <input id="extensoes_de_prazo" name="extensoes_de_prazo" type="number" min="0" class="form-control" value="{{ old('extensoes_de_prazo', $emprestimo->extensoes_de_prazo ?? 0) }}">
                                @error('extensoes_de_prazo')
                                    <p class="text-primary">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="funcionario" class="form-label">Funcionário</label>
                                <input id="funcionario" name="funcionario" type="text" class="form-control" value="{{ old('funcionario', $emprestimo->funcionario ?? '') }}">
                                @error('funcionario')
                                    <p class="text-primary">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input id="devolvido" name="devolvido" type="checkbox" class="form-check-input" value="1"
                                    {{ old('devolvido', $emprestimo->devolvido ?? false) ? 'checked' : '' }}>
                                <label for="devolvido" class="form-check-label">Devolvido</label>
                                @error('devolvido')
                                    <p class="text-primary">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('emprestimos.index') }}" class="btn btn-outline-primary">Cancelar</a>
                                <button type="submit" class="btn btn-primary">
                                    {{ $modo === 'editar' ? 'Salvar alterações' : 'Cadastrar empréstimo' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection