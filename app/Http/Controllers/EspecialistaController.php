<?php

namespace App\Http\Controllers;

use App\Models\{
    Especialista,
    EspecialistaAssunto,
    EspecialistaDisponibilidade,
    EspecialistaEspecialidade
};

use Illuminate\Http\Request;
use App\Traits\Configuracao;

class EspecialistaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use Configuracao;


    public function index()
    {
        // Filtro para empresas
        $lista = Especialista::all();
        return view('pages.cadastros.especialistas.index', compact('lista'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $estados = Configuracao::estados();
        $especialidades = EspecialistaEspecialidade::all();
        $disponibilidades = EspecialistaDisponibilidade::all();
        $assuntos = EspecialistaAssunto::all();
        return view('pages.cadastros.especialistas.form', compact('estados', 'especialidades', 'disponibilidades', 'assuntos'));
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
                'nome' => 'required|min:5',
                'data_de_nascimento' => 'required',
                'cep' => 'required',
                'endereco' => 'required',
                'estado' => 'required',
                'celular' => 'required',
                'cpf' => 'required',
                'email' => 'required',
                'status' => 'required'
            ],
            [
                'nome.required' => 'É necessário preencher o nome completo',
                'data_de_nascimento.required' => 'A data de nascimento é inválida',
                'cep.required' => 'O CEP é indispensável',
                'estado.required' => 'Selecione o Estado corretamente',
                'endereco.required' => 'Preencha o endereço com número da residência',
                'cidade.required' => 'Preencha a cidade',
                'email.required' => 'Digite o e-mail do especialista',
                'cpf.required' => 'Preencha corretamente o CPF',
                'celular.required' => 'Digite corretamente o telefone celular / whatsapp',
                'status.required' => 'Selecione o Status'
            ]
        );


        /** Se for efetuar o Upload da imagem */
        if ($request->imagem) {

            /** Definição de nome do arquivo */
            $imagem = time() . '.' . $request->imagem->extension();

            /** Efetua o Upload da imagem */
            $request->imagem->move(public_path('images'), $imagem);
        }



        $especialista = new especialista();
        $especialista->nome = $request->nome;
        $especialista->data_de_nascimento = $request->data_de_nascimento;
        $especialista->cep = $request->cep;
        $especialista->endereco = $request->endereco;
        $especialista->estado = $request->estado;
        $especialista->cidade = $request->cidade;
        $especialista->cpf = $request->cpf;
        $especialista->celular = $request->celular;
        $especialista->email = $request->email;
        $especialista->imagem = $imagem ?? null;

        $especialista->especialidades = json_encode($request->especialidades);
        $especialista->disponibilidades = json_encode($request->disponibilidades);
        $especialista->assuntos = json_encode($request->assuntos);
        $especialista->formacao_titulo = $request->formacao_titulo;
        $especialista->formacao_universidade = $request->formacao_universidade;
        $especialista->sobre = $request->sobre;

        $especialista->status = $request->status;

        $especialista->save();


        return redirect(route('especialista.editar', $especialista->id))
            ->with('success', 'Um registro foi adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\especialista  $especialista
     * @return \Illuminate\Http\Response
     */
    public function show(especialista $especialista)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\especialista  $especialista
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = Especialista::find($id);
        $estados = Configuracao::estados();
        $especialidades = EspecialistaEspecialidade::all();
        $disponibilidades = EspecialistaDisponibilidade::all();
        $assuntos = EspecialistaAssunto::all();

        if (!$id or !$store) :
            return redirect(route('especialista'))
                ->with('error', 'Registro não encontrado!');
        endif;

        return view('pages.cadastros.especialistas.form', compact('store', 'estados', 'assuntos', 'disponibilidades', 'especialidades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\especialista  $especialista
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, especialista $especialista)
    {
        //
        $request->validate(
            [
                'nome' => 'required|min:5',
                'data_de_nascimento' => 'required',
                'cep' => 'required',
                'endereco' => 'required',
                'estado' => 'required',
                'celular' => 'required',
                'cpf' => 'required',
                'email' => 'required',
                'status' => 'required'
            ],
            [
                'data_de_nascimento.required' => 'A data de nascimento é inválida',
                'cep.required' => 'O CEP é indispensável',
                'estado.required' => 'Selecione o Estado corretamente',
                'endereco.required' => 'Preencha o endereço com número da residência',
                'cidade.required' => 'Preencha a cidade',
                'email.required' => 'Digite o e-mail do especialista',
                'cpf.required' => 'Preencha corretamente o CPF',
                'celular.required' => 'Digite corretamente o telefone celular / whatsapp',
                'status.required' => 'Selecione o Status'
            ]
        );

        /** Se for efetuar o Upload da imagem */
        if ($request->imagem) {

            /** Definição de nome do arquivo */
            $imagem = time() . '.' . $request->imagem->extension();

            /** Efetua o Upload da imagem */
            $request->imagem->move(public_path('images'), $imagem);
        }


        $especialista = Especialista::find($request->id);
        $especialista->nome = $request->nome;
        $especialista->data_de_nascimento = $request->data_de_nascimento;
        $especialista->cep = $request->cep;
        $especialista->endereco = $request->endereco;
        $especialista->estado = $request->estado;
        $especialista->cidade = $request->cidade;
        $especialista->cpf = $request->cpf;
        $especialista->celular = $request->celular;
        $especialista->email = $request->email;
        $especialista->status = $request->status;
        $especialista->imagem = $imagem ?? null;

        $especialista->especialidades = json_encode($request->especialidades);
        $especialista->disponibilidades = json_encode($request->disponibilidades);
        $especialista->assuntos = json_encode($request->assuntos);
        $especialista->formacao_titulo = $request->formacao_titulo;
        $especialista->formacao_universidade = $request->formacao_universidade;
        $especialista->sobre = $request->sobre;

        $especialista->status = $request->status;

        $especialista->save();

        return redirect(route('especialista.editar', $especialista->id))
            ->with('success', 'Um registro foi modificado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\especialista  $especialista
     * @return \Illuminate\Http\Response
     */
    public function destroy(especialista $especialista)
    {
        //
    }
}
