@extends('dashboard')
@section('title', 'Vendas')
@section('content')

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-access-point-network menu-icon"></i>
        </span> Registrar nova Venda
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>Vendas <i class="mdi mdi-check icon-sm text-primary align-middle"></i>
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

                
                <form method="post" enctype="multipart/form-data" action="{{ route('venda.store') }}">
                    @csrf

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="cliente_id" class="form-label">Cliente</label>
                            <select class="form-control" name="cliente_id" id="cliente_id">
                                <option value="">Selecione um Cliente da Lista</option>
                                @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->id }} - {{ $cliente->nome }} - {{ $cliente->celular }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="plano_id" class="form-label">Plano</label>
                            <select class="form-control" name="plano_id" id="plano_id">
                                <option value="">Selecione um Plano da Lista</option>
                                @foreach($planos as $plano)
                                <option value="{{ $plano->id }}">{{ $plano->titulo }} - R$ {{ number_format($plano->valor, 2, ',', '.'); }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 mt-5">
                        <button type="submit" class="btn btn-gradient-primary btn-lg font-weight-medium">Gerar Link</button>

                        <a href="{{ route('cliente') }}">
                            <button type="button" class="btn btn-gradient-danger btn-lg font-weight-medium">Cancelar</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection