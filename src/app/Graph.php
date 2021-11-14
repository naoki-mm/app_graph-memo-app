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
    ];

    public function plotData()
    {
        return $this->hasMany('App\PlotData');
    }

    public function axisSetting()
    {
        return $this->hasOne('App\AxisSetting');
    }
}
