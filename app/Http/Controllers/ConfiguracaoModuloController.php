<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\ConfiguracaoModulo;
use RealRashid\SweetAlert\Facades\Alert;

use App\Traits\Configuracao;


class ConfiguracaoModuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use Configuracao;

    
    public function index()
    {
        //
        $lista = ConfiguracaoModulo::select("modulos.*", "m2.titulo as vinculo")->join("modulos as m2", "m2.id", "=", "modulos.modulo_id", "left")->get();
        return view('pages.configuracoes.modulo.index', compact('lista'));
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
        $acoes_permitidas = Configuracao::acoes_permitidas();
        return view('pages.configuracoes.modulo.form', compact('modulos', 'acoes_permitidas'));
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
        $request->validate(
            [
                'titulo' => 'required|min:5',
                'url_amigavel' => 'required|unique:modulos,url_amigavel',
                'posicao' => 'required',
                'acoes_permitidas' => 'required'
            ], 
            [
                'titulo.required' => 'É necessário preencher o título do Módulo',
                'url_amigavel.required' => 'É necessário configurar uma URL Amigável para acesso ao Módulo',
                'url_amigavel.unique' => 'Esta URL já consta em nosso banco de dados. Use outra!',
                'posicao.required' => 'É necessário posicionar o Módulo de acordo com a sua exibição',
                'acoes_permitidas.required' => 'Selecione ao menos uma ação que será permitida dentro deste Módulo'
            ]
        );

        $modulo = new ConfiguracaoModulo();
        $modulo->modulo_id = ($request->modulo_id) ?? 0;
        $modulo->titulo = $request->titulo;
        $modulo->url_amigavel = $request->url_amigavel;
        $modulo->posicao = $request->posicao;
        $modulo->icone = $request->icone;
        $modulo->tipo_de_acao = implode(",", $request->acoes_permitidas);
        $modulo->save();

        return redirect(route('modulo.editar', $modulo->id))
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
    public function edit($id)
    {
        //
        $store = ConfiguracaoModulo::find($id);
        $modulos = ConfiguracaoModulo::all();
        $acoes_permitidas = Configuracao::acoes_permitidas();

            if(!$id or !$store):
                return redirect(route('modulo'))
                    ->with('error', 'Esse registro não foi encontrado.');
            endif;

            return view('pages.configuracoes.modulo.form', compact('store', 'modulos', 'acoes_permitidas'));
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
        //
        $request->validate(
            [
                'titulo' => 'required|min:5',
                'url_amigavel' => 'required|unique:modulos,url_amigavel,'.$id,
                'posicao' => 'required',
                'acoes_permitidas' => 'required'
            ], 
            [
                'titulo.required' => 'É necessário preencher o título do Módulo',
                'url_amigavel.required' => 'É necessário configurar uma URL Amigável para acesso ao Módulo',
                'url_amigavel.unique' => 'Esta URL já consta em nosso banco de dados. Use outra!',
                'posicao.required' => 'É necessário posicionar o Módulo de acordo com a sua exibição',
                'acoes_permitidas.required' => 'Selecione ao menos uma ação que será permitida dentro deste Módulo'
            ]
        );

        $modulo = ConfiguracaoModulo::find($id);
        $modulo->modulo_id = ($request->modulo_id) ?? 0;
        $modulo->titulo = $request->titulo;
        $modulo->url_amigavel = $request->url_amigavel;
        $modulo->icone = $request->icone;
        $modulo->posicao = $request->posicao;
        $modulo->tipo_de_acao = implode(",", $request->acoes_permitidas);
        $modulo->save();

        return redirect(route('modulo.editar', $modulo->id))
            ->with('success', 'Um registro foi modificado com sucesso!');      
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
