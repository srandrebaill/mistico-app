<?php

namespace App\Http\Controllers;

use App\Models\Pacote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Dirape\Token\Token;

class PacoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $lista = pacote::all();
        return view('pages.cadastros.pacotes.index', compact('lista'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.cadastros.pacotes.form');
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
            ],
            [
                'titulo.required' => 'É necessário preencher o título',
                'titulo.min' => 'O título deve ter mais do que 5 caracteres'
            ]
        );

        $pacote = new pacote();
        $pacote->titulo = $request->titulo;
        $pacote->save();

        return redirect(route('pacote.editar', $pacote->id))
            ->with('success', 'Um registro foi adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pacote $pacote)
    {
        //
        $store = pacote::where('user_id', Auth::id())->find($pacote);

        if (!$store) {
            return  redirect(route('pacote'))
                ->with('error', 'Não foi possível abrir este registro.');
        }

        return view('pages.cadastros.pacotes.form', compact('store'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $store = pacote::find($id);
        if (!$store && $store == null) {
            return  redirect(route('pacote'))
                ->with('error', 'Não foi possível abrir este registro.');
        }
        return view('pages.cadastros.pacotes.form', compact('store'));
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
            ],
            [
                'titulo.required' => 'É necessário preencher o título',
                'titulo.min' => 'O título deve ter mais do que 5 caracteres'
            ]
        );

        $pacote = pacote::find($id);
        $pacote->titulo = $request->titulo;
        $pacote->save();


        return redirect(route('pacote.editar', $id))
            ->with('success', 'Um registro foi modificado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pacote $pacote)
    {
        //
    }
}
