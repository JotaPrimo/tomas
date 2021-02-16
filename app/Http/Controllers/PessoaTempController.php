<?php

namespace App\Http\Controllers;


use App\PessoaTemp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Exception;

class PessoaTempController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pessoas = PessoaTemp::paginate(10);
        return view("pessoa.index", compact('pessoas'));
    }

    public function limparTabela()
    {
        DB::statement("DELETE FROM pessoa_temps");
        return redirect("/")->with('delete', 'Dados deletado com sucesso');
    }

    public function import(Request $request)
    {

        try {

            $pessoas = PessoaTemp::paginate(10);

            $request->validate([
                'file' => 'mimes:csv,txt'
            ]);


            $file = $request->file('file');
            $path = $file->getRealPath();

            $objeto = fopen($path, 'r');

            $primeira_linha = true;
            // vinculo coluna csv com coluna table
            while (($dados = fgetcsv($objeto, 1000, ";")) !== FALSE) {

                if ($primeira_linha == false) {

                    $pessoaTemp = new PessoaTemp();
                    $pessoaTemp->nome = $dados[$request->indice_nome];
                    $pessoaTemp->cpf = $dados[$request->indice_cpf];
                    $pessoaTemp->sexo = $dados[$request->indice_rg];
                    $pessoaTemp->rg = $dados[$request->indice_nis];
                    $pessoaTemp->nis = $dados[$request->indice_sexo];;
                    $pessoaTemp->renda = str_replace(',', '.', $dados[$request->indice_renda]);
                    $pessoaTemp->dt_nascimento = $dados[$request->indice_dt_nascimento];
                    $pessoaTemp->save();

                }

                $primeira_linha = false;

            }
            //

            return back()->with('ok', 'Importação realizada com sucesso');

        } catch (Exception $exception)
        {
            $request->validate([
                'file' => 'mimes:csv,txt'
            ]);
            return back()->with('error', 'Erro. Falha na importação ', compact('pessoas'));
        }
    }



}
