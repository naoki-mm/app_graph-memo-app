@extends('layouts.app')

@section('title')
    ユーザー基本情報
@endsection

@section('content')
    @include('layouts.sub_views.user_layout')
    @component('components.users.main_item')
        @slot('page_title')

        @endslot

        @slot('form')

        @endslot
    @endcomponent
@endsection
