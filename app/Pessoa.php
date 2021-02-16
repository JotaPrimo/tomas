<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $fillable = [
        'nome', 'cpf', 'sexo', 'rg', 'nis', 'renda', 'dt_nascimento'
    ];

    protected $table = 'pessoas';
}
