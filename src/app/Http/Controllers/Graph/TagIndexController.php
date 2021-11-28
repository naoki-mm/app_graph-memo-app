<?php

namespace App\Http\Controllers\Graph;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tag;

class TagIndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(string $name)
    {
        $tag = Tag::where('name', $name)->first();

        // タグ情報を取得
        $all_tags = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('graphs.tags_index', compact('tag', 'all_tags'));
    }
}
