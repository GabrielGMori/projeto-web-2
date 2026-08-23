<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    public function index()
    {
        $livros = Livro::orderBy('titulo')->get();

        return view('livro.index', compact('livros'));
    }

    public function criar()
    {
        return view('livro.form', [
            'livro' => new Livro(),
            'modo' => 'criar',
        ]);
    }

    public function criarSubmit(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:100',
            'autor' => 'required|string|max:100',
            'editora' => 'required|string|max:100',
            'ano_publicacao' => 'required|integer|min:0',
        ], [
            'titulo.required' => 'O campo título é obrigatório.',
            'titulo.string' => 'O campo título deve ser uma string.',
            'titulo.max' => 'O campo título não pode ter mais de 100 caracteres.',

            'autor.required' => 'O campo autor é obrigatório.',
            'autor.string' => 'O campo autor deve ser uma string.',
            'autor.max' => 'O campo autor não pode ter mais de 100 caracteres.',

            'editora.required' => 'O campo editora é obrigatório.',
            'editora.string' => 'O campo editora deve ser uma string.',
            'editora.max' => 'O campo editora não pode ter mais de 100 caracteres.',

            'ano_publicacao.required' => 'O campo ano de publicação é obrigatório.',
            'ano_publicacao.integer' => 'O campo ano de publicação deve ser um número inteiro.',
            'ano_publicacao.min' => 'O campo ano de publicação não pode ser negativo.',
        ]);

        $livro = new Livro();
        $livro->titulo = $validated['titulo'];
        $livro->autor = $validated['autor'];
        $livro->editora = $validated['editora'];
        $livro->ano_publicacao = $validated['ano_publicacao'];
        $livro->save();

        return redirect()->route('livros.index')->with('success', 'Livro cadastrado com sucesso!');
    }

    public function editar($id)
    {
        $livro = Livro::find($id);
        if (!$livro) {
            return redirect()->route('livros.index');
        }

        return view('livro.form', [
            'livro' => $livro,
            'modo' => 'editar',
        ]);
    }

    public function editarSubmit(Request $request, $id)
    {
        $livro = Livro::find($id);
        if (!$livro) {
            return redirect()->route('livros.index');
        }

        $validated = $request->validate([
            'titulo' => 'required|string|max:100',
            'autor' => 'required|string|max:100',
            'editora' => 'required|string|max:100',
            'ano_publicacao' => 'required|integer|min:0',
        ], [
            'titulo.required' => 'O campo título é obrigatório.',
            'titulo.string' => 'O campo título deve ser uma string.',
            'titulo.max' => 'O campo título não pode ter mais de 100 caracteres.',

            'autor.required' => 'O campo autor é obrigatório.',
            'autor.string' => 'O campo autor deve ser uma string.',
            'autor.max' => 'O campo autor não pode ter mais de 100 caracteres.',

            'editora.required' => 'O campo editora é obrigatório.',
            'editora.string' => 'O campo editora deve ser uma string.',
            'editora.max' => 'O campo editora não pode ter mais de 100 caracteres.',

            'ano_publicacao.required' => 'O campo ano de publicação é obrigatório.',
            'ano_publicacao.integer' => 'O campo ano de publicação deve ser um número inteiro.',
            'ano_publicacao.min' => 'O campo ano de publicação não pode ser negativo.',
        ]);

        $livro->update($validated);

        return redirect()->route('livros.index')->with('success', 'Livro atualizado com sucesso!');
    }

    public function deletar($id)
    {
        $livro = Livro::find($id);
        if (!$livro) {
            return redirect()->route('livros.index');
        }

        return view('livro.deletar', compact('livro'));
    }

    public function deletarSubmit($id)
    {
        $livro = Livro::find($id);
        if (!$livro) {
            return redirect()->route('livros.index');
        }

        $livro->delete();

        return redirect()->route('livros.index')->with('success', 'Livro removido com sucesso!');
    }
}
