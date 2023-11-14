@extends('layouts.app')

@section('title', 'brinquedos')



@section('content')
    <div class="row">
        <div class="col">
            <p class="h2">Informações do brinquedo</p>
        </div>
        <div class="col-auto">
            <a type="button" class="btn btn-primary col" href="{{ route('brinquedo.index') }}">Voltar</a>
        </div>
    </div>

    <hr>

    <div class="row h-100 justify-content-center align-items-center">

        <div class="card">
            <div class="card-body">
                <p class="card-text"><strong>ID:</strong> {{ $brinquedo->id }}</p>
                <p class="card-text"><strong>Nome:</strong> {{ $brinquedo->nome }}</p>
                <p class="card-text"><strong>Valor do Ingresso:</strong>
                    {{ sprintf('R$ %.2f', $brinquedo->valor_ingresso) }}</p>
                <p class="card-text"><strong>Capacidade:</strong> {{ $brinquedo->capacidade }}</p>
                <p class="card-text"><strong>Status de funcionamento:</strong> {{ $brinquedo->status_funcionamento }}</p>
                <p class="card-text"><strong>Descrição:</strong> {{ $brinquedo->descricao }}</p>
            </div>
            <div class="card-footer" style="background-color: transparent">
                <div class="d-flex justify-content-between my-2">
                    <div class="row">
                        <a type="button" class="btn btn-warning col"
                            href="{{ route('brinquedo.edit', $brinquedo->id) }}">Editar</a>

                        <form class="col" action="{{ route('brinquedo.destroy', $brinquedo->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button style="height: 100%;" type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection
