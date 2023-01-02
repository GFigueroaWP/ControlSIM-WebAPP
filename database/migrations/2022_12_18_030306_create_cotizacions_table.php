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
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cli_id');
            $table->unsignedBigInteger('pr_id')->nullable();
            $table->string('cot_directorio');
            $table->integer('cot_subtotal');
            $table->integer('cot_total');
            $table->string('cot_estado');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('cli_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('pr_id')->references('id')->on('proyectos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cotizaciones');
    }
};
