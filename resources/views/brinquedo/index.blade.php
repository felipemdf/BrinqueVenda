@extends('layouts.app')

@section('title', 'brinquedos')



@section('content')
    <div class="row">
        <div class="col">
            <p class="h2">Brinquedos</p>
        </div>
        <div class="col-auto">
            <a type="button" class="btn btn-success float-right" href="{{ route('brinquedo.create') }}">Adicionar</a>
        </div>
    </div>
    <hr>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Nome</th>
                <th class="text-center">Valor do Ingresso</th>
                <th class="text-center">Status</th>
                <th class="text-center">Ações</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($brinquedos as $brinquedo)
                <tr>
                    <td class="text-center align-middle">{{ $brinquedo->id }}</td>
                    <td class="text-center align-middle">{{ $brinquedo->nome }}</td>
                    <td class="text-center align-middle">{{ sprintf('R$ %.2f', $brinquedo->valor_ingresso) }}</td>
                    <td class="text-center align-middle">{{ $brinquedo->status_funcionamento }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center">
                            <a type="button" class="btn btn-primary mx-2" href="#"><i
                                    class="far bi-eye-fill"></i></a>
                            <a type="button" class="btn btn-success mx-2" href="#"><i
                                    class="bi bi-pencil-square"></i></a>
                            <form action="{{ route('brinquedo.destroy', $brinquedo->id) }}" method="post">
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
