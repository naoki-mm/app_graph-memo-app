<?php

namespace App\Http\Controllers\Graph;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Graph;
use App\User;

class SearchController extends Controller
{
    /**
     * 保存済みのセッションと検索対象のタグの名前が一致する場合は、セッションを削除する
     * 絞り込み条件のセッションを保存する。
     * ルートパラメータのタグの名前とセッションに保存されている検索・ソートとのAND条件で、グラフを取得してviewを返す。
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $name
     * @return \Illuminate\Http\Response
     */
    public function tagSearch(string $name, Request $request)
    {
        $current_tag_name = $request->session()->get('tag_name');

        if (is_null($request->page)) {
            if ($current_tag_name === $name) {
                $request->session()->forget('tag_name');
            } else {
                $request->session()->put('tag_name', $name);
            }
        }

        if (!$request->session()->has('index_order')) {
            $request->session()->put('index_order', 'desc');
        }

        $graphs = new Graph;
        $graphs_search_sort_result = $graphs->getSearchSortResult($request);

        $user = new User;
        $all_tags = $user->all_tags;

        return view('graphs.index', ['graphs' => $graphs_search_sort_result, 'all_tags' => $all_tags, 'index_active_flag' => true]);
    }

    /**
     * お気に入りフラグのセッションが保存されていなければ、セッション保存する。
     * お気に入りフラグのセッションが保存されていれば、セッションを削除する。
     * お気に入りフラグとセッションに保存されている検索・ソートとのAND条件で、グラフを取得してviewを返す。
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function favoriteSearch(Request $request)
    {
        if (is_null($request->page)) {
            if ($request->session()->has('favorite')) {
                $request->session()->forget('favorite');
            } else {
                $request->session()->put('favorite', 1);
            }
        }

        if (!$request->session()->has('index_order')) {
            $request->session()->put('index_order', 'desc');
        }

        $graphs = new Graph;
        $graphs_search_sort_result = $graphs->getSearchSortResult($request);

        $user = new User;
        $all_tags = $user->all_tags;

        return view('graphs.index', ['graphs' => $graphs_search_sort_result, 'all_tags' => $all_tags, 'index_active_flag' => true]);
    }

    /**
     * index_orderセッションにdescの値が保存されていれば、ascの値を保存する。
     * index_orderセッションにascの値が保存されていれば、descの値を保存する。
     * ソートとセッションに保存されている検索条件で、グラフを取得してviewを返す。
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $order
     * @return \Illuminate\Http\Response
     */
    public function sort(string $order, Request $request)
    {
        if (is_null($request->page)) {
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

        $graphs = new Graph;
        $graphs_search_sort_result = $graphs->getSearchSortResult($request);

        $user = new User;
        $all_tags = $user->all_tags;

        return view('graphs.index', ['graphs' => $graphs_search_sort_result, 'all_tags' => $all_tags, 'index_active_flag' => true]);
    }

    /**
     * 検索フォームで入力された値がなければ、エラーメッセージを保持して一覧画面にリダイレクトする。
     * 検索フォームに入力された値でOR検索して、グラフデータを取得して、viewを返す。
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function keywordSearch(Request $request)
    {
        $search_keyword = $request->input('keyword_search');

        if (is_null($search_keyword)) {
            return redirect('graph')->with('user_error_message', '検索フォームに入力がございません');
        }

        $graphs = new Graph;
        $graphs = $graphs->getKeywordSearchResult($request, $search_keyword);

        $user = new User;
        $all_tags = $user->all_tags;

        $index_active_flag = true;

        return view('graphs.index', compact('graphs', 'all_tags', 'index_active_flag', 'search_keyword'));
    }
}
