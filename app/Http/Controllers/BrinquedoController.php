<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Brinquedo;


class BrinquedoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userId = Auth::id();

        $brinquedos = Brinquedo::where('usuario_id', '=', $userId)->get();

        return view('brinquedo.index', compact('brinquedos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statusFuncionamento = ['ATIVO', 'MANUTENÇÃO','INATIVO'];

        return view('brinquedo.create', compact('statusFuncionamento'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'nome'=>['required', 'max:45'],
            'capacidade'=>['required', 'min:1','numeric'],
            'valor_ingresso'=>['required', 'min:0','numeric'],
            'status_funcionamento'=>['required']
        ]);


        $brinquedo = new Brinquedo();

        $brinquedo->nome = $request->get('nome');
        $brinquedo->capacidade = $request->get('capacidade');
        $brinquedo->valor_ingresso = $request->get('valor_ingresso');
        $brinquedo->status_funcionamento = $request->get('status_funcionamento');
        $brinquedo->descricao = $request->get('descricao');
        $brinquedo->usuario_id = $userId;

        $brinquedo->save();

        return redirect('/brinquedo')->with('success', 'Brinquedo salvo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
