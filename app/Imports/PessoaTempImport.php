<?php

namespace App\Imports;

use App\PessoaTemp;
use Maatwebsite\Excel\Concerns\ToModel;

class PessoaTempImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PessoaTemp([
            'nome'         => $row[0],
            'cpf'          => $row[1],
            'sexo'         => $row[2],
            'rg'           => $row[3],
            'nis'          => $row[4],
            'renda'        => $row[5],
            'dt_nascimento' => $row[6]
        ]);
    }
}
