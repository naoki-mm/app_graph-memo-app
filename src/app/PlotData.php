<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlotData extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'graph_id',
        'data',
        'plot_image_name'
    ];
}
