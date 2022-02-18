<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_area');
            $table->unsignedBigInteger('id_plantel');
            $table->unsignedBigInteger('id_supervisor_area');
            $table->text('descripcion')->nullable();
            $table->foreign('id_plantel')->references('id')->on('planteles')->onDelete('cascade');
            $table->foreign('id_supervisor_area')->references('id')->on('users');
            $table->timestamps();
            //$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('areas');
    }
}
