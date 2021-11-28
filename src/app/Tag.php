<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
    ];

    public function graphs()
    {
        return $this->belongsToMany('App\Graph')->withTimestamps();
    }
}
