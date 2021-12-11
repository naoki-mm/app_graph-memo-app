@extends('layouts.app')

@section('title')
    ゴミ箱
@endsection

@section('header')
    @include('sub_views.graphs.header')
@endsection

@section('content')

    @component('components.graphs.main_item')

        @slot('main_content')

            @include('sub_views.graphs.index_base',
                    ['graphs_select' => $graphs,
                    'is_trash' => true,])

        @endslot

    @endcomponent
@endsection

@section('footer')

@endsection
