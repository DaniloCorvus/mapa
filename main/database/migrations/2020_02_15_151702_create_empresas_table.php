<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable()->default('MAPA DE PROCESOS MUNICIPIO DE BARRANCABERMEJA _ ALCALDIA MUNICIPAL');
            $table->string('logo')->nullable();
            $table->string('background')->nullable();
            $table->string('color')->nullable();
            $table->string('otro')->nullable();
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
        Schema::dropIfExists('empresas');
    }
}
