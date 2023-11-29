<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Brinquedo;
use Illuminate\Support\Facades\DB;


class BrinquedoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $statusFuncionamento = ['TODOS','ATIVO', 'MANUTENÇÃO','INATIVO'];

        $userId = Auth::id();
        $filter = is_null($request->query('filter')) 
            ? ['nome' => '', 'status_funcionamento' => ''] 
            : $request->query('filter');
        
        $brinquedosQuery = DB::table('brinquedo')->where('usuario_id', '=', $userId);
        
        if (!empty($filter['nome'])) {
            $brinquedosQuery->where('nome', 'like', '%'.$filter['nome'].'%');
        }
        
        if (!empty($filter['status_funcionamento']) && $filter['status_funcionamento'] != 'TODOS') {
            $brinquedosQuery->where('status_funcionamento', $filter['status_funcionamento']);
        }

        $brinquedos = $brinquedosQuery->get();

        return view('brinquedo.index', compact('brinquedos', 'filter', 'statusFuncionamento'));
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
    public function show(Brinquedo $brinquedo)
    {
      return view('brinquedo.show')->with('brinquedo', $brinquedo);  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $brinquedo = Brinquedo::find($id);

        $statusFuncionamento = ['ATIVO', 'MANUTENÇÃO','INATIVO'];

        return view('brinquedo.edit', compact('brinquedo', 'statusFuncionamento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brinquedo $brinquedo)
    {
        $request->validate([
            'nome'=>['required', 'max:45'],
            'capacidade'=>['required', 'min:1','numeric'],
            'valor_ingresso'=>['required', 'min:0','numeric'],
            'status_funcionamento'=>['required']
        ]);
        
        $brinquedo->fill($request->all())->save();

        return redirect()->route('brinquedo.index')->with('success', 'Brinquedo editado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $brinquedo = Brinquedo::find($id);

        $brinquedo->delete();

        return redirect()->route('brinquedo.index')->with('success', 'Brinquedo deletado!');
    }
}
