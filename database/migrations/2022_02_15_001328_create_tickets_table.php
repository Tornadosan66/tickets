<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('responsable_id');
            $table->unsignedBigInteger('solicitante_id');
            $table->unsignedBigInteger('tarea_id')->default(0);
            $table->date('fecha_envio');
            $table->integer('status_id')->default(1);
            $table->string('tiempo_realizar');
            $table->date('fecha_completada')->nullable();
            $table->integer('prioridad')->nullable();
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
        Schema::dropIfExists('tickets');
    }
}
