<?php

namespace App\Http\Controllers\Graph;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Graph;
use App\User;

class KeywordSearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // 検索フォームで入力された値を取得する
        $search_keyword = $request->input('keyword_search');

        if (is_null($search_keyword)) {
            return redirect('graph');
        }

        // キーワード検索結果(ペジネート)を取得
        $graphs = new Graph;
        $graphs = $graphs->getKeywordSearchResult($request, $search_keyword);

        // タグ情報を取得
        $user = new User;
        $all_tags = $user->all_tags;

        $index_active_flag = true;

        return view('graphs.index', compact('graphs', 'all_tags', 'index_active_flag', 'search_keyword'));
    }
}
