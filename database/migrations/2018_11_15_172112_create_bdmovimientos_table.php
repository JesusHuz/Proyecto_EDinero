<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBdmovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bdmovimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('tipo',50);
            $table->dateTime('movimiento_dato');
            $table->unsignedInteger('categoria_id');//llave foranea entetrosin signo
            $table->string('descripcion',1000);
            $table->unsignedInteger('money');
            $table->string('image')->nullable();//acepta null
            $table->unsignedInteger('user_id');//llave foranea entetrosin signo
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bdmovimientos');
    }
}
