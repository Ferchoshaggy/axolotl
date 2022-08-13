<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDinamicoEgresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dinamico_egresos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_presupuesto');
            $table->foreign("id_presupuesto")->references("id")->on("presupuestos")->onDelete("cascade");
            $table->float('egreso');
            $table->text('concepto');
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
        Schema::dropIfExists('dinamico_egresos');
    }
}
