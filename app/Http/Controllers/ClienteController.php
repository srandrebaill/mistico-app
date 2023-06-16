<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Traits\Configuracao;

class ClienteController extends Controller
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
        $lista = Cliente::all();
        return view('pages.cadastros.clientes.index', compact('lista'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $codigo_cliente = Cliente::latest()->first();
        $codigo_cliente = ($codigo_cliente) ? $codigo_cliente->codigo_cliente + 1 : Auth::id().date("Y") + 1;
        $estados = Configuracao::estados();
        return view('pages.cadastros.clientes.form', compact('estados', 'codigo_cliente'));
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
                'email.required' => 'Digite o e-mail do cliente',
                'cpf.required' => 'Preencha corretamente o CPF',
                'celular.required' => 'Digite corretamente o telefone celular / whatsapp',
                'status.required' => 'Selecione o Status'
            ]
        );


        $cliente = new Cliente();
        $cliente->user_id = Auth::id();
        $cliente->nome = $request->nome;
        $cliente->codigo_cliente = $request->codigo_cliente;
        $cliente->data_de_nascimento = $request->data_de_nascimento;
        $cliente->cep = $request->cep;
        $cliente->endereco = $request->endereco;
        $cliente->estado = $request->estado;
        $cliente->cidade = $request->cidade;
        $cliente->cpf = $request->cpf;
        $cliente->celular = $request->celular;
        $cliente->email = $request->email;
        $cliente->status = $request->status;

        $cliente->save();
       

        return redirect(route('cliente.editar', $cliente->id))
                    ->with('success', 'Um registro foi adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $Cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $Cliente)
    {
        //
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
        $estados = Configuracao::estados();

        if (!$id or !$store) :
            return redirect(route('cliente'))
                ->with('error', 'Registro não encontrado!');
        endif;

        return view('pages.cadastros.clientes.form', compact('store', 'estados'));
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
                'email.required' => 'Digite o e-mail do cliente',
                'cpf.required' => 'Preencha corretamente o CPF',
                'celular.required' => 'Digite corretamente o telefone celular / whatsapp',
                'status.required' => 'Selecione o Status'
            ]
        );

        $cliente = Cliente::find($request->id);
        $cliente->nome = $request->nome;
        $cliente->data_de_nascimento = $request->data_de_nascimento;
        $cliente->cep = $request->cep;
        $cliente->endereco = $request->endereco;
        $cliente->estado = $request->estado;
        $cliente->cidade = $request->cidade;
        $cliente->cpf = $request->cpf;
        $cliente->celular = $request->celular;
        $cliente->email = $request->email;
        $cliente->status = $request->status;

        $cliente->save();

        return redirect(route('cliente.editar', $cliente->id))
            ->with('success', 'Um registro foi modificado com sucesso!');
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
