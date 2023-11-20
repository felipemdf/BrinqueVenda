<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Venda;
use App\Models\Brinquedo;

class VendaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $userId = Auth::id();

        $filter = is_null($request->query('filter')) 
            ? ['nome' => '', 'data_venda' => ''] 
            : $request->query('filter');
    
        $vendasQuery = DB::table('venda')
            ->join('brinquedo', 'venda.brinquedo_id', '=', 'brinquedo.id')
            ->select(
                'venda.id', 
                'venda.quantidade_ingressos',
                'brinquedo.nome as brinquedo', 
                DB::raw("strftime('%d/%m/%Y', venda.created_at) as data_venda"),
                DB::raw('quantidade_ingressos * brinquedo.valor_ingresso as total_venda'))
            ->where('usuario_id', '=', $userId);
        
        if (!empty($filter['nome'])) {
            $vendasQuery->where('nome', 'like', '%'.$filter['nome'].'%');
        }
        
        if (!empty($filter['data_venda'])) {
            $vendasQuery->whereDate('venda.created_at', $filter['data_venda']);
        }

        $vendas = $vendasQuery->get();
        
        error_log($vendas);
        
        return view('venda.index', compact('vendas', 'filter'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userId = Auth::id();

        $brinquedos = DB::table('brinquedo')
            ->select('brinquedo.*')
            ->where('brinquedo.usuario_id', $userId)
            ->where('brinquedo.status_funcionamento', 'ATIVO')
            ->get();

        $formasPagamento = ['DINHEIRO', 'PIX', 'DEBITO', 'CREDITO'];

        return view('venda.create', compact('formasPagamento', 'brinquedos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'brinquedo'=>['required'],
            'pagamento'=>['required'],
            'quantidade'=>['required', 'min:0','numeric']
        ]);


        $venda = new Venda();

        $venda->brinquedo_id = $request->get('brinquedo');
        $venda->forma_pagamento = $request->get('pagamento');
        $venda->quantidade_ingressos = $request->get('quantidade');
        $venda->cpf = $request->get('cpf');

        $venda->save();

        return redirect('/venda')->with('success', 'Venda salva!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $venda = DB::table('venda')
            ->where('venda.id', $id)
            ->join('brinquedo', 'venda.brinquedo_id', '=', 'brinquedo.id')
            ->select(
                'venda.id', 
                'venda.quantidade_ingressos',
                'brinquedo.nome as brinquedo', 
                'venda.cpf',
                'venda.forma_pagamento',
                DB::raw("strftime('%d/%m/%Y', venda.created_at) as data_venda"),
                DB::raw('venda.quantidade_ingressos * brinquedo.valor_ingresso as total_venda'))
            ->first();


        return view('venda.show', compact('venda'));  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $userId = Auth::id();

        $venda = Venda::find($id);

        $brinquedos = DB::table('brinquedo')
            ->select('brinquedo.*')
            ->where('brinquedo.usuario_id', $userId)
            ->where('brinquedo.status_funcionamento', 'ATIVO')
            ->get();

        $formasPagamento = ['DINHEIRO', 'PIX', 'DEBITO', 'CREDITO'];

        return view('venda.edit', compact('venda', 'formasPagamento', 'brinquedos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'brinquedo'=>['required'],
            'pagamento'=>['required'],
            'quantidade'=>['required', 'min:0','numeric']
        ]);

        $venda = Venda::find($id);

        $venda->brinquedo_id = $request->get('brinquedo');
        $venda->forma_pagamento = $request->get('pagamento');
        $venda->quantidade_ingressos = $request->get('quantidade');
        $venda->cpf = $request->get('cpf');

        $venda->save();

        return redirect()->route('venda.index')->with('success', 'Venda editada!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $venda = Venda::find($id);

        $venda->delete();

        return redirect()->route('venda.index')->with('success', 'Venda deletada!');
    }
}
