<?php

namespace App\Http\Controllers\Graph;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Graph\GraphRequest;
use Illuminate\Support\Facades\Auth;
use App\Graph;
use App\AxisPlot;
use App\AxisValue;
use App\Canvas;
use App\PlotData;
use App\Tag;

class GraphController extends Controller
{
    public function __construct()
    {
        // "edit"と"update"メソッドにおいて, Policyクラスにて定義した認可機能を適用
        $this->authorizeResource(Graph::class, 'graph');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $graphs = Graph::where('user_id', $user_id)->latest()->paginate(4);
        return view('graphs.index', compact('graphs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // タグ情報を取得
        $allTags = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('graphs.create', [
            'allTags' => $allTags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Graph\GraphRequest $request
     * @param  \App\Graph $graph
     * @param  App\Services\ImageFileSave $image_file_save
     * @return \Illuminate\Http\Response
     */
    public function store(GraphRequest $request, Graph $graph)
    {
        // グラフ情報保存処理
        $graph->user_id = Auth::id();
        $graph->title = $request->input('title');
        $graph->memo = $request->input('memo');

        // session取得後に削除
        $graph_image_name = $request->session()->pull('graph_image_name');
        $graph->image_name = $graph_image_name;
        $graph->save();

        // グラフプロットデータ保存処理
        $plot_data = new PlotData;
        $plot_data->graph_id = $graph->id;
        $plot_data->fill($request->all())->save();

        // 軸設定プロットデータ保存処理
        $axis_plot = new AxisPlot;
        $axis_plot->graph_id = $graph->id;
        $axis_plot->fill($request->all())->save();

        // 軸設定値の保存処理
        $axis_value = new AxisValue;
        $axis_value->graph_id = $graph->id;
        $axis_value->fill($request->all())->save();

        // canvasデータ保存処理
        $canvas = new Canvas;
        $canvas->graph_id = $graph->id;
        $canvas->fill($request->all())->save();

        // タグデータの保存(DBに存在しなければ)とグラフデータとの紐付け
        $request->tags->each(function ($tagName) use ($graph) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $graph->tags()->attach($tag);
        });

        return redirect('graph')
            ->with('status', 'グラフデータを登録しました。');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Graph $graph
     * @return \Illuminate\Http\Response
     */
    public function edit(Graph $graph)
    {
        $tags = $graph->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });

        // タグ情報を取得
        $allTags = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('graphs.edit', compact('graph', 'tags', 'allTags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Graph\GraphRequest $request
     * @param  \App\Graph $graph
     * @return \Illuminate\Http\Response
     */
    public function update(GraphRequest $request, Graph $graph)
    {
        // グラフ情報保存処理
        $graph->title = $request->input('title');
        $graph->memo = $request->input('memo');
        $graph->save();

        // グラフプロットデータ保存処理
        $graph_plot_data = PlotData::where('graph_id', $graph->id)->first();
        $graph_plot_data->fill($request->all())->save();

        // 軸設定プロットデータ保存処理
        $graph_axis_plot = AxisPlot::where('graph_id', $graph->id)->first();
        $graph_axis_plot->fill($request->all())->save();

        // 軸設定値の保存処理
        $graph_axis_value = AxisValue::where('graph_id', $graph->id)->first();
        $graph_axis_value->fill($request->all())->save();

        // canvasデータ保存処理
        $graph_canvas = Canvas::where('graph_id', $graph->id)->first();
        $graph_canvas->fill($request->all())->save();

        // タグ更新処理
        $graph->tags()->detach();
        $request->tags->each(function ($tagName) use ($graph) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $graph->tags()->attach($tag);
        });

        return redirect()->route('graph.edit', [$graph->id])
        ->with('status', 'グラフデータを変更しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Graph $graph
     * @return \Illuminate\Http\Response
     */
    public function destroy(Graph $graph)
    {
        $graph->delete();
        return redirect('graph')
            ->with('status', 'グラフデータを削除しました。');
    }
}
