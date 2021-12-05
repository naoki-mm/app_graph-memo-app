<?php

namespace App\Http\Controllers\Graph;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Graph;
use App\Tag;
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

        $user_id = Auth::id();

        // セッション取得
        $tag_name = $request->session()->get('tag_name');
        $favorite_flag =  $request->session()->get('favorite');

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
