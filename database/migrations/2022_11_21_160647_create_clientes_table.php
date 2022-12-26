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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('cli_nombre');
            $table->string('cli_razonsocial');
            $table->string('cli_giro');
            $table->string('cli_rut')->unique();
            $table->string('cli_email');
            $table->string('cli_telefono');
            $table->string('cli_direccion');
            $table->string('cli_comuna');
            $table->string('cli_region');
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
        Schema::dropIfExists('clientes');
    }
};
