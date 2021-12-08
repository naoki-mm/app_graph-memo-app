<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class paginateGraphs
{
    /**
     * ページネーションを設定
     *
     * @param \Illuminate\Http\Request  $request
     * @param Illuminate\Database\Eloquent\Collection $graphs_query
     * @return Illuminate\Pagination\LengthAwarePaginator $graphs_paginate_result
     */
    public function paginateGraphs(Request $request, Collection $graphs_query): LengthAwarePaginator
    {
        // 1ページあたりの表示数
        $perPage = 4;

        // ページネーションの設定
        $graphs_paginate_result = new LengthAwarePaginator(
            $graphs_query->forPage($request->page, $perPage),
            $graphs_query->count(),
            $perPage,
            $request->page,
            ['path' => $request->url()]
        );

        return $graphs_paginate_result;
    }
}
