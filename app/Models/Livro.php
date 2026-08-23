<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Emprestimo;
use Illuminate\Database\Eloquent\SoftDeletes;
class Livro extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'titulo',
        'autor',
        'editora',
        'ano_publicacao',
    ];

    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class);
    }
}
