<?php

namespace App\Http\Controllers\Graph;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ImageFileSave;
use App\Http\Requests\Graph\GraphImageSaveRequest;

class ImageSaveController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Requests\Graph\GraphImageSaveRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function saveGraphImage(GraphImageSaveRequest $request, ImageFileSave $image_file_save)
    {
        // グラフ画像保存
        if ($request->has('graph_image')) {
            $fileName = $image_file_save->saveImage($request->file('graph_image'), false, 'graph_images');
            $request->session()->put('graph_image_name', $fileName);
        }
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Requests\Graph\GraphImageSaveRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function savePlotImage(Request $request, ImageFileSave $image_file_save)
    {
        // グラフ画像保存
        if ($request->has('plot_image')) {
            $fileName = $image_file_save->saveImage($request->file('plot_image'), false, 'plot_images');
            $request->session()->put('plot_image_name', $fileName);
        }
    }
}
