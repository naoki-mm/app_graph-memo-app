<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Canvas extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'graph_id',
        'width',
        'height'
    ];
}
