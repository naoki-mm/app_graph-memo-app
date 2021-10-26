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
            <image-upload v-on:image-upload='isImageFile = $event'></image-upload>
        @endslot

    @endcomponent
@endsection

@section('footer')

@endsection
