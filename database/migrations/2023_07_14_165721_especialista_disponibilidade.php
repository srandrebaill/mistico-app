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
        //
        Schema::create('especialista_disponibilidade', function (Blueprint $table) {
            $table->id();
            $table->string('diadasemana')->nullable();
            $table->string('horario')->default('08:00 as 18:00');
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
        //

    }
};
