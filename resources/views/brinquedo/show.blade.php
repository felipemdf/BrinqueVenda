@extends('layouts.app')

@section('title', 'brinquedos')



@section('content')
    <div class="row">

        <a href="{{ route ('brinquedo.index') }}">Listar</a>

        <p class="h2">Visualizar Brinquedo</p>

        <div>ID: {{$brinquedo->id}}</div> <br>
        <div>Nome: {{$brinquedo->nome}}</div> <br>
        <div>Valor do Ingresso: {{$brinquedo->valor_ingresso}}</div> <br>
        <div>Capacidade: {{$brinquedo->capacidade}}</div> <br>
        <div>Status: {{$brinquedo->status_funcionamento}}</div> <br>

    </div>
@endsection