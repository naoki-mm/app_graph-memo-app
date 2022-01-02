<?php

namespace App\Http\Controllers\Graph;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Graph;
use App\User;

class TrashController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // セッション削除
        $request->session()->forget('favorite');
        $request->session()->forget('tag_name');
        $request->session()->forget('index_order');

        $user_id = Auth::id();
        $graphs = Graph::onlyTrashed()->where('user_id', $user_id)->latest()->paginate(4);

        $trash_active_flag = true;

        // タグ情報を取得
        $user = new User;
        $all_tags = $user->all_tags;

        return view('graphs.trash_index', compact('graphs', 'trash_active_flag', 'all_tags'));
    }

    /**
     * Handle the incoming request.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $graph = Graph::onlyTrashed()
            ->findOrFail($id);

        $this->authorize('restore', $graph);

        $graph->restore();
        $graph->favorite = 0;
        return redirect()->route('trash.index')
        ->with('status', 'グラフデータを復元しました。');
    }

    /**
     * Handle the incoming request.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $graph = Graph::onlyTrashed()
            ->findOrFail($id);

        $this->authorize('forceDelete', $graph);

        $graph->forceDelete();

        return redirect()->route('trash.index')
        ->with('status', 'グラフデータを完全に削除しました。');
    }
}
