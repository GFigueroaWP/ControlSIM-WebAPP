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
        Schema::create('asignado', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trabajo_id');
            $table->unsignedBigInteger('tecnico_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('trabajo_id')->references('id')->on('or_trabajos')->onDelete('cascade');
            $table->foreign('tecnico_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignado');
    }
};
