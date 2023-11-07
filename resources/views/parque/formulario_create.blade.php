@extends('layouts.app')

@section('title', 'parque')



@section('content')

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h3>Cadastro de Parque</h3>
                        <hr>
                        <form method="POST" action="{{ route('parque.store') }}">
                            @csrf
                            <label class="pb-1" for="nome">Nome:</label>
                            <input type="text" class="form-control" placeholder="Digite o nome do parque" id="nome"
                                name="nome" required>

                            <button type="submit" class="btn btn-primary mt-4">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection

<!-- parque -->
