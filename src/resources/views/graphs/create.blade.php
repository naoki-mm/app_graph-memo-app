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

            <!-- ファイル選択 or ドロップ時にcanvasを表示 -->
            <div v-if="isImageFile">
                <graph-plot :graph-image='graphImage'></graph-plot>
            </div>
        @endslot

    @endcomponent
@endsection

@section('footer')

@endsection
