<?php

namespace App\Http\Controllers\Graph;

use App\Http\Controllers\Controller;
use App\Services\ImageFileSave;
use App\Http\Requests\Graph\GraphImageSaveRequest;

class GraphImageSaveController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Requests\Graph\GraphImageSaveRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(GraphImageSaveRequest $request, ImageFileSave $image_file_save)
    {
        // グラフ画像保存
        if ($request->has('graph_image')) {
            $fileName = $image_file_save->saveImage($request->file('graph_image'), false, 'graph_images');
            $request->session()->put('graph_image_name', $fileName);
        }
    }
}
