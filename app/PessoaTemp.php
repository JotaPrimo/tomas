<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PessoaTemp extends Model
{
    protected $fillable = [
        'nome', 'cpf', 'sexo', 'rg', 'nis', 'renda', 'dt_nascimento'
    ];

    protected $table = 'pessoa_temps';
}
