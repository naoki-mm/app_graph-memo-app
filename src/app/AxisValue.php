<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AxisValue extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'graph_id',
        'x_min_value',
        'x_max_value',
        'y_min_value',
        'y_max_value',
    ];
}
