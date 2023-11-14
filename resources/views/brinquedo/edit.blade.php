@extends('layouts.app')

@section('title', 'brinquedos')



@section('content')
    <div class="row">
        <div class="col">
            <p class="h2">Editar Brinquedo</p>
        </div>

        <div class="col-auto">
            <a type="button" class="btn btn-primary col" href="{{ route('brinquedo.index') }}">Voltar</a>
        </div>
    </div>

    <hr>

    <form method="POST" action="{{ route('brinquedo.update', $brinquedo->id) }}">
        @csrf
        @method('PUT')
        @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ implode('', $errors->all(':message')) }}
            </div>
        @endif
        <div class="mb-3 mt-3">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" placeholder="Digite o nome" name="nome"
                value="{{ $brinquedo->nome }}">
        </div>

        <div class="mb-3 mt-3">
            <label for="capacidade">Capacidade:</label>
            <input type="number" class="form-control" id="capacidade" name="capacidade" step="1"
                value="{{ $brinquedo->capacidade }}">
        </div>

        <div class="mb-3 mt-3">
            <label for="valor_ingresso">Valor do ingresso:</label>
            <input type="number" class="form-control" id="valor_ingresso" name="valor_ingresso" step="0.50"
                value="{{ $brinquedo->valor_ingresso }}">
        </div>

        <div class="mb-3 mt-3">
            <label for="status_funcionamento">Status:</label>
            <select class="form-select" id="status_funcionamento" name="status_funcionamento">
                @foreach ($statusFuncionamento as $status)
                    <option {{ $brinquedo->status_funcionamento == $status ? 'selected' : '' }}>{{ $status }}</option>
                @endforeach

            </select>
        </div>

        <div class="mb-3 mt-3">
            <label for="descricao">Descrição:</label>
            <textarea class="form-control" rows="3" id="descricao" placeholder="Digite uma descrição" name="descricao">{{ $brinquedo->descricao }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
@endsection
