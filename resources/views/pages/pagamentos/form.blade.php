<!doctype html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Pagamento - {{ $plano->titulo ?? '' }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap5.3/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">


    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>

    <link href="{{ asset('assets/payments/css/payment.css') }}" rel="stylesheet">

    <!-- base de integração do mercado pago -->
    <!-- https://www.mercadopago.com.br/developers/pt/docs/checkout-api/integration-configuration/card/integrate-via-core-methods -->

</head>

<body className='snippet-body'>
    <div class="container-fluid px-0" id="bg-div">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-12">
                <div class="card card0">

                    @if($plano)

                    <div class="d-flex" id="wrapper">
                        <!-- Sidebar -->
                        <div class="bg-light border-right" id="sidebar-wrapper">
                            <div class="sidebar-heading pt-5 pb-4"><strong>PAGAR COM</strong></div>
                            <div class="list-group list-group-flush"> <a data-toggle="tab" href="#option-1" id="tab2" class="tabs list-group-item active1">
                                    <div class="list-div my-2">
                                        <div class="fa fa-credit-card"></div> &nbsp;&nbsp; Cartão de Crédito
                                    </div>
                                </a> <a data-toggle="tab" href="#option-2" id="tab3" class="tabs list-group-item bg-light">
                                    <div class="list-div my-2">
                                        <div class="fa fa-qrcode"></div> &nbsp;&nbsp;&nbsp; PIX <span id="new-label">Novo</span>
                                    </div>
                                </a> </div>
                        </div> <!-- Page Content -->
                        <div id="page-content-wrapper">
                            <div class="row pt-3" id="border-btm">
                                <div class="col-4">
                                    <button class="btn btn-success mt-4 ml-3 mb-3" id="menu-toggle">
                                        <div class="bar4"></div>
                                        <div class="bar4"></div>
                                        <div class="bar4"></div>
                                    </button>
                                </div>
                                <div class="col-8">
                                    <div class="row justify-content-right">
                                        <div class="col-12">
                                            <p class="mb-0 mr-4 mt-4 text-right">{{ $plano->titulo }}</p>
                                        </div>
                                    </div>
                                    <div class="row justify-content-right">
                                        <div class="col-12">
                                            <p class="mb-0 mr-4 text-right">Valor a Pagar: <span class="top-highlight">R$ {{ number_format($plano->valor, 2, ',', '.') }}</span> </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-content">

                                <div id="option-1" class="tab-pane in active">
                                    <div class="row justify-content-center">
                                        <div class="col-11">
                                            <form id="form-checkout" action="{{ route('payment.proccess') }}" method="POST">
                                                @csrf

                                                <div class="form-card">
                                                    <h3 class="mt-0 mb-4 text-center mt-5">Preencha corretamente os dados abaixo para pagamento</h3>

                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="input-group">
                                                                <input type="text" id="form-checkout__cardholderName" name="cardholderName" placeholder=" John Smith" required>
                                                                <label>Proprietário do Cartão</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="input-group">
                                                                <div id="form-checkout__cardNumber" class="form-checkout"></div>
                                                                <label>Número do Cartão</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="input-group">
                                                                <div id="form-checkout__expirationDate" class="form-checkout"></div>
                                                                <label>Data de Expiração</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-6">
                                                            <div class="input-group">
                                                                <div id="form-checkout__securityCode" class="form-checkout"></div>
                                                                <label>CVV</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="input-group">
                                                                <select id="form-checkout__installments" name="installments" class="form-checkout" required>
                                                                    <option value="1">À vista</option>
                                                                </select>
                                                                <label>Parcelas</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="input-group">
                                                                <input id="form-checkout__identificationNumber" name="identificationNumber" type="text" value="" required>
                                                                <label>Documento</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="input-group">
                                                                <input id="form-checkout__cardholderEmail" name="email" type="text" value="" required>
                                                                <label>E-mail</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <select id="form-checkout__issuer" name="issuer" class="hidden"></select>
                                                    <select id="form-checkout__identificationType" name="identificationType" class="hidden"></select>

                                                    <input id="token" name="token" type="hidden">
                                                    <input id="paymentMethodId" name="paymentMethodId" type="hidden">
                                                    <input id="transactionAmount" name="transactionAmount" type="hidden" value="{{ $plano->valor }}">
                                                    <input id="description" name="description" type="hidden" value="{{ $plano->titulo }}">
                                                    <input id="tokenPlano" name="tokenPlano" type="hidden" value="{{ $plano->token }}">

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <input type="submit" value="Pagar R$ {{ number_format($plano->valor, 2, ',', '.') }}" class="btn btn-success placeicon">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <p class="text-center mb-5" id="below-btn"><a href="#">Tenho dúvidas ao efetuar o Pagamento</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div id="option-2" class="tab-pane">
                                    <div class="row justify-content-center">
                                        <div class="col-11 mt-5">
                                            <h3 class="mt-0 mb-4 text-center">Escaneie o código QRCODE para efetuar o pagamento</h3>

                                            <form id="form-checkout" action="{{ route('payment.pix') }}" method="post">
                                                @csrf
                                                <div>
                                                    <div>
                                                        <label for="payerFirstName">Nome</label>
                                                        <input id="form-checkout__payerFirstName" name="payerFirstName" type="text">
                                                    </div>
                                                    <div>
                                                        <label for="payerLastName">Sobrenome</label>
                                                        <input id="form-checkout__payerLastName" name="payerLastName" type="text">
                                                    </div>
                                                    <div>
                                                        <label for="email">E-mail</label>
                                                        <input id="form-checkout__email" name="email" type="text">
                                                    </div>
                                                    <div>
                                                        <label for="identificationType">Tipo de documento</label>
                                                        <select id="form-checkout__identificationTypePix" name="identificationType" type="text"></select>
                                                    </div>
                                                    <div>
                                                        <label for="identificationNumber">Número do documento</label>
                                                        <input id="form-checkout__identificationNumber" name="identificationNumber" type="text">
                                                    </div>
                                                </div>

                                                <div>
                                                    <div>
                                                        <input id="paymentMethodId" name="paymentMethodId" type="hidden" value="pix">
                                                        <input id="transactionAmount" name="transactionAmount" type="hidden" value="{{ $plano->valor }}">
                                                        <input id="description" name="description" type="hidden" value="{{ $plano->titulo }}">
                                                        <input id="tokenPlano" name="tokenPlano" type="hidden" value="{{ $plano->token }}">
                                                        <input id="token" name="token" type="hidden">

                                                        <br>
                                                        <button type="submit">Gerar QR Code</button>
                                                    </div>
                                                </div>
                                            </form>

                                            <!--  -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @else
                    <div class="row">
                        <div class="col-12 mt-3 text-center">
                            <p>Nenhum plano selecionado.</p>
                        </div>
                    </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
    </div>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>
    <script type='text/javascript'>
        $(document).ready(function() {
            //Menu Toggle Script
            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });

            // For highlighting activated tabs
            $("#tab1").click(function() {
                $(".tabs").removeClass("active1");
                $(".tabs").addClass("bg-light");
                $("#tab1").addClass("active1");
                $("#tab1").removeClass("bg-light");
            });
            $("#tab2").click(function() {
                $(".tabs").removeClass("active1");
                $(".tabs").addClass("bg-light");
                $("#tab2").addClass("active1");
                $("#tab2").removeClass("bg-light");
            });

        })
    </script>
    <script type='text/javascript'>
        var myLink = document.querySelector('a[href="#"]');
        myLink.addEventListener('click', function(e) {
            e.preventDefault();
        });
    </script>

    <script src="{{ asset('assets/vendors/mercadopago/js/v2.js') }}"></script>

    <script>
        const mp = new MercadoPago("TEST-8195c897-c48e-408b-985b-a2998d117d58");


        /** inicialização do cartão */
        const cardNumberElement = mp.fields.create('cardNumber', {
            placeholder: "",
            style: {
                "padding": "10px 15px 5px 15px",
                "border": "none",
                "border": "1px solid lightgrey",
                "border-radius": "6px",
                "margin-bottom": "25px",
                "margin-top": "2px",
                "width": "100%",
                "boxsizing": "border-box",
                "font-family": "arial",
                "color": " #2C3E50",
                "font-size": "14px",
                "letter-spacing": "1px"
            }
        }).mount('form-checkout__cardNumber');
        const expirationDateElement = mp.fields.create('expirationDate', {
            placeholder: "MM/YY",
        }).mount('form-checkout__expirationDate');
        const securityCodeElement = mp.fields.create('securityCode', {
            placeholder: "Código de segurança"
        }).mount('form-checkout__securityCode');

        /** inicialização do tipo de documento */

        (async function getIdentificationTypes() {
            try {
                const identificationTypes = await mp.getIdentificationTypes();
                const identificationTypeElement = document.getElementById('form-checkout__identificationType');

                createSelectOptions(identificationTypeElement, identificationTypes);
            } catch (e) {
                return console.error('Error getting identificationTypes: ', e);
            }
        })();

        function createSelectOptions(elem, options, labelsAndKeys = {
            label: "name",
            value: "id"
        }) {
            const {
                label,
                value
            } = labelsAndKeys;

            elem.options.length = 0;

            const tempOptions = document.createDocumentFragment();

            options.forEach(option => {
                const optValue = option[value];
                const optLabel = option[label];

                const opt = document.createElement('option');
                opt.value = optValue;
                opt.textContent = optLabel;

                tempOptions.appendChild(opt);
            });

            elem.appendChild(tempOptions);
        }

        /** inicialização do método de pagamento */

        const paymentMethodElement = document.getElementById('paymentMethodId');
        const issuerElement = document.getElementById('form-checkout__issuer');
        const installmentsElement = document.getElementById('form-checkout__installments');

        const issuerPlaceholder = "Banco emissor";
        const installmentsPlaceholder = "Parcelas";

        let currentBin;
        cardNumberElement.on('binChange', async (data) => {
            const {
                bin
            } = data;
            try {
                if (!bin && paymentMethodElement.value) {
                    clearSelectsAndSetPlaceholders();
                    paymentMethodElement.value = "";
                }

                if (bin && bin !== currentBin) {
                    const {
                        results
                    } = await mp.getPaymentMethods({
                        bin
                    });
                    const paymentMethod = results[0];

                    paymentMethodElement.value = paymentMethod.id;
                    updatePCIFieldsSettings(paymentMethod);
                    updateIssuer(paymentMethod, bin);
                    updateInstallments(paymentMethod, bin);
                }

                currentBin = bin;
            } catch (e) {
                console.error('error getting payment methods: ', e)
            }
        });

        function clearSelectsAndSetPlaceholders() {
            clearHTMLSelectChildrenFrom(issuerElement);
            createSelectElementPlaceholder(issuerElement, issuerPlaceholder);

            clearHTMLSelectChildrenFrom(installmentsElement);
            createSelectElementPlaceholder(installmentsElement, installmentsPlaceholder);
        }

        function clearHTMLSelectChildrenFrom(element) {
            const currOptions = [...element.children];
            currOptions.forEach(child => child.remove());
        }

        function createSelectElementPlaceholder(element, placeholder) {
            const optionElement = document.createElement('option');
            optionElement.textContent = placeholder;
            optionElement.setAttribute('selected', "");
            optionElement.setAttribute('disabled', "");

            element.appendChild(optionElement);
        }

        // Esta etapa melhora as validações cardNumber e securityCode
        function updatePCIFieldsSettings(paymentMethod) {
            const {
                settings
            } = paymentMethod;

            const cardNumberSettings = settings[0].card_number;
            cardNumberElement.update({
                settings: cardNumberSettings
            });

            const securityCodeSettings = settings[0].security_code;
            securityCodeElement.update({
                settings: securityCodeSettings
            });


        }


        async function updateIssuer(paymentMethod, bin) {
            const {
                additional_info_needed,
                issuer
            } = paymentMethod;
            let issuerOptions = [issuer];

            if (additional_info_needed.includes('issuer_id')) {
                issuerOptions = await getIssuers(paymentMethod, bin);
            }

            createSelectOptions(issuerElement, issuerOptions);
        }

        async function getIssuers(paymentMethod, bin) {
            try {
                const {
                    id: paymentMethodId
                } = paymentMethod;
                return await mp.getIssuers({
                    paymentMethodId,
                    bin
                });
            } catch (e) {
                console.error('error getting issuers: ', e)
            }
        };


        async function updateInstallments(paymentMethod, bin) {
            try {
                const installments = await mp.getInstallments({
                    amount: document.getElementById('transactionAmount').value,
                    bin,
                    paymentTypeId: 'credit_card'
                });
                const installmentOptions = installments[0].payer_costs;
                const installmentOptionsKeys = {
                    label: 'recommended_message',
                    value: 'installments'
                };
                createSelectOptions(installmentsElement, installmentOptions, installmentOptionsKeys);
            } catch (error) {
                console.error('error getting installments: ', e)
            }
        }


        const formElement = document.getElementById('form-checkout');
        formElement.addEventListener('submit', createCardToken);

        async function createCardToken(event) {
            try {
                const tokenElement = document.getElementById('token');
                if (!tokenElement.value) {
                    event.preventDefault();
                    const token = await mp.fields.createCardToken({
                        cardholderName: document.getElementById('form-checkout__cardholderName').value,
                        identificationType: document.getElementById('form-checkout__identificationType').value,
                        identificationNumber: document.getElementById('form-checkout__identificationNumber').value,
                    });
                    tokenElement.value = token.id;
                    formElement.requestSubmit();
                }
            } catch (e) {
                console.error('error creating card token: ', e)
            }
        }
    </script>

    <script>
        (async function getIdentificationTypes() {
            try {
                const identificationTypes = await mp.getIdentificationTypes();
                const identificationTypeElement = document.getElementById('form-checkout__identificationTypePix');

                createSelectOptions(identificationTypeElement, identificationTypes);
            } catch (e) {
                return console.error('Error getting identificationTypes: ', e);
            }
        })();

        $("#form-checkout__cardNumber").change(function() {
            console.log("Card: ", $(this).val())
        })
    </script>


    @vite(['resources/js/app.js'])

</body>

</html>