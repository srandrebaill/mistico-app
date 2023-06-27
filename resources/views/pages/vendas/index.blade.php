@extends('dashboard')
@section('title', 'Vendas Registradas')
@section('content')

<style>
    .card-body {
        padding: 10px !important;

    }

    .card-relatorio {
        background: rgb(25, 26, 120);
        background: radial-gradient(circle, rgba(25, 26, 120, 1) 0%, rgba(29, 31, 29, 1) 84%, rgba(149, 1, 31, 1) 100%);
    }

    .card-saldo-saque {
        background: rgb(30, 184, 40);
        background: linear-gradient(0deg, rgba(30, 184, 40, 1) 0%, rgba(192, 32, 40, 1) 100%);
    }
</style>


<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-access-point-network menu-icon"></i>
        </span> Vendas Registradas
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>Vendas <i class="mdi mdi-check icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>
</div>

<!-- <div class="page-header">
    <h3 class="page-title">
        <a href="{{ route('venda.adicionar') }}">
            <button class="btn btn-sm btn-danger">Novo Registro</button>
        </a>
    </h3>
</div> -->


<div class="row">
    <div class="col-12 col-sm-6 col-md-3 grid-margin stretch-card">
        <div class="card card-relatorio text-white">
            <div class="card-body">
                <h4 class="font-weight-normal mb-3">Minhas Vendas <i class="mdi mdi-chart-line mdi-24px float-end"></i>
                </h4>
                <h2 class="mb-2">R$ {{ number_format($venda['expressa'], 2, ',', '.') }}</h2>
                <h6 class="card-text">Vendas total: {{ $venda['total'] }}</h6>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3 grid-margin stretch-card">
        <div class="card card-saldo-saque text-white">
            <div class="card-body">
                <h4 class="font-weight-normal mb-3">Disponível para Saque <i class="mdi mdi-cash-usd mdi-24px float-end"></i>
                </h4>
                <h2 class="mb-2">R$ {{ number_format($venda['expressa'], 2, ',', '.') }}</h2>
            </div>
        </div>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <table class="table table-hover table-striped" id="lista-simples">
                    <thead>
                        <tr>
                            <th width="8%">ID</th>
                            <th>Cliente</th>
                            <th>Plano</th>
                            <th>Pago</th>
                            <th>Método</th>
                            <th>Valor</th>
                            <th>Situação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lista as $v)
                        <tr>
                            <td>{{ $v->id }}</td>
                            <td>{{ $v->cardholderName }}</td>
                            <td>{{ $v->plano->titulo }}</td>
                            <td>{{ date("d/m/Y H:i:s", strtotime($v->created_at)) }}</td>
                            <td>{{ $v->type_payment }}</td>
                            <td> R$ {{ number_format($v->plano->valor, 2, ',', '.') }}</td>
                            <td><span class="badge badge-warning">{{ $v->status }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection