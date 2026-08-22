<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Emprestimo;
class Livro extends Model
{
    protected $fillable = [
        'titulo',
        'autor',
        'editoria',
        'ano_publicacao',
    ];

    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class);
    }
}
