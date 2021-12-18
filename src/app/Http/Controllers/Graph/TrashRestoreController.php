<?php

namespace App\Http\Controllers\Graph;

use App\Http\Controllers\Controller;
use App\Graph;

class TrashRestoreController extends Controller
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

        $this->authorize('forceDelete', $graph);

        $graph->restore();
        $graph->favorite = 0;
        return redirect()->route('trash.index')
            ->with('status', 'グラフデータを復元しました。');
    }
}
