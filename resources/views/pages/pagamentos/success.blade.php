<!doctype html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Pagamento - Sucesso!</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap5.3/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">


    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>

    <link href="{{ asset('assets/payments/css/payment.css') }}" rel="stylesheet">

    <!-- base de integração do mercado pago -->
    <!-- https://www.mercadopago.com.br/developers/pt/docs/checkout-api/integration-configuration/card/integrate-via-core-methods -->

</head>

<style>
    .gradient-box-plano {
        background: rgb(25, 26, 120);
        background: radial-gradient(circle, rgba(25, 26, 120, 1) 0%, rgba(29, 31, 29, 1) 72%, rgba(149, 1, 31, 1) 100%);
        border-radius: 7px !important;
    }

    .gradient-box-plano .box-plano {
        text-align: left;
    }

    .gradient-box-plano .plano-titulo {
        text-transform: uppercase;
        color: #FFF;
        font-weight: bold;
        font-size: 24px;
    }

    .gradient-box-plano .plano-valor {
        float: right;
        color: orange;
        font-weight: bold;
        font-size: 24px;
    }

    .payment-description-default {
        font-size: 11px;
        color: #444444;
        border-radius: 4px;
        background-color: #EDEDED;
        padding: 7px;
        margin-bottom: 7px !important;
    }
</style>

<body className='snippet-body'>
    <div class="container-fluid px-0" id="bg-div">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-12">

                <!-- Descrição de Pagamento -->
                <div class="card0">
                    <div class="d-flex gradient-box-plano" id="wrapper">
                        <div id="page-content-wrapper">
                            <div class="row pt-3 pb-3">
                                <div class="col-12">
                                    <div class="row justify-content-right">
                                        <div class="col-12">
                                            <p class="mb-0 box-plano">
                                                <span class="plano-titulo">
                                                    {{ $payment_detail->plano->titulo }}
                                                </span>
                                                <span class="plano-valor">
                                                    R$ {{ number_format($payment_detail->plano->valor, 2, ',', '.') }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card0">
                    <div class="d-flex" id="wrapper">

                        <div id="page-content-wrapper">
                            <div class="row pt-3" id="border-btm">
                                <div class="col-12">
                                    @if($payment_detail)
                                    <div class="row justify-content-right">
                                        <div class="col-12">
                                            <h4>Parabéns, {{ $payment_detail->cardholderName }}!</h4>
                                        </div>
                                    </div>
                                    <div class="row justify-content-right">
                                        <div class="col-12">
                                            <h5>Seu pedido de número <b>{{ $payment_detail->token }}</b> foi confirmado com sucesso!</h5>
                                            <p>Envie o comprovante para seu revendedor para confirmar sua compra. Ele será responsável pela entrega do seu produto.</p>
                                        </div>
                                    </div>
                                    <div class="row justify-content-right">
                                        <table class="table table-bordered table-sm table-hover">
                                            <thead>
                                                <tr class="table-warning">
                                                    <th>Produto</th>
                                                    <th width="50%">Data</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $payment_detail->plano->titulo }}</td>
                                                    <td>{{ date("d/m/Y H:i:s") }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <hr>
                                        <table class="table table-bordered table-sm table-hover">
                                            <thead>
                                                <tr class="table-primary">
                                                    <th width="50%">Método de Pagamento</th>
                                                    <th width="50%">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $payment_detail->type_payment }}</td>
                                                    <td>{{ $payment_detail->status }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">{{ $payment_detail->status_detail }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                    Este token é inválido ou não autorizado
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>

    <script>
        $(document).ready(function() {
            $("#copyBtn").on('click', function() {
                let CodigoQR = document.getElementById("copyInput");
                CodigoQR.select();
                CodigoQR.setSelectionRange(0, 99999)
                document.execCommand("copy");

                if (CodigoQR) {
                    $("#copyBtn").text('copiado');
                    $("#copyBtn").addClass('btn-success');
                    $("#copyBtn").removeClass('btn-warning');

                    setTimeout(function() {
                        $("#copyBtn").removeClass('btn-success');
                        $("#copyBtn").addClass('btn-warning');
                        $("#copyBtn").text('copiar');
                    }, 4000);
                }
            })
        })
    </script>


</body>

</html>