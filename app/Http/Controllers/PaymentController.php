<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Plano;
use App\Models\Venda;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;

use App\Http\Controllers\PlanoController;


use MercadoPago;


class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Payment $payment, $token)
    {
        $plano = Plano::where('token', $token)->first();
        return view('pages.pagamentos.form', compact('plano'));
    }

    public function proccess(Request $request)
    {

        /** Token Inicial */
        MercadoPago\SDK::setAccessToken(env('PAYMENT_MP_PRIVATE'));
        $plano = Plano::where('token', $request->input('tokenPlano'))->first();

        try {

            /** Inicialização de Pagamento */
            $payment = new MercadoPago\Payment();

            /** Informações do Pagamento */
            $payment->transaction_amount = (float) $request->transactionAmount;;
            $payment->token = $request->token;
            $payment->description = $request->description;
            $payment->installments = (int) $request->installments;

            /** Definição de quem está pagando */
            $payer = new MercadoPago\Payer();
            $payer->email = $request->email;
            $payer->identification = array(
                "type" => $request->identificationType,
                "number" => $request->identificationNumber
            );
            $payment->payer = $payer;

            /** Executa Pagamento */
            $payment->save();


            /** Inicializa requisição */
            $payment_details = new Venda();

            /** Taxa do Mercado Pago */
            if ($payment->installments > 1) {
                $tax = 0;
                foreach ($payment->fee_details as $pay) {
                    if ($pay->type == 'mercadopago_fee') {
                        $tax = $pay->amount; // A taxa de parcelamento é por conta do cliente
                    }
                }
            } else {
                $tax = $payment->fee_details[0]->amount ?? 0;
            }

            /** Pagamento Aprovado */
            if (
                $payment->status == 'approved'
            ) {

                /** Taxa do MP */
                $payment_details['mercadopago_fee'] = $tax;

                /** Taxa do Sistema */
                $payment_details['payment_fee'] = $payment->transaction_amount / 100 * 5.0;

                /** Total de Taxas */
                $payment_details['payment_amount_fee'] = $payment_details['mercadopago_fee'] + $payment_details['payment_fee'];

                /** Total a Receber */
                $payment_details['payment_amount'] = $payment->transaction_amount - $payment_details['payment_amount_fee'];
            }

            /** Pagamento Recusado */
            $statusArr = array("in_process", "rejected");
            if (in_array($payment->status, $statusArr)) {

                switch ($payment->status_detail) {

                    case null:
                        $payment_detail = "Erro Interno";
                        break;

                    case 'cc_rejected_other_reason':
                        $payment_detail = "Não foi possível processar o Pagamento";
                        break;

                    case 'pending_contingency':
                        $payment_detail = "Pagamento pendente";
                        break;

                    case 'cc_rejected_call_for_authorize':
                        $payment_detail = "Recusado com validação para autorizar";
                        break;

                    case 'cc_rejected_insufficient_amount':
                        $payment_detail = "Recusado por saldo insuficiente";
                        break;

                    case 'cc_rejected_bad_filled_security_code':
                        $payment_detail = "Recusado por código de segurança inválido";
                        break;

                    case 'cc_rejected_bad_filled_date':
                        $payment_detail = "Recusado por problema com a data de vencimento";
                        break;

                    case 'cc_rejected_bad_filled_other':
                        $payment_detail = "Erro ao processar";
                        break;
                }

                /** Taxa do MP */
                $payment_details['mercadopago_fee'] = 0.00;

                /** Taxa do Sistema */
                $payment_details['payment_fee'] = 0.00;

                /** Total de Taxas */
                $payment_details['payment_amount_fee'] = 0.00;

                /** Total a Receber */
                $payment_details['payment_amount'] = 0.00;
            }

            if (in_array($payment->status, $statusArr)) {
                $payment_status = ($payment_detail) ?? 'Não foi possível processar seu pagamento. Entre em contato com o suporte para maiores informações';
            } else {
                $payment_status = "Aprovado";
            }

            /** Cartão de Crédito - Expiração e Primeiros/Últimos dígitos */
            $payment_details['expiration_month'] = $payment->card->expiration_month  ?? 0;
            $payment_details['expiration_year'] = $payment->card->expiration_year    ?? 0;
            $payment_details['first_six_digits'] = $payment->card->first_six_digits  ?? 0;
            $payment_details['last_four_digits'] = $payment->card->last_four_digits  ?? 0;

            /** Detalhes */
            $payment_details['status'] = $payment->status;
            $payment_details['status_detail'] = $payment->status_detail;
            $payment_details['payment_method_id'] = $payment->payment_method_id;
            $payment_details['payment_type_id'] = $payment->payment_type_id;
            $payment_details['installments'] = $payment->installments;
            $payment_details['token'] = $payment->token;
            $payment_details['payment_message'] = $payment_status;

            /** Autenticação */
            $payment_details['nsu_processadora'] = $payment->additional_info->nsu_processadora ?? 0;
            $payment_details['authentication_code'] = $payment->additional_info->authentication_code ?? 0;

            /** Configurações Internas */
            $payment_details['user_id'] = Auth::id();
            $payment_details['plano_id'] = $plano->id;
            $payment_details['cardholderName'] = $request->cardholderName;
            $payment_details['identificationNumber'] = $request->identificationNumber;
            $payment_details['identificationType'] = $request->identificationType;
            $payment_details['email'] = $request->email;

            /** Salva registro no banco de dados */
            $payment_details->save();
        } catch (\Illuminate\Database\QueryException $exception) {
            return redirect()->route('payment', $plano->token)->with('fail', 'Erro: ' . $exception->errorInfo[2]);
        }

        return redirect()->route('payment.success', $payment->token)->with('success', 'Parabéns! Seu pagamento foi efetuado com sucesso!');
    }

    public function proccess_pix(Request $request)
    {


        #status: "pending"
        #status_detail: "pending_waiting_transfer"

        #date_of_expiration: "2023-06-24T17:57:21.790-04:00"
        #transaction_amount: 100.0
        #payment_method_id: "pix"
        # "ticket_url": "https://www.mercadopago.com.br/sandbox/payments/1313539048/ticket?caller_id=25396665&hash=1f37be42-86a1-48f5-9678-7fc63243b0fa"


        MercadoPago\SDK::setAccessToken(env('PAYMENT_MP_PRIVATE'));
        $payment = new MercadoPago\Payment();
        $payment->transaction_amount = (float) $request->transactionAmount;;
        $payment->token = $request->token;
        $payment->payment_method_id = "pix";
        $payment->description = $request->description;

        /** Definição de quem está pagando */
        $payment->payer = new MercadoPago\Payer();

        /** Dados do Pagador */
        $payment->payer = array(
            "email" => $request->email,
            "first_name" => $request->payerFirstName,
            "last_name" => $request->payerLastName,
            "identification" => array(
                "type" => $request->identificationType,
                "number" => $request->identificationNumber
            )
        );

        /** Salva Pagamento como Pendente */
        $payment->save();

        /** Gera QrCode para Recebimento */
        $payment_pix = (object) array(
            'qr_code' => $payment->point_of_interaction->transaction_data->qr_code,
            'qr_code_base64' => $payment->point_of_interaction->transaction_data->qr_code_base64,
            'ticket_url' => $payment->point_of_interaction->transaction_data->ticket_url,
            'tokenPlano' => $request->tokenPlano,
            'date_of_expiration' => $payment->date_of_expiration,
            'status' => $payment->status,
            'status_detail' => $payment->status_detail
        );

        /** Mostra QRCODE na View */
        $plano = Plano::where('token', $request->tokenPlano)->first();
        return view('pages.pagamentos.pix', compact('plano', 'payment_pix'));
    }

    public function success(Request $request, $token)
    {
        if (!$token) {
            return redirect()->route('payment.error')->with('fail', 'Token Inválido');
        }

        $payment_detail = Venda::where('token', $token)->first();

        //  dd($payment_detail->plano);


        return view('pages.pagamentos.success', compact('payment_detail'));

    }

    public function payment_error()
    {
        echo "Invalido Token";
    }

}
