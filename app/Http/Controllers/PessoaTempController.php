<?php

namespace App\Http\Controllers;

use App\Imports\PessoaTempImport;
use App\PessoaTemp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PessoaTempController extends Controller
{

    public function import(Request $request)
    {
        try {

            $pessoas = PessoaTemp::paginate(10);

            $request->validate([
                'file' => 'mimes:csv,txt'
            ]);

            $file = $request->file('file');

            Excel::import(new PessoaTempImport, $file);

            return back()->with('ok', 'Importação realizada com sucesso');

        } catch (\Exception $exception)
        {
            return back()->with('error', 'Erro : '.$exception->getMessage(), compact('pessoas'));
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pessoas = PessoaTemp::paginate(10);
        return  view("pessoa.index", compact('pessoas'));
    }

    public function limparTabela()
    {
        DB::delete("DELETE FROM pessoa_temps");
        return redirect("/")->with('delete', 'Dados deletado com sucesso');
    }

}
