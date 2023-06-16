<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConfiguracaoUsuarioNiveis as UsuarioTipo;
use App\Models\ConfiguracaoModulo;

use RealRashid\SweetAlert\Facades\Alert;

class ConfiguracaoUsuarioTipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $permite_excluir = 0;
        $lista = UsuarioTipo::orderBy('titulo', 'ASC')->get();
        return view('pages.configuracoes.usuario_tipo.index', compact('lista', 'permite_excluir'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $modulos = ConfiguracaoModulo::get_modulos();
        return view('pages.configuracoes.usuario_tipo.form', compact('modulos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipo = new UsuarioTipo();
        $tipo->titulo = $request->nome;
        $tipo->permissoes = json_encode(($request->permission) ?? []);
        $tipo->save();

        return redirect(route('usuario_tipo.editar', $tipo->id))
                    ->with('success', 'Um registro foi adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id=null)
    {
        $modulos = ConfiguracaoModulo::get_modulos();
        $store = UsuarioTipo::find($id);

            if(!$id or !$store): 
                return redirect(route('usuario_tipo'))
                    ->with('error', 'Esse registro não foi encontrado.');
            endif;

        return view('pages.configuracoes.usuario_tipo.form', compact('store', 'modulos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tipo = UsuarioTipo::find($request->id);
        $tipo->titulo = $request->nome;
        $tipo->permissoes = json_encode(($request->permission) ?? []);
        $tipo->save();

        return redirect(route('usuario_tipo'))
            ->with('sucess', 'Um registro foi modificado com sucesso!');         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
