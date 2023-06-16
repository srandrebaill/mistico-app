@extends('dashboard')
@section('title', 'Planos')
@section('content')

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-access-point-network menu-icon"></i>
        </span> Plano
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

                @php $action = isset($store) ? route('plano.update', $store->id) : route('plano.store'); @endphp
                <form method="post" enctype="multipart/form-data" action="{{ $action }}">
                    @csrf

                    @if(isset($store))
                    <input type="hidden" name="id" value="{{ $store->id }}">
                    @endif

                    <div class="row">
                        <div class="col-12">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" class="form-control" id="titulo" value="{{ isset($store) ? $store->titulo : '' }}" name="titulo" placeholder="Título do Plano" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label for="valor" class="form-label">Valor</label>
                            <input type="text" class="form-control money" id="valor" value="{{ isset($store) ? 'R$ ' . number_format($store->valor, 2, ',', '.') : '' }}" name="valor" placeholder="R$ 0,00" required>
                        </div>
                    </div>

                    <div class="mt-5">
                        <button type="submit" class="btn btn-gradient-primary font-weight-medium">Salvar</button>

                        <a href="{{ route('plano') }}">
                            <button type="button" class="btn btn-gradient-danger font-weight-medium">Cancelar</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




@endsection