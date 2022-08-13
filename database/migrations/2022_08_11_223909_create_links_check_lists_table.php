<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksCheckListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links_check_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_proyecto")->nullable();
            $table->foreign("id_proyecto")->references("id")->on("proyectos")->onDelete("cascade");
            $table->string("estado")->nullable();
            $table->string("contestado")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('links_check_lists');
    }
}
