@extends('dashboard')
@section('title', 'Vendas Registradas')
@section('content')


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

<div class="page-header">
    <h3 class="page-title">
        <a href="{{ route('venda.adicionar') }}">
            <button class="btn btn-sm btn-danger">Novo Registro</button>
        </a>
    </h3>
</div>


<div class="row">
    <div class="col-12 col-sm-6 col-md-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <i class="mdi mdi-clock icon-lg text-primary d-flex align-items-center"></i>
                    <div class="d-flex flex-column ms-4">
                        <div class="d-flex flex-column">
                            <p class="mb-0">Minhas Vendas</p>
                            <h4 class="font-weight-bold">R$ 2.399,85</h4>
                        </div>
                        <small class="text-muted">12 vendas hoje | 26 de Junho</small>
                    </div>
                </div>
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