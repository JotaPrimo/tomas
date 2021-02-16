<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'PessoaTempController@index');
Route::get('/cadastro', 'PessoaController@create');
Route::get('/cadastro/buscaPessoas', 'PessoaController@getPessoas');
Route::post('/import', 'PessoaTempController@import');
Route::get('/limparTabela', 'PessoaTempController@limparTabela');
