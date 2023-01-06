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
        Schema::create('or_trabajos', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('cotizacion_id')->nullable();
            $table->string('ot_estado');
            $table->date('ot_inicio');
            $table->date('ot_limite')->nullable();
            $table->date('ot_completada')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('cotizacion_id')->references('id')->on('cotizaciones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('or_trabajos');
    }
};
