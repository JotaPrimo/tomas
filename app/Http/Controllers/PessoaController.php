<?php

namespace App\Http\Controllers;

use App\Pessoa;
use App\PessoaTemp;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pessoa.cadastro");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $pessoa = new Pessoa();
            $pessoa->nome = $request->nome;
            $pessoa->cpf = $request->cpf;
            $pessoa->sexo = (int) $request->sexo;
            $pessoa->rg = $request->rg;
            $pessoa->nis =$request->nis;;
            $pessoa->renda = (float) str_replace(',', '.', $request->renda);
            $pessoa->dt_nascimento = $request->dt_nascimento;
            $pessoa->save();


        } catch (\Exception $exception)
        {
            dd($exception);
            return redirect()->back()->with('erro-create', 'Erro, não foi possivel salvar os dados');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pessoa  $pessoa
     * @return \Illuminate\Http\Response
     */
    public function show(Pessoa $pessoa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pessoa  $pessoa
     * @return \Illuminate\Http\Response
     */
    public function edit(Pessoa $pessoa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pessoa  $pessoa
     * @return \Illuminate\Http\Response
     */



    public function getPessoas()
    {
        $p = Pessoa::all();
        return response()->json($p);
    }

    public function saveChecked(Request $request)
    {

        try {

            $ids = $request->ids;

            for ($i = 0; $i < count($ids); $i++)
            {
                $pessoaTemp = (new PessoaTemp())->find($ids[$i]);
                $pessoa = new Pessoa();
                $pessoa->nome = $pessoaTemp->nome;
                $pessoa->cpf = $pessoaTemp->cpf;
                $pessoa->nis = $pessoaTemp->nis;
                $pessoa->rg = $pessoaTemp->rg;
                $pessoa->sexo = $pessoaTemp->sexo;
                $pessoa->renda = $pessoaTemp->renda;
                $pessoa->dt_nascimento = $pessoaTemp->dt_nascimento;
                $pessoa->save();
            }

            PessoaTemp::whereIn('id', $ids)->delete();

            return redirect('/')->with('create', 'Dados salvos com sucesso');

        } catch (\Exception $exception)
        {
            return redirect()->back()->with('salve-erro', 'Erro, não foi possivel salvar os dados');
        }

    }
}
