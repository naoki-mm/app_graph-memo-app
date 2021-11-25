<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Graph extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'memo',
        'image_name',
        'favorite'
    ];

    public function plotData()
    {
        return $this->hasMany('App\PlotData');
    }

    public function axisValue()
    {
        return $this->hasOne('App\AxisValue');
    }

    public function axisPlot()
    {
        return $this->hasOne('App\AxisPlot');
    }

    public function canvas()
    {
        return $this->hasOne('App\Canvas');
    }
}
