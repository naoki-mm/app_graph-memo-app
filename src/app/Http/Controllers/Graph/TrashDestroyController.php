<?php

namespace App\Http\Controllers\Graph;

use App\Http\Controllers\Controller;
use App\Graph;

class TrashDestroyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
        $graph = Graph::onlyTrashed()
            ->findOrFail($id);
        $graph->forceDelete();
        return redirect()->route('trash.index')
            ->with('status', 'グラフデータを完全に削除しました。');
    }
}
