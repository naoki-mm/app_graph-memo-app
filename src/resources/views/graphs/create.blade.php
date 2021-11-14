@extends('layouts.app')

@section('title')
    ホーム
@endsection

@section('header')
    @include('sub_views.graphs.header')
@endsection

@section('content')

    @component('components.graphs.main_item')

        @slot('main_content')

            {{-- フォーム --}}
            <form ref="graphForm" id="graph_form" method="POST" action="{{ route('graph.store') }}" enctype="multipart/form-data">
                @csrf
                <div v-show="!graphImage.isFile">
                    <image-upload
                        ref="imageUpload"
                        v-on:send-file='setFile($event)'
                        v-on:show-image='showImage()'
                        v-on:image-upload='graphImage.isFile = $event'
                        v-on:set-canvas='graphImage.fileName = $event'>
                    </image-upload>

                </div>

                {{--  画像選択 or 画像ドロップ時にcanvasとグラフ読み取りサイドバーを表示  --}}
                <div v-show="graphImage.isFile" class="row no-gutters">

                    @include('sub_views.graphs.plot_create')

                    <graph-canvas
                        ref="graphCanvas"
                        :graph-image='graphImage.fileName'
                        :axis-setting-detect='axisSettingDetect'
                        :show-canvas-event-detect='showCanvasEventDetect'
                        :axis-value='axisValue'

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
