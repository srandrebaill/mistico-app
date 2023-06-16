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
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <table class="table table-hover table-striped" id="lista-simples">
                    <thead>
                        <tr>
                            <!-- <th width="8%">ID</th> -->
                            <!-- <th>Usuário</th> -->
                            <th>Cliente</th>
                            <th>Plano</th>
                            <th>Data de Inclusão</th>
                            <th>Data de Pagamento</th>
                            <!-- <th>Link</th> -->
                            <th>Status</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lista as $v)
                        <tr>
                            <!-- <td><span class="badge badge-dark">{{ $v->id }}</span></td> -->
                            <!-- <td>{{ ($v->usuario->name) ?? '-' }}</td> -->
                            <td><span class="badge badge-danger">{{ $v->cliente->nome }}</span></td>
                            <td>{{ $v->plano->titulo }}</td>
                            <td>{{ date("d/m/Y H:i", strtotime($v->created_at)) }}</td>
                            <td>-</td>
                            <!-- <td><span class="badge badge-success">http://www.paygerenciamentos.com.br/pagamento/{{ $v->token }}</span></td> -->
                            <td><span class="badge badge-info">{{ ($v->situacao) ?? 'Desconhecido' }}</span></td>
                            <td width="10%">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Ações
                                    </button>
                                    <ul class="dropdown-menu">
                                        <!-- <li><a class="dropdown-item" href="#"><span class="mdi mdi-content-copy"></span> Copiar Link</a></li> -->
                                        <li><a class="dropdown-item" href="{{ route('venda.show', $v->id) }}"><span class="mdi mdi-apps"></span> Detalhes</a></li>
                                        <li><a class="dropdown-item" href="#"><span class="mdi mdi-delete"></span> Excluir</a></li>
                                    </ul>
                                </div>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection