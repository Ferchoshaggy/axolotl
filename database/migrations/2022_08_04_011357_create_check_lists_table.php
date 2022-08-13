<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_lists', function (Blueprint $table) {
            $table->id();
            $table->string("prueba")->nullable();
            $table->integer("tipo")->nullable();
            $table->string("caracteristicas")->nullable();
            $table->unsignedBigInteger("id_modulo")->nullable();
            $table->unsignedBigInteger("id_sprint")->nullable();
            $table->unsignedBigInteger("id_proyecto")->nullable();
            $table->foreign("id_proyecto")->references("id")->on("proyectos")->onDelete("cascade");
            $table->foreign("id_modulo")->references("id")->on("modulos")->onDelete("cascade");
            $table->foreign("id_sprint")->references("id")->on("sprints")->onDelete("cascade");
            $table->string("funciona")->nullable();
            $table->text("observaciones")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('check_lists');
    }
}
