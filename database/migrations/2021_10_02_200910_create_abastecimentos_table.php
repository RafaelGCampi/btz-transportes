<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbastecimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abastecimentos', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->float('quantidade_abastecida',10,2);
            $table->unsignedBigInteger('tipo_combustivel_id');
            $table->unsignedBigInteger('motorista_id');
            $table->unsignedBigInteger('veiculo_id');
            $table->timestamps();

            $table->foreign('motorista_id')->references('id')->on('motoristas')->onDelete('cascade');
            $table->foreign('veiculo_id')->references('id')->on('veiculos')->onDelete('cascade');
            $table->foreign('tipo_combustivel_id')->references('id')->on('tipo_combustivels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abastecimentos');
    }
}
