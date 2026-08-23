<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\Livro;
use App\Services\Operations;
use Illuminate\Http\Request;

class EmprestimoController extends Controller
{
    public function index()
    {
        $emprestimos = Emprestimo::with('livro')->orderBy('created_at', 'desc')->get();

        return view('emprestimo.index', compact('emprestimos'));
    }

    public function criar()
    {
        $livros = Livro::orderBy('titulo')->get();

        return view('emprestimo.form', [
            'emprestimo' => new Emprestimo(),
            'livros' => $livros,
            'modo' => 'criar',
        ]);
    }

    public function criarSubmit(Request $request)
    {
        $validated = $request->validate([
            'livro_id' => 'required|integer|exists:livros,id',
            'dias' => 'required|integer|min:1',
            'extensoes_de_prazo' => 'required|integer|min:0',
            'funcionario' => 'required|string|max:100',
            'devolvido' => 'nullable|boolean',
        ], [
            'livro_id.required' => 'Selecione um livro.',
            'livro_id.exists' => 'O livro selecionado é inválido.',

            'dias.required' => 'O campo dias é obrigatório.',
            'dias.integer' => 'O campo dias deve ser um número inteiro.',
            'dias.min' => 'O campo dias deve ser no mínimo 1.',

            'extensoes_de_prazo.required' => 'O campo extensões de prazo é obrigatório.',
            'extensoes_de_prazo.integer' => 'O campo extensões de prazo deve ser um número inteiro.',
            'extensoes_de_prazo.min' => 'O campo extensões de prazo não pode ser negativo.',

            'funcionario.required' => 'O campo funcionário é obrigatório.',
            'funcionario.string' => 'O campo funcionário deve ser uma string.',
            'funcionario.max' => 'O campo funcionário não pode ter mais de 100 caracteres.',
        ]);

        $emprestimo = new Emprestimo();
        $emprestimo->livro_id = $validated['livro_id'];
        $emprestimo->dias = $validated['dias'];
        $emprestimo->extensoes_de_prazo = $validated['extensoes_de_prazo'];
        $emprestimo->funcionario = $validated['funcionario'];
        $emprestimo->devolvido = $request->has('devolvido');
        $emprestimo->user_id = session('user')['id'];
        $emprestimo->save();

        return redirect()->route('emprestimos.index')->with('success', 'Empréstimo cadastrado com sucesso!');
    }

    public function editar($id)
    {
        $id = Operations::decryptId($id);

        $emprestimo = Emprestimo::find($id);
        if (!$emprestimo) {
            return redirect()->route('emprestimos.index');
        }

        $livros = Livro::orderBy('titulo')->get();

        return view('emprestimo.form', [
            'emprestimo' => $emprestimo,
            'livros' => $livros,
            'modo' => 'editar',
        ]);
    }

    public function editarSubmit(Request $request)
    {
        $validated = $request->validate([
            'livro_id' => 'required|integer|exists:livros,id',
            'dias' => 'required|integer|min:1',
            'extensoes_de_prazo' => 'required|integer|min:0',
            'funcionario' => 'required|string|max:100',
            'devolvido' => 'nullable|boolean',
        ], [
            'livro_id.required' => 'Selecione um livro.',
            'livro_id.exists' => 'O livro selecionado é inválido.',

            'dias.required' => 'O campo dias é obrigatório.',
            'dias.integer' => 'O campo dias deve ser um número inteiro.',
            'dias.min' => 'O campo dias deve ser no mínimo 1.',

            'extensoes_de_prazo.required' => 'O campo extensões de prazo é obrigatório.',
            'extensoes_de_prazo.integer' => 'O campo extensões de prazo deve ser um número inteiro.',
            'extensoes_de_prazo.min' => 'O campo extensões de prazo não pode ser negativo.',

            'funcionario.required' => 'O campo funcionário é obrigatório.',
            'funcionario.string' => 'O campo funcionário deve ser uma string.',
            'funcionario.max' => 'O campo funcionário não pode ter mais de 100 caracteres.',
        ]);

        $id = Operations::decryptId($request->emprestimo_id);

        $emprestimo = Emprestimo::find($id);
        if (!$emprestimo) {
            return redirect()->route('emprestimos.index');
        }

        $validated['devolvido'] = $request->has('devolvido');

        $emprestimo->update($validated);

        return redirect()->route('emprestimos.index')->with('success', 'Empréstimo atualizado com sucesso!');
    }

    public function deletar($id)
    {
        $id = Operations::decryptId($id);

        $emprestimo = Emprestimo::with('livro')->find($id);
        if (!$emprestimo) {
            return redirect()->route('emprestimos.index');
        }

        return view('emprestimo.deletar', compact('emprestimo'));
    }

    public function deletarSubmit($id)
    {
        $id = Operations::decryptId($id);

        $emprestimo = Emprestimo::find($id);
        if (!$emprestimo) {
            return redirect()->route('emprestimos.index');
        }

        $emprestimo->delete();

        return redirect()->route('emprestimos.index')->with('success', 'Empréstimo removido com sucesso!');
    }
}