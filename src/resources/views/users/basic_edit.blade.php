@extends('layouts.app')

@section('title')
    ユーザー基本情報
@endsection

@section('header')
    @include('sub_views.users.header')
@endsection

@section('content')
    @component('components.users.main_item')
        @slot('page_title')

        @endslot

        @slot('form')

        @endslot
    @endcomponent
@endsection

@section('footer')

@endsection

