<?php

namespace App\Http\Controllers\Graph;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ImageFileSave;
use App\Http\Requests\Graph\GraphImageSaveRequest;

class ImageSaveController extends Controller
{
    /**
     * グラフ画像をs3に保存して、セッションに画像名を保存する。
     *
     * @param  \Illuminate\Http\Requests\Graph\GraphImageSaveRequest  $request
     */
    public function saveGraphImage(GraphImageSaveRequest $request, ImageFileSave $image_file_save)
    {
        if ($request->has('graph_image')) {
            $fileName = $image_file_save->saveImage($request->file('graph_image'), false, 'graph_images');
            $request->session()->put('graph_image_name', $fileName);
        }
    }

    /**
     *  プロット画像をs3に保存して、セッションに画像名を保存する。
     *
     * @param  \Illuminate\Http\Requests\Graph\GraphImageSaveRequest  $request
     */
    public function savePlotImage(Request $request, ImageFileSave $image_file_save)
    {
        if ($request->has('plot_image')) {
            $fileName = $image_file_save->saveImage($request->file('plot_image'), false, 'plot_images');
            $request->session()->put('plot_image_name', $fileName);
        }
    }
}
