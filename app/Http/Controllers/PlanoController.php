<?php

namespace App\Http\Controllers;

use App\Models\Plano;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Dirape\Token\Token;

class PlanoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $lista = Plano::where('user_id', Auth::id())->get();
        return view('pages.cadastros.planos.index', compact('lista'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pages.cadastros.planos.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate(
            [
                'titulo' => 'required|min:5',
                'valor' => 'required'                
            ],
            [
                'titulo.required' => 'É necessário preencher o título',
                'titulo.min' => 'O título deve ter mais do que 5 caracteres',
                'valor.required' => 'É nessário preencher o valor corretamente',
            ]
        );

        $plano = new Plano();
        $plano->titulo = $request->titulo;
        $plano->valor = str_replace("R$ ", "", str_replace(",", ".", str_replace(".", "", $request->valor)));
        $plano->user_id = Auth::id();
        $plano->token = (new Token())->Unique('planos', 'token', 32);
        $plano->save();

        return redirect(route('plano.editar', $plano->id))
            ->with('success', 'Um registro foi adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plano $plano)
    {
        //
        $store = Plano::where('user_id', Auth::id())->find($plano);

        if (!$store) {
            return  redirect(route('plano'))
            ->with('error', 'Não foi possível abrir este registro.');
        }

        return view('pages.cadastros.planos.form', compact('store'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $store = Plano::where('user_id', Auth::id())->find($id);
        if (!$store && $store == null) {
            return  redirect(route('plano'))
            ->with('error', 'Não foi possível abrir este registro.');
        }
        return view('pages.cadastros.planos.form', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate(
            [
                'titulo' => 'required|min:5',
                'valor' => 'required'
            ],
            [
                'titulo.required' => 'É necessário preencher o título',
                'titulo.min' => 'O título deve ter mais do que 5 caracteres',
                'valor.required' => 'É nessário preencher o valor corretamente',
            ]
        );

        $plano = Plano::find($id);
        $plano->titulo = $request->titulo;
        $plano->valor = str_replace("R$ ", "", str_replace(",", ".", str_replace(".", "", $request->valor)));
        $plano->user_id = Auth::id();
        $plano->save();


        return redirect(route('plano.editar', $id))
        ->with('success', 'Um registro foi modificado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plano $plano)
    {
        //
    }
}
