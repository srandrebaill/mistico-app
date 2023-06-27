<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('plano_id');
            $table->foreign('plano_id')->references('id')->on('planos');

            $table->enum('type_payment', ['credit_card', 'pix'])->default('credit_card');
            $table->decimal('mercadopago_fee', 8, 2)->nullable();
            $table->decimal('payment_fee', 8, 2)->nullable();
            $table->decimal('payment_amount_fee', 8, 2)->nullable();
            $table->decimal('payment_amount', 8, 2)->nullable();
            $table->integer('expiration_month')->unsigned()->nullable();
            $table->integer('expiration_year')->unsigned()->nullable();
            $table->integer('first_six_digits')->unsigned()->nullable();
            $table->integer('last_four_digits')->unsigned()->last_four_digits();
            $table->integer('installments')->unsigned()->nullable();
            $table->string('status_detail')->nullable();
            $table->string('payment_method_id')->nullable();
            $table->string('payment_type_id')->nullable();
            $table->string('token')->nullable();
            $table->string('payment_message')->nullable();
            $table->string('nsu_processadora')->nullable();
            $table->string('authentication_code')->nullable();
            $table->string('cardholderName')->nullable();
            $table->string('identificationNumber')->nullable();
            $table->enum('identificationType', ['cpf', 'cnpj'])->default('cpf');
            $table->string('email')->nullable();
            $table->string('telefone_whatsapp')->nullable();
            $table->enum('status', ['approved', 'in_process', 'rejected'])->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendas');
    }
};
