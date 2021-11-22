@extends('layouts.app')

@section('title')
    新規登録
@endsection

@section('header')
    @include('sub_views.graphs.header')
@endsection

@section('content')

    @component('components.graphs.main_item')

        @slot('main_content')

            {{-- フォーム --}}
                <div v-show="!graphImage.isFile">
                    <image-upload
                        ref="imageUpload"
                        v-on:call-set-canvas='callSetCanvas()'
                        v-on:image-upload='graphImage.isFile = $event'
                        v-on:set-image='graphImage.data = $event'
                        graph-image-endpoint="{{ route('graph.image.save') }}"
                        >
                    </image-upload>

                </div>

                {{--  画像選択 or 画像ドロップ時にcanvasとグラフ読み取りサイドバーを表示  --}}
            <form ref="graphForm" id="graph_form" method="POST" action="{{ route('graph.store') }}" enctype="multipart/form-data">
                @csrf

                <div v-show="graphImage.isFile" class="row no-gutters">

                    @include('sub_views.graphs.plot_create')

                    <graph-canvas
                        ref="graphCanvas"
                        :graph-image='graphImage.data'
                        :axis-setting-detect='axisSettingDetect'
                        :show-canvas-event-detect='showCanvasEventDetect'
                        :axis-value='axisValue'

                        :old-graph-data="{{ json_encode(Session::getOldInput()) }}"


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
