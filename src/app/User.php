<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // UserモデルからGraphモデルへのアクセス
    public function graphs()
    {
        return $this->hasMany('App\Graph');
    }

    // UserモデルからPlotDataモデルへの直接アクセス
    public function plotData()
    {
        return $this->hasManyThrough('App\PlotData', 'App\Graph');
    }

    // UserモデルからAxisSettingモデルへの直接アクセス
    public function axisValue()
    {
        return $this->hasOneThrough('App\AxisValue', 'App\Graph');
    }

    // UserモデルからAxisSettingモデルへの直接アクセス
    public function axisPlot()
    {
        return $this->hasOneThrough('App\AxisPlot', 'App\Graph');
    }

    // UserモデルからAxisSettingモデルへの直接アクセス
    public function canvas()
    {
        return $this->hasOneThrough('App\Canvas', 'App\Graph');
    }
}
