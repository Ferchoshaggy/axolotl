<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uxes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_proyecto');
            $table->foreign("id_proyecto")->references("id")->on("proyectos")->onDelete("cascade");
            $table->string('nombre');
            $table->double('clave');
            $table->string('archivo')->nullable();
            $table->string('link')->nullable();
            $table->text('descripcion');
            $table->uuid("uuid")->unique()->index();
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
        Schema::dropIfExists('uxes');
    }
}
