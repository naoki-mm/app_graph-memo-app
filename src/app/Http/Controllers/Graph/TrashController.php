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
     * ゴミ箱のデータ一覧を取得し、viewを返す。
     * 検索データのセッションを削除する。
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->forget('favorite');
        $request->session()->forget('tag_name');
        $request->session()->forget('index_order');

        $user_id = Auth::id();
        $perPage = \PerPageConst::GRAPH_INDEX;
        $graphs = Graph::onlyTrashed()->where('user_id', $user_id)->latest()->paginate($perPage);

        $trash_active_flag = true;

        $user = new User;
        $all_tags = $user->all_tags;

        return view('graphs.trash_index', compact('graphs', 'trash_active_flag', 'all_tags'));
    }

    /**
     * 指定されたゴミ箱のデータを復元して、ゴミ箱一覧画面へリダイレクトさせる。
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
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
     * 指定されたゴミ箱のデータを物理削除して、ゴミ箱一覧画面へリダイレクトさせる。
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
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
