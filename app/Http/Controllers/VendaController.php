<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Plano;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Dirape\Token\Token;


use Session;

use App\Traits\Configuracao;
use App\Traits\FuncoesAdaptadas;



class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use Configuracao;
    use FuncoesAdaptadas;

    public function index()
    {
        // Filtro para empresas
        $lista = Venda::all();
        return view('pages.vendas.index', compact('lista'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $clientes = Cliente::all();
        $planos = Plano::all();
        return view('pages.vendas.form', compact('clientes', 'planos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $venda = new Venda();
        $venda->user_id = Auth::id();
        $venda->cliente_id = $request->cliente_id;
        $venda->plano_id =  $request->plano_id;
        $venda->token = (new Token())->Unique('vendas', 'token', 64);
        $venda->expires_at = date('Y-m-d H:i:s', strtotime(now(). ' + 2 days'));;
        $venda->situacao = 'Ativo';
        $venda->save();

        return redirect(route('venda'))
            ->with('success', 'Um registro foi adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $Cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $Cliente, $id)
    {
        //
        $store = Venda::find($id);

        if (!$id or !$store) :
            return redirect(route('vendas'))
            ->with('error', 'Esta venda está indisponível');
        endif;


        return view('pages.vendas.show', compact('store'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $Cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = Cliente::find($id);
        $clientes = Cliente::all();
        $planos = Plano::all();       

        if (!$id or !$store) :
            return redirect(route('cliente'))
                ->with('error', 'Registro não encontrado!');
        endif;

        return view('pages.vendas.form', compact('store', 'clientes', 'planos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $Cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $Cliente)
    {
        //
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $Cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $Cliente)
    {
        //
    }
}
