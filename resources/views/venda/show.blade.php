@extends('layouts.app')

@section('title', 'vendas')


@section('content')
    <div class="row">
        <div class="col">
            <p class="h2">Informações da venda</p>
        </div>
        <div class="col-auto">
            <a type="button" class="btn btn-primary col" href="{{ route('venda.index') }}">Voltar</a>
        </div>
    </div>

    <hr>

    <div class="row h-100 justify-content-center align-items-center">

        <div class="card">
            <div class="card-body">
                <p class="card-text"><strong>ID:</strong> {{ $venda->id }}</p>
                <p class="card-text"><strong>Brinquedo:</strong> {{ $venda->brinquedo }}</p>
                <p class="card-text"><strong>Forma de pagamento:</strong> {{ $venda->forma_pagamento }}</p>
                <p class="card-text"><strong>CPF:</strong> {{ $venda->cpf }}</p>
                <p class="card-text"><strong>Data da venda:</strong> {{ $venda->data_venda }}</p>
                <p class="card-text"><strong>Quantidade de ingressos:</strong> {{ $venda->quantidade_ingressos }}</p>
                <p class="card-text"><strong>Total da venda:</strong>
                    {{ sprintf('R$ %.2f', $venda->total_venda) }}</p>
            </div>
            <div class="card-footer" style="background-color: transparent">
                <div class="d-flex justify-content-between my-2">
                    <div class="row">
                        <a type="button" class="btn btn-warning col"
                            href="{{ route('venda.edit', $venda->id) }}">Editar</a>

                        <form class="col" action="{{ route('venda.destroy', $venda->id) }}" method="post">
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
