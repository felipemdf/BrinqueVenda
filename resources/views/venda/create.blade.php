@extends('layouts.app')

@section('title', 'vendas')



@section('content')
    <div class="row">
        <div class="col">
            <p class="h2">Nova Venda</p>
        </div>

        <div class="col-auto">
            <a type="button" class="btn btn-primary col" href="{{ route('venda.index') }}">Voltar</a>
        </div>
    </div>

    <hr>

    <form method="POST" action="{{ route('venda.store') }}">
        @csrf
        @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ implode('', $errors->all(':message')) }}
            </div>
        @endif

        <div class="mb-3 mt-3">
            <label for="brinquedo">Brinquedo:</label>
            <select class="form-select" id="brinquedo" name="brinquedo" onchange="updateValor()">
                @foreach ($brinquedos as $brinquedo)
                    <option valor_brinquedo="{{ $brinquedo->valor_ingresso }}" value="{{ $brinquedo->id }}">
                        {{ $brinquedo->nome }}
                    </option>
                @endforeach

            </select>
        </div>

        <div class="mb-3 mt-3">
            <label for="pagamento">Forma de Pagamento:</label>
            <select class="form-select" id="pagamento" name="pagamento">
                @foreach ($formasPagamento as $formaPagamento)
                    <option>{{ $formaPagamento }}</option>
                @endforeach

            </select>
        </div>

        <div class="mb-3 mt-3">
            <label for="quantidade">Quantidade de Ingressos:</label>
            <input onchange="updateValor()" type="number" class="form-control" id="quantidade" name="quantidade"
                step="1" value="1">
        </div>

        <div class="mb-3 mt-3">
            <label for="cpf">CPF:</label>
            <input type="text" class="form-control" id="cpf" placeholder="Digite o cpf do cliente" name="cpf">
        </div>

        <div class="mb-3 mt-3">
            <label for="total_venda">Total da Venda:</label>
            <input type="text" class="form-control" name="total_venda" id="total_venda" readonly>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
    </form>

    <script>
        updateValor();

        $(document).ready(function($) {
            $('#cpf').mask('999.999.999-99');
        });

        function updateValor() {
            var quantidade = document.getElementById('quantidade').value;
            var brinquedoSelect = document.getElementById('brinquedo');
            var valorBrinquedo = brinquedoSelect.options[brinquedoSelect.selectedIndex].getAttribute('valor_brinquedo');

            document.getElementById('total_venda').value = 'R$ ' + (quantidade * valorBrinquedo).toFixed(2);
        }
    </script>
@endsection
