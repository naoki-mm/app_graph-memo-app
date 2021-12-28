@extends('layouts.app')

@section('title')
    グラフ詳細
@endsection

@section('header')
    @include('sub_views.graphs.header')
@endsection

@section('content')

    @component('components.graphs.main_item')

        @slot('main_content')

            {{-- フォーム --}}
            <form ref="graphForm" id="graph_form" method="POST" action="{{ route('graph.update', $graph->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                {{--  画像選択 or 画像ドロップ時にcanvasとグラフ読み取りサイドバーを表示  --}}
                <div v-show="graphImage.isFile" class="row no-gutters">

                    @include('sub_views.graphs.plot_create', ['create_flag' => false])

                    <graph-canvas
                        ref="graphCanvas"
                        :graph-image='graphImage.data'
                        :axis-setting-detect='axisSettingDetect'
                        :show-canvas-event-detect='showCanvasEventDetect'
                        :axis-value='axisValue'

                        :old-graph-data="{{ json_encode(Session::getOldInput()) }}"

                        :initial-graph='@json($graph)'
                        :initial-graph-canvas='@json($graph->canvas)'
                        :initial-axis-value='@json($graph->axisValue)'
                        :initial-axis-plot='@json($graph->axisPlot)'
                        :initial-plot-data='@json($graph->plotData)'

                        :graph-plot-point='graphPlotPoint'
                        v-on:graph-plot='graphPlotPoint = $event'
                        v-on:scroll-text-area='scrollTextArea()'

                        v-on:complete-set-axis-x='axisSettingDetect.isCompleteX = $event'
                        v-on:complete-set-axis-y='axisSettingDetect.isCompleteY = $event'
                        >
                    </graph-canvas>

                </div>
            </form>
        @endslot

    @endcomponent
@endsection

@section('footer')

@endsection
