<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>




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

    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link active" href="{{ url("/cadastro") }}">Cadastro</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/new-cadastro') }}">New Cadastro</a>
        </li>

    </ul>

    <div class="container">

        <div class="row">

            <div class="col-12">

                <div class="card mt-3">

                    <card class="card-header">
                        Importação
                    </card>

                    <div class="card-body">

                        @if(session()->has('delete'))
                            <div class="alert alert-success" role="alert">
                                {{ session('delete') }}
                            </div>
                        @endif

                        <form action="{{ url('/import') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            @if($errors->any())
                                <div class="alert alert-warning" role="alert">
                                    @foreach($errors->all() as $error)      {{ $error }} @endforeach
                                </div>
                            @elseif(session()->has('ok'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('ok') }}
                                </div>

                            @elseif(session()->has('error'))
                                <div class="alert alert-warning" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif



                            <input type="file" name="file" required class="form-control">
                            <button class="btn btn-primary mt-2" type="submit" >Importar</button>


                            <button type="button" class="btn btn-warning mt-2" data-toggle="modal" data-target="#exampleModal">
                                Limpar tabela
                            </button>


                        </form>

                    </div>

                </div>

            </div>

        </div>



        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Atenção</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Deletar dados da tabela temporária ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                        <a href="{{ url("/limparTabela") }}">
                            <button type="button" class="btn btn-success">Sim, deletar</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <div class="card mt-3">

            <div class="card-body">

                <table class="table table-hover">

                    <thead>

                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">RG</th>
                        <th scope="col">CPF</th>
                        <th scope="col">NIS</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Renda</th>
                        <th scope="col">Nascimento</th>
                    </tr>

                    </thead>

                    <tbody>

                    @foreach($pessoas as $pessoa)
                        <tr>
                            <td> {{ $pessoa->nome }} </td>
                            <td> {{ $pessoa->rg }} </td>
                            <td> {{ $pessoa->cpf }} </td>
                            <td> {{ $pessoa->nis }} </td>
                            <td> {{ $pessoa->sexo }} </td>
                            <td> {{ $pessoa->renda }} </td>
                            <td> {{ $pessoa->dt_nascimento }} </td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>

            </div>

        </div>



    </div>

</div>
</body>


</html>
