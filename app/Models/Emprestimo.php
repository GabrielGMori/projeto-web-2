<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Livro;
class Emprestimo extends Model
{
    protected $fillable = [
        'dias',
        'extensoes_de_prazo',
        'devolvido',
        'funcionario',
        'livro_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function livro()
    {
        return $this->belongsTo(Livro::class);
    }
}
