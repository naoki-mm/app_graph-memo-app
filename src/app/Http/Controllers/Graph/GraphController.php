<?php

namespace App\Http\Controllers\Graph;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ImageFileSave;
use App\Graph;
use App\AxisSetting;
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
        return view('graphs.index');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Graph $graph, ImageFileSave $image_file_save)
    {
        $graph->user_id = Auth::id();
        $graph->title = $request->input('title');
        $graph->memo = $request->input('memo');

        if ($request->has('graph_image')) {
            $fileName = $image_file_save->saveImage($request->file('graph_image'), false, 'graph_images');
            $graph->image_name = $fileName;
        }

        $graph->save();

        $axis_setting = new AxisSetting;
        $axis_setting->graph_id = $graph->id;
        $axis_setting->fill($request->all());
        $axis_setting->save();

        $plot_data = new PlotData;
        $plot_data->graph_id = $graph->id;
        $plot_data->fill($request->all());
        $plot_data->save();

        return redirect('graph');
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
