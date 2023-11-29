@extends('layouts.app')

@section('title', 'brinquedos')



@section('content')
    <div class="row">
        <div class="col">
            <p class="h2">Novo Brinquedo</p>
        </div>

        <div class="col-auto">
            <a type="button" class="btn btn-primary col" href="{{ route('brinquedo.index') }}">Voltar</a>
        </div>
    </div>

    <hr>

    <form method="POST" action="{{ route('brinquedo.store') }}">
        @csrf
        @if ($errors->any())
            <x-alert />
        @endif
        <div class="mb-3 mt-3">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" placeholder="Digite o nome" name="nome">
        </div>

        <div class="mb-3 mt-3">
            <label for="capacidade">Capacidade:</label>
            <input type="number" class="form-control" id="capacidade" name="capacidade" step="1" value="1">
        </div>

        <div class="mb-3 mt-3">
            <label for="valor_ingresso">Valor do ingresso:</label>
            <input type="number" class="form-control" id="valor_ingresso" name="valor_ingresso" step="0.50"
                value="0">
        </div>

        <div class="mb-3 mt-3">
            <label for="status_funcionamento">Status:</label>
            <select class="form-select" id="status_funcionamento" name="status_funcionamento">
                @foreach ($statusFuncionamento as $status)
                    <option>{{ $status }}</option>
                @endforeach

            </select>
        </div>

        <div class="mb-3 mt-3">
            <label for="descricao">Descrição:</label>
            <textarea class="form-control" rows="3" id="descricao" placeholder="Digite uma descrição" name="descricao"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
@endsection
