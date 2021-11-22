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

class GraphController extends Controller
{
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
        return view('graphs.create');
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

        return redirect('graph')
            ->with('status', 'グラフデータを登録しました。');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
