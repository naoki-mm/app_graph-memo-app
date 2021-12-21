<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Services\PaginateGraphs;
use Illuminate\Http\Request;

class Graph extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'memo',
        'image_name',
        'favorite'
    ];

    public function plotData()
    {
        return $this->hasMany('App\PlotData');
    }

    public function axisValue()
    {
        return $this->hasOne('App\AxisValue');
    }

    public function axisPlot()
    {
        return $this->hasOne('App\AxisPlot');
    }

    public function canvas()
    {
        return $this->hasOne('App\Canvas');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    // タグ、お気に入り検索、ソートの結果を取得
    public function getSearchAndSortResult(Request $request)
    {
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
            $graphs_query = self::where('user_id', $user_id)->get();
        }

        if ($favorite_flag) {
            // お気に入りの絞り込み結果
            $graphs_query = $graphs_query->where('favorite', $favorite_flag);
        }

        // ソート機能
        if ($index_order === 'asc') {
            $graphs_query = $graphs_query->sortBy('updated_at');

        } else if ($index_order === 'desc') {
            $graphs_query = $graphs_query->sortByDesc('updated_at');
        }

        // ぺージネーションを設定
        $paginate = new PaginateGraphs;
        $graphs_paginate_result = $paginate->paginateGraphs($request, $graphs_query);

        return $graphs_paginate_result;
    }

    // キーワード検索の結果を取得
    public function getKeywordSearchResult(Request $request, $search_keyword)
    {
        // セッション削除
        $request->session()->forget('favorite');
        $request->session()->forget('tag_name');

        // セッション保存
        $request->session()->put('index_order', 'desc');

        $user_id = Auth::id();

        // クエリビルダ
        $query = self::where('user_id', $user_id);

        // 全角スペースを半角に変換
        $spaceConversion = mb_convert_kana($search_keyword, 's');

        // 単語を半角スペースで区切り、配列にする
        $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);

        // グラフタイトル、グラフメモと部分一致するものがあるか確認
        foreach($wordArraySearched as $value) {
            $query->where('title', 'like', '%'.$value.'%')
                ->orWhere('memo', 'like', '%' .$value.'%');
        }
        // 1ページあたりの表示数
        $perPage = 12;

        $graphs = $query->orderBy('updated_at', 'desc')->paginate($perPage);

        return $graphs;
    }
}
