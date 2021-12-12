<?php

namespace App\Http\Controllers\Graph;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Graph;
use App\User;

class FavoriteSearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if (is_null($request->page)) {
            if ($request->session()->has('favorite')) {
                // セッション削除
                $request->session()->forget('favorite');
            } else {
                // セッション保存
                $request->session()->put('favorite', 1);
            }
        }

        if (!$request->session()->has('index_order')) {
            $request->session()->put('index_order', 'desc');
        }

        // 絞り込み,ソートの結果(paginate有り)を取得
        $graphs = new Graph;
        $graphs_search_sort_result = $graphs->getSearchAndSortResult($request);

        // タグ情報を取得
        $user = new User;
        $all_tags = $user->all_tags;

        return view('graphs.index', ['graphs' => $graphs_search_sort_result, 'all_tags' => $all_tags, 'index_active_flag' => true]);
    }
}
