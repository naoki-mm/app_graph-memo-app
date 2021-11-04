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
            <div v-if="!isImageFile">
                <image-upload
                    v-on:image-upload='isImageFile = $event'
                    v-on:set-canvas='graphImage = $event'>
                </image-upload>
            </div>

            {{--  画像選択 or 画像ドロップ時にcanvasとグラフ読み取りサイドバーを表示  --}}
            <div v-if="isImageFile" class="row no-gutters">

                @include('sub_views.graphs.plot_create')

                <graph-canvas
                    :graph-image='graphImage'
                    :is-active-set-axis-x='isActiveSetAxisX'
                    :is-active-set-axis-y='isActiveSetAxisY'
                    :is-axis-set-canvas='isAxisSetCanvas'
                    :is-plot-canvas='isPlotCanvas'
                    :is-set-save='isSetSave'
                    :x-axis-min-value='xAxisMinValue'
                    :x-axis-max-value='xAxisMaxValue'
                    :y-axis-min-value='yAxisMinValue'
                    :y-axis-max-value='yAxisMaxValue'
                    >
                </graph-canvas>

            </div>
        @endslot

    @endcomponent
@endsection

@section('footer')

@endsection
