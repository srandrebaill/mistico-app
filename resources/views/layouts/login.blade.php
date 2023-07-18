@extends('layouts.app')
@section('title', 'Acesso ao Sistema')
@section('content')

<div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth">
        <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
                <div class="brand-logo text-center">
                    <img src="{{ asset('assets/logotipo.jpg') }}">
                </div>
                <div class="auth-form-light text-left p-5" style="border-radius: 20px">
                    <h6 class="font-weight-light">Para acessar o sistema preencha suas credenciais</h6>

                    <form method="POST" action="{{ route('login.custom') }}" class="pt-3">
                        @csrf
                        <div class="form-group">
                            <input type="text" placeholder="Email / Usuário" id="email" class="form-control form-control-lg" name="email" required autofocus>
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Senha" id="password" class="form-control form-control-lg" name="password" required>
                            @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="mt-3 text-center">
                            <button type="submit" class="btn btn-gradient-danger font-weight-medium auth-form-btn">ENTRAR NO PAINEL</button>
                        </div>
                        <!-- <div class="my-2 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <label class="form-check-label text-muted">
                                    <input type="checkbox" name="remember" class="form-check-input" ~[]> Permanecer Conectado </label>
                            </div>
                            <a href="{{ url('recuperar_senha') }}" class="auth-link text-black">Esqueceu a senha?</a>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
<!-- page-body-wrapper ends -->



@endsection