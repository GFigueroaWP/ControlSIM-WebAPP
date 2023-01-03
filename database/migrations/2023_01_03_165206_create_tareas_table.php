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
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trabajo_id');
            $table->boolean('tar_estado')->default(false);
            $table->string('tar_descripcion');
            $table->date('tar_completada')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('trabajo_id')->references('id')->on('or_trabajos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tareas');
    }
};
