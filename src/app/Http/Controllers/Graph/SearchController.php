<?php

namespace App\Http\Controllers\Graph;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Graph;
use App\User;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tagSearch(string $name, Request $request)
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

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function favoriteSearch(Request $request)
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

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sort(string $order, Request $request)
    {
        if (is_null($request->page)) {
            // セッション保存
            $check_sort_session = $request->session()->get('index_order');
            if ($check_sort_session === $order) {
                if ($check_sort_session === 'asc') {
                    $request->session()->put('index_order', 'desc');
                } else if ($check_sort_session === 'desc') {
                    $request->session()->put('index_order', 'asc');
                }
            } else {
                $request->session()->put('index_order', $order);
            }
        }

        // 絞り込み,ソートの結果(paginate有り)を取得
        $graphs = new Graph;
        $graphs_search_sort_result = $graphs->getSearchAndSortResult($request);

        // タグ情報を取得
        $user = new User;
        $all_tags = $user->all_tags;

        return view('graphs.index', ['graphs' => $graphs_search_sort_result, 'all_tags' => $all_tags, 'index_active_flag' => true]);
    }

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
            return redirect('graph')->with('user_error_message', '検索フォームに入力がございません');
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
