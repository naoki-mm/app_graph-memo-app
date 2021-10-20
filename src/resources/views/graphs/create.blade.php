@extends('layouts.app')

@section('title')
    ホーム
@endsection

@section('header')
    @include('sub_views.graphs.header')
@endsection

@section('content')

    @component('components.graphs.main_item')

        @slot('page_title')
        @endslot


        @slot('form')
        @endslot

    @endcomponent
@endsection

@section('footer')

@endsection
