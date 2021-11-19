@extends('layouts.app')

@section('title')
    ホーム
@endsection

@section('header')
    @if (session('status'))
        <success-notification
            :notification='@json(session('status'))'
        ></success-notification>
    @endif
    @include('sub_views.graphs.header')
@endsection

@section('content')

@endsection

@section('footer')

@endsection
