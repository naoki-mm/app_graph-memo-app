<?php

namespace App\Http\Controllers\Graph;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Graph;

class FavoriteUpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Graph $favorite_update
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Graph $graph)
    {
        $graph->favorite = $request->favorite;
        $graph->save();
    }
}
