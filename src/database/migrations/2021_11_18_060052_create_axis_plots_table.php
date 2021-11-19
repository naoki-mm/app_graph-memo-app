<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAxisPlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('axis_plots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('graph_id');
            $table->foreign('graph_id')->references('id')->on('graphs')->onDelete('cascade');
            // 総桁15の小数点以下10桁
            $table->decimal('x_min_plot_x', 15, 10);
            $table->decimal('x_min_plot_y', 15, 10);
            $table->decimal('x_max_plot_x', 15, 10);
            $table->decimal('x_max_plot_y', 15, 10);
            $table->decimal('y_min_plot_x', 15, 10);
            $table->decimal('y_min_plot_y', 15, 10);
            $table->decimal('y_max_plot_x', 15, 10);
            $table->decimal('y_max_plot_y', 15, 10);
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
        Schema::dropIfExists('axis_plots');
    }
}
