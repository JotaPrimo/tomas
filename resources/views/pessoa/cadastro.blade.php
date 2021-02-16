<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">




    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

                @if(session()->has('delete'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('delete') }}
                    </div>
                @endif

                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url("/cadastro") }}">Cadastro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Import</a>
                    </li>

                </ul>

                <div class="container">




                    <div class="row">

                        <div class="col-12">

                            <div class="card mt-3">

                                <card class="card-header">
                                    Cadastro
                                </card>

                                <div class="card-body">


                                    <form action="{{ route('cadastro-store') }}" method="POST">

                                        @csrf

                                        <div class="form-row">

                                            <div class="form-group col-md-4">
                                                <label for="inputPassword4">CPF</label>
                                                <input type="text" class="form-control" name="cpf" id="cpf" placeholder="CPF....">
                                            </div>

                                            <div class="form-group col-md-4 input-field" style="margin-top: 1.9rem;!important;">
                                                <label for="inputEmail4">Nome</label>
                                                <input type="text" class="form-control" name="nome" placeholder="Nome...." id="nome">
                                            </div>


                                           <div class="form-group col-md-4">
                                                <label for="inputPassword4">RG</label>
                                                <input type="text" class="form-control" name="rg" placeholder="RG....." id="rg">
                                            </div>

                                        </div>


                                        <div class="form-row">



                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">NIS</label>
                                                <input type="text" class="form-control" placeholder="NIS..." name="nis" id="nis">
                                            </div>

                                            <div class="form-group col-md-2 s12" style="margin-top: 1.9rem;!important;">

                                                <select class="browser-default" required name="sexo" id="sexo">
                                                    <option value="" disabled selected>Sexo...</option>
                                                    <option value="1">Masculino</option>
                                                    <option value="2">Feminino</option>

                                                </select>

                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="inputEmail4">Renda</label>
                                                <input type="text" class="form-control" name="renda" placeholder="Renda...." id="renda">
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputPassword4">Data de nascimento</label>
                                                <input type="date" class="form-control" name="dt_nascimento" id="dt_nascimento">
                                            </div>

                                        </div>


                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </form>


                                </div>

                            </div>

                        </div>

                    </div>
                </div>

        </div>
    </body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function () {
            console.log('teste');
            $.ajax({
                type: 'get',
                url: '{{ url('/cadastro/buscaPessoas') }}',
                success:function (response) {


                    var custArray = response;
                    var dataCust = {};
                    var dataCust2 = {};

                    for(var i = 0; i < custArray.length; i ++)
                    {
                        dataCust[custArray[i].nome] = null;
                        dataCust2[custArray[i].nome] = custArray[i];
                    }


                    $('input#nome').autocomplete({

                            data: dataCust,
                            onAutocomplete:function (reqdata) {

                                $('#cpf').val(dataCust2[reqdata]['cpf']);
                                $('#rg').val(dataCust2[reqdata]['rg']);
                                $('#nis').val(dataCust2[reqdata]['nis']);
                                $('#sexo').val(dataCust2[reqdata]['sexo']);
                                $('#renda').val(dataCust2[reqdata]['renda']);
                                $('#dt_nascimento').val(dataCust2[reqdata]['dt_nascimento']);
                            }
                        ,
                    });
                }
            })
        });
    </script>
</html>
