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
        Schema::create('especialista_assuntos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo')->nullable();
            $table->enum('situacao', ['Ativo', 'Inativo'])->default('Ativo');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('especialista_assunto');
    }
};
