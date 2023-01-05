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
            $table->string('cli_razonsocial');
            $table->string('cli_giro')->nullable();
            $table->string('cli_rut')->unique();
            $table->string('cli_email')->nullable();
            $table->string('cli_telefono')->nullable();
            $table->string('cli_direccion')->nullable();
            $table->string('cli_comuna')->nullable();
            $table->string('cli_ciudad')->nullable();
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
        Schema::dropIfExists('clientes');
    }
};
