<?php

namespace App\Http\Controllers\Graph;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Graph;
use App\User;

class TagSearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(string $name, Request $request)
    {
        $current_tag_name = $request->session()->get('tag_name');

        if (is_null($request->page)) {
            if ($current_tag_name === $name) {
                // セッション削除
                $request->session()->forget('tag_name');
            } else {
                // セッション保存
                $request->session()->put('tag_name', $name);
            }
        }

        // 絞り込み,ソートの結果(paginate有り)を取得
        $graphs = new Graph;
        $graphs_search_sort_result = $graphs->getSearchAndSortResult($request);

        // タグ情報を取得
        $user = new User;
        $all_tags = $user->all_tags;

        return view('graphs.index', ['graphs' => $graphs_search_sort_result, 'all_tags' => $all_tags]);
    }
}
