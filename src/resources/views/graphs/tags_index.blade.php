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

            @include('sub_views.graphs.index_base',
                    ['graphs_select' => $tag->graphs,
                    'is_trash' => false])

        @endslot

    @endcomponent
@endsection

@section('footer')

@endsection
