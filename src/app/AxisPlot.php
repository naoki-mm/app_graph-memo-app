<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AxisPlot extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'graph_id',
        'x_min_plot_x',
        'x_min_plot_y',
        'x_max_plot_x',
        'x_max_plot_y',
        'y_min_plot_x',
        'y_min_plot_y',
        'y_max_plot_x',
        'y_max_plot_y',
    ];
}
