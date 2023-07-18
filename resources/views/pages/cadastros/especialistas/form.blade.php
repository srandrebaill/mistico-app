@extends('dashboard')
@section('title', 'Cadastro de Especialista')
@section('content')




<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-access-point-network menu-icon"></i>
        </span> Cadastro de Especialista
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>Cadastros <i class="mdi mdi-check icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>
</div>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Ops!</strong><br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @php
                $action = isset($store) ? route('especialista.update', $store->id) : route('especialista.store');
                @endphp
                <form method="post" enctype="multipart/form-data" action="{{ $action }}">
                    @csrf

                    <div class="row mt-3">
                        <div class="col-md-9">
                            <label for="nome" class="form-label">Nome Completo</label>
                            <input type="text" class="form-control" id="nome" value="{{ old('nome', @$store->nome) }}" name="nome">
                        </div>

                        <div class="col-md-3">
                            <label for="data_de_nascimento" class="form-label">Data de Nascimento</label>
                            <input type="date" class="form-control" id="data_de_nascimento" value="{{ old('data_de_nascimento', @$store->data_de_nascimento) }}" name="data_de_nascimento">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-2">
                            <label for="cep" class="form-label">CEP</label>
                            <input type="text" class="form-control cep" id="cep" value="{{ old('cep', @$store->cep) }}" name="cep">
                        </div>
                        <div class="col-md-4">
                            <label for="endereco" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="endereco" value="{{ old('endereco', @$store->endereco) }}" name="endereco">
                        </div>

                        <div class="col-md-3">
                            <label for="cidade" class="form-label">Cidade</label>
                            <input type="text" class="form-control" id="cidade" value="{{ old('cidade', @$store->cidade) }}" name="cidade">
                        </div>
                        <div class="col-md-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select name="estado" id="estado" class="form-select">
                                <option value="">Selecione o Estado</option>
                                @foreach($estados as $sigla => $estado)
                                <option value="{{ $sigla }}" @php if(@$store->estado==$sigla) echo 'selected' @endphp>{{ $estado }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" value="{{ old('email', @$store->email) }}" name="email">
                        </div>

                        <div class="col-md-3">
                            <label for="celular" class="form-label">Celular / WhatsApp</label>
                            <input type="text" class="form-control celular" id="celular" value="{{ old('celular', @$store->celular) }}" name="celular">
                        </div>

                        <div class="col-md-3">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" class="form-control cpf" id="celular" value="{{ old('cpf', @$store->cpf) }}" name="cpf">
                        </div>
                    </div>

                    <div class="row mt-3">



                        <div class="col-md-4">
                            <label for="especialidades" class="form-label">Especialidades</label>
                            <select class="form-select" name="especialidades[]" id="especialidades" multiple="multiple" data-placeholder="Especialidades">

                                @foreach($especialidades as $especialidade)

                                <?php
                                $selecionado = false;
                                if (isset($store) && $store->especialidades) {
                                    if (in_array($especialidade->id, json_decode($store->especialidades))) {
                                        $selecionado = true;
                                    }
                                }
                                ?>

                                <option value="{{ $especialidade->id }}" <?php if ($selecionado) echo "selected"; ?>>{{ $especialidade->titulo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="disponibilidades" class="form-label">Dias de Atendimento</label>
                            <select class="form-select" name="disponibilidades[]" id="disponibilidade" multiple="multiple" data-placeholder="Dias de Atendimento">
                                @foreach($disponibilidades as $disponibilidade)
                                <?php
                                $selecionado = false;
                                if (isset($store) && $store->disponibilidades) {
                                    if (in_array($disponibilidade->id, json_decode($store->disponibilidades))) {
                                        $selecionado = true;
                                    }
                                }
                                ?>
                                <option value="{{ $disponibilidade->id }}" <?php if ($selecionado) echo "selected"; ?>>{{ $disponibilidade->diadasemana }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="assuntos" class="form-label">Assuntos e Áreas</label>
                            <select class="form-select" name="assuntos[]" id="assuntos" multiple="multiple" data-placeholder="Assuntos e Áreas">
                                @foreach($assuntos as $assunto)
                                <?php
                                $selecionado_assunto = false;
                                if (isset($store) && $store->assuntos) {
                                    if (in_array($assunto->id, json_decode($store->assuntos))) {
                                        $selecionado_assunto = true;
                                    }
                                }
                                ?>
                                <option value="{{ $assunto->id }}" <?php if ($selecionado_assunto) echo "selected"; ?>>{{ $assunto->titulo }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>



                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="formacao_titulo" class="form-label">Titulo da Formação</label>
                            <input type="text" class="form-control" id="formacao_titulo" value="{{ old('formacao_titulo', @$store->formacao_titulo) }}" name="formacao_titulo">
                        </div>
                        <div class="col-md-6">
                            <label for="formacao_universidade" class="form-label">Formação/Universidade</label>
                            <input type="text" class="form-control" id="formacao_universidade" value="{{ old('formacao_universidade', @$store->formacao_universidade) }}" name="formacao_universidade">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="sobre" class="form-label">Sobre o Especialista</label>
                            <textarea class="form-control" rows="10" name="sobre" id="sobre">{{ old('sobre', @$store->sobre) }}</textarea>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="imagem" class="form-label">Foto de Perfil</label>
                            <input type="file" name="imagem" id="imagem" class="form-control" accept="image/png, image/jpeg">
                        </div>
                    </div>

                    @if(isset($store) && $store->imagem)
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <img src="{{ asset('images/'.$store->imagem) }}" width="200">
                        </div>
                    </div>
                    @endif

                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status" id="status">
                                <option value="Ativo" @php if(@$store->status=="Ativo") echo 'selected' @endphp>Ativo</option>
                                <option value="Inativo" @php if(@$store->status=="Inativo") echo 'selected' @endphp>Inativo</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 mt-5">
                        <button type="submit" class="btn btn-gradient-primary btn-lg font-weight-medium">Salvar</button>

                        <a href="{{ route('especialista') }}">
                            <button type="button" class="btn btn-gradient-danger btn-lg font-weight-medium">Cancelar</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<style>
    .select2 {
        height: 40px !important;
    }
</style>
@endsection