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
    public function axisSetting()
    {
        return $this->hasOneThrough('App\AxisSetting', 'App\Graph');
    }
}
