<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCanvasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canvases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('graph_id');
            $table->foreign('graph_id')->references('id')->on('graphs')->onDelete('cascade');
            $table->integer('width');
            $table->integer('height');
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
        Schema::dropIfExists('canvases');
    }
}
