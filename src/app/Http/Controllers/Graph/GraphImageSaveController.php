<?php

namespace App\Http\Controllers\Graph;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ImageFileSave;

class GraphImageSaveController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, ImageFileSave $image_file_save)
    {
        // グラフ画像保存
        if ($request->has('graph_image')) {
            $fileName = $image_file_save->saveImage($request->file('graph_image'), false, 'graph_images');
            $request->session()->put('graph_image_name', $fileName);
        }
    }
}
