<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendasStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vendas_status')->insert(
            [
                'status' => 'approved',
                'status_detail' => 'accredited',
                'description' => 'Pronto, seu pagamento foi aprovado! No resumo, você verá receberá a cobraça em sua fatura.'

            ],
            [
                'status' => 'in_process',
                'status_detail' => 'pending_contingency',
                'description' => 'Não se preocupe, em menos de 2 dias úteis informaremos por e-mail se foi creditado.'
            ],

            [
                'status' => 'in_process',
                'status_detail' => 'pending_review_manual',
                'description' => 'Não se preocupe, em menos de 2 dias úteis informaremos por e-mail se foi creditado ou se necessitamos de mais informação.'
            ],


            [
                'status' => 'rejected',
                'status_detail' => 'cc_rejected_bad_filled_card_number',
                'description' => 'Revise o número do cartão.'
            ],
            [
                'status' => 'rejected',
                'status_detail' => 'cc_rejected_bad_filled_date',
                'description' => 'Revise os dados.'
            ],
            [
                'status' => 'rejected',
                'status_detail' => 'cc_rejected_bad_filled_other',
                'description' => 'Revise o código de segurança do cartão.'
            ],
            [
                'status' => 'rejected',
                'status_detail' => 'cc_rejected_bad_filled_security_code',
                'description' => 'Não pudemos processar seu pagamento.'
            ],

            [
                'status' => 'rejected',
                'status_detail' => 'cc_rejected_call_for_authorize',
                'description' => 'Você deve autorizar através de sua instituição bancária.'
            ],
            [
                'status' => 'rejected',
                'status_detail' => 'cc_rejected_card_disabled',
                'description' => ''
            ],
            [
                'status' => 'rejected',
                'status_detail' => 'cc_rejected_card_disabled',
                'description' => 'Ligue para o payment_method_id para ativar seu cartão. O telefone está no verso do seu cartão.'
            ],
            [
                'status' => 'rejected',
                'status_detail' => 'cc_rejected_card_error',
                'description' => 'Não conseguimos processar seu pagamento.'
            ],
            [
                'status' => 'rejected',
                'status_detail' => 'cc_rejected_duplicated_payment',
                'description' => 'Você já efetuou um pagamento com esse valor. Caso precise pagar novamente, utilize outro cartão ou outra forma de pagamento. Seu pagamento foi recusado.'
            ],
            [
                'status' => 'rejected',
                'status_detail' => 'cc_rejected_high_risk',
                'description' => 'Escolha outra forma de pagamento. Recomendamos meios de pagamento em dinheiro.'
            ],
            [
                'status' => 'rejected',
                'status_detail' => 'cc_rejected_insufficient_amount',
                'description' => 'Há uma possibilidade de seu cartão não ter saldo suficinete para esta transação.'
            ],
            [
                'status' => 'rejected',
                'status_detail' => 'cc_rejected_invalid_installments',
                'description' => 'Limite de Parcelas.'
            ],
            [
                'status' => 'rejected',
                'status_detail' => 'cc_rejected_max_attempts',
                'description' => 'Você atingiu o limite de tentativas permitido. Escolha outro cartão ou outra forma de pagamento.'
            ],
            [
                'status' => 'rejected',
                'status_detail' => 'cc_rejected_other_reason',
                'description' => 'Não foi possível processar sua transação.'
            ],
            [
                'status' => 'rejected',
                'status_detail' => 'cc_rejected_card_type_not_allowed',
                'description' => 'O pagamento foi rejeitado porque o usuário não tem a função crédito habilitada em seu cartão multiplo (débito e crédito).'
            ]
        );
    }
}
