<?php

namespace App\Http\Controllers\Graph;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Graph;

class DownloadCsvController extends Controller
{
    /**
     * 指定されたプロットデータのCSVをダウンロードする。
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Graph $graph
     * @return Symfony\Component\HttpFoundation\StreamedResponse $response
     */
    public function __invoke(Request $request, Graph $graph)
    {
        $this->authorize('csvDownload', $graph);

        //プロットデータのモデルコレクションを取得
        $plot_data_collection = $graph->plotData->pluck('data');

        // プロットデータのモデルコレクションをarray型に変換
        $plot_data = $plot_data_collection[0];
        // 改行でプロットデータを区切って配列に変換
        $csv_plot_data = explode("\r\n", $plot_data);

        $csv_list = [
            ['x', 'y']
        ];

        foreach ($csv_plot_data as $x_y_value) {
            // プロットデータをカンマで区切って配列にする
            $array_x_y_value = explode(",", $x_y_value);
            // csvリストに配列を追加
            array_push($csv_list, $array_x_y_value);
        }

        $response = new StreamedResponse(function () use ($request, $csv_list) {
            $stream = fopen('php://output', 'w');

            // 文字化け対策
            stream_filter_prepend($stream, 'convert.iconv.utf-8/cp932//TRANSLIT');

            foreach ($csv_list as $value) {
                fputcsv($stream, $value);
            }
            fclose($stream);
        });

        $graph_title = $graph->title;

        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename="'.$graph_title.'.csv'.'"');

        return $response;
    }
}
