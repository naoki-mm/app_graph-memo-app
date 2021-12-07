<?php

namespace App\Http\Controllers\Graph;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Graph;
use App\Tag;
use App\User;

class IndexSortController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(string $order, Request $request)
    {
        if (is_null($request->page)) {
            // セッション保存
            $request->session()->put('index_order', $order);
        }

        $user_id = Auth::id();

        // セッション取得
        $tag_name = $request->session()->get('tag_name');
        $favorite_flag =  $request->session()->get('favorite');
        $index_order = $request->session()->get('index_order');

        if ($tag_name) {
            // タグの絞り込み結果
            $tag = Tag::where('name', $tag_name)->first();
            $graphs_query = $tag->graphs->where('user_id', $user_id);
        } else {
            // 全てのグラフデータを取得した結果
            $graphs_query = Graph::where('user_id', $user_id)->get();
        }

        if ($favorite_flag) {
            // お気に入りの絞り込み結果
            $graphs_query = $graphs_query->where('favorite', $favorite_flag);
        }

        // ソート機能
        if ($index_order === 'asc') {
            $graphs_query = $graphs_query->sortBy('updated_at');
            // dd($graphs_query);
        } else if ($index_order === 'desc') {
            $graphs_query = $graphs_query->sortByDesc('updated_at');
        }

        // 1ページあたりの表示数
        $perPage = 4;

        // ページネーションの設定
        $graphs_paginate = new LengthAwarePaginator(
            $graphs_query->forPage($request->page, $perPage),
            $graphs_query->count(),
            $perPage,
            $request->page,
            ['path' => $request->url()]
        );

        // タグ情報を取得
        $user = new User;
        $all_tags = $user->all_tags;

        return view('graphs.index', ['graphs' => $graphs_paginate, 'all_tags' => $all_tags]);
    }
}
