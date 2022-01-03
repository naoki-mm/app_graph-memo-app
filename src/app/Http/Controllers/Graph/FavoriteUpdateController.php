<?php

namespace App\Http\Controllers\Graph;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Graph;

class FavoriteUpdateController extends Controller
{
    /**
     * お気に入りフラグを保存する。
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Graph $favorite_update
     */
    public function __invoke(Request $request, Graph $graph)
    {
        $graph->favorite = $request->favorite;
        $graph->save();
    }
}
