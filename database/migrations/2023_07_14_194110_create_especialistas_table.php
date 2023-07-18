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
        Schema::create('especialistas', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->nullable();
            $table->date('data_de_nascimento')->nullable();
            $table->string('cep')->nullable();
            $table->string('endereco')->nullable();
            $table->string('estado')->nullable();
            $table->string('cidade')->nullable();
            $table->string('celular')->nullable();
            $table->string('email')->nullable();
            $table->string('cpf')->nullable();
            $table->json('especialidades')->nullable();
            $table->json('disponibilidades')->nullable();
            $table->json('assuntos')->nullable();
            $table->string('formacao_titulo')->nullable();
            $table->string('formacao_universidade')->nullable();
            $table->longText('sobre')->nullable();
            $table->string('imagem')->nullable();
            $table->enum('status', ['Ativo', 'Inativo']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('especialistas');
    }
};
