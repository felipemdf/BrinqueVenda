@extends('layouts.app')

@section('title', 'vendas')

@section('content')
    <div class="row">
        <div class="col">
            <p class="h2">Vendas</p>
        </div>
        <div class="col-auto">
            <a type="button" class="btn btn-success float-right" href="{{ route('venda.create') }}">Adicionar</a>
        </div>
    </div>
    <hr>

    <form class="form-inline mb-4" method="GET" action="{{ route('venda.index') }}">
        @csrf

        <label for="nome">Nome do brinquedo: </label>
        <input type="text" class="form-control" id="nome" name="filter[nome]" placeholder="Nome do brinquedo"
            value="{{ $filter['nome'] ?? '' }}">

        <label for="data_venda">Data da venda: </label>
        <input type="date" class="form-control" id="data_venda" name="filter[data_venda]"
            value="{{ $filter['data_venda'] ?? '' }}">

        <button class="btn btn-primary mt-3" type="submit">Pesquisar</button>
    </form>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Brinquedo</th>
                <th class="text-center">Qtd ingressos</th>
                <th class="text-center">Valor total</th>
                <th class="text-center">Data venda</th>
                <th class="text-center">Ações</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($vendas as $venda)
                <tr>
                    <td class="text-center align-middle">{{ $venda->id }}</td>
                    <td class="text-center align-middle">{{ $venda->brinquedo }}</td>
                    <td class="text-center align-middle">{{ $venda->quantidade_ingressos }}</td>
                    <td class="text-center align-middle">{{ sprintf('R$ %.2f', $venda->total_venda) }}</td>
                    <td class="text-center align-middle">{{ $venda->data_venda }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center">
                            <a type="button" class="btn btn-primary mx-2" href="{{ route('venda.show', $venda->id) }}"><i
                                    class="far bi-eye-fill"></i></a>
                            <a type="button" class="btn btn-warning mx-2" href="{{ route('venda.edit', $venda->id) }}"><i
                                    class="bi bi-pencil-square"></i></a>
                            <form action="{{ route('venda.destroy', $venda->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger mx-2" type="submit"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
