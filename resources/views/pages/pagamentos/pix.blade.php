<!doctype html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Pagamento - {{ $plano->titulo }}</title>
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
                                                    {{ $plano->titulo }}
                                                </span>
                                                <span class="plano-valor">
                                                    R$ {{ number_format($plano->valor, 2, ',', '.') }}
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
                                    <div class="row justify-content-right">
                                        <div class="col-12 text-center">
                                            <h4>Escaneie o QR Code abaixo e efetue o Pagamento</h4>
                                        </div>
                                    </div>
                                    <div class="row justify-content-right">
                                        <div class="col-12 text-center">
                                            <p>Aponte sua câmera para o QR Code acima e efetue o pagamento via PIX</p>
                                            <img src="data:image/jpeg;base64,{{ $payment_pix->qr_code_base64 }}" width="300px;" />
                                            <p>Copiar Código de Pagagamento</p>
                                            <div class="row">
                                                <div class="col-10">
                                                    <input type="text" class="form-control" name="copyInput" id="copyInput" value="{{ $payment_pix->qr_code }}" readonly>
                                                </div>

                                                <div class="col-1 pt-3">
                                                    <button id="copyBtn" class="btn btn-sm btn-warning" type="button">copiar</button>
                                                </div>
                                            </div>
                                            <p class="payment-description-default mt-2">
                                                <span><b>status payment:</b> {{ $payment_pix->status }} | {{ $payment_pix->status_detail }}</span>
                                            </p>
                                            <p class="payment-description-default">
                                                <b>Este código irá expirar em {{ date("d/m/Y H:i:s", strtotime($payment_pix->date_of_expiration)) }}</b>
                                            </p>
                                        </div>
                                    </div>
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