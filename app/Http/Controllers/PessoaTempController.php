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

            while (($dados = fgetcsv($objeto, 1000, ";")) !== FALSE) {
                if ($primeira_linha == false) {

                    $pessoaTemp = new PessoaTemp();
                    $pessoaTemp->nome = utf8_encode($dados[0]);
                    $pessoaTemp->cpf = utf8_encode($dados[1]);
                    $pessoaTemp->sexo = utf8_encode($dados[2]);
                    $pessoaTemp->rg = utf8_encode($dados[3]);
                    $pessoaTemp->nis = utf8_encode($dados[4]);;
                    $pessoaTemp->renda = str_replace(',', '.', $dados[6]);
                    $pessoaTemp->dt_nascimento = utf8_encode($dados[7]);
                    $pessoaTemp->save();

                }

                $primeira_linha = false;

            }

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
