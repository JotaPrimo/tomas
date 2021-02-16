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
            $table->bigInteger("nome");
            $table->string("cpf", 14)->unique();
            $table->string("rg", 14)->unique();
            $table->string("nis", 14)->unique();
            $table->integer("sexo");
            $table->float("renda", 10, 2)->nullable();
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
