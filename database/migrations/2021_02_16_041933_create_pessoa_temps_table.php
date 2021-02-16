<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoaTempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoa_temps', function (Blueprint $table) {
            $table->id();
            $table->text("nome");
            $table->text("cpf");
            $table->text("rg");
            $table->text("nis");
            $table->char("sexo");
            $table->text("renda")->nullable();
            $table->text("dt_nascimento");
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
        Schema::dropIfExists('pessoa_temps');
    }
}
