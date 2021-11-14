<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlotDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plot_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('graph_id');
            $table->foreign('graph_id')->references('id')->on('graphs')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->text('data');
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
        Schema::dropIfExists('plot_data');
    }
}
