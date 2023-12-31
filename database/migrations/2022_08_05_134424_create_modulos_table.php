<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulos', function (Blueprint $table) {
            $table->id();
            $table->integer('modulo_id')->unsigned();
            $table->string('titulo')->nullable();
            $table->integer('posicao')->default('0');
            $table->string('url_amigavel')->nullable();
            $table->string('icone')->nullable();
            $table->set('tipo_de_acao', ['view', 'add', 'edit', 'delete', 'other']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modulos');
    }
};
