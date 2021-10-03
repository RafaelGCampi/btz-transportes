<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVeiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veiculos', function (Blueprint $table) {
            $table->id();
            $table->string('placa',7)->unique();
            $table->string('nome',150);
            $table->unsignedBigInteger('tipo_combustivel_id');
            $table->string('fabricante',80);
            $table->string('ano_fabricacao',4);
            $table->float('capacidade_tanque',10,2);
            $table->text('observacoes')->nullable();
            $table->foreign('tipo_combustivel_id')->references('id')->on('tipo_combustivels')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('veiculos');
    }
}
