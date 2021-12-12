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

            @if($graphs->isEmpty())
                <div class="w-100 d-flex align-items-center justify-content-center text-center" style="height: 90vmin">
                    <div>
                        <i class="far fa-trash-alt fa-9x mb-4" style="color: #BDBDBD"></i>
                        <p class="mt-4 h3" style="color: #afaeae">ゴミ箱にメモがありません</p>
                    </div>
                </div>

            @else
                @include('sub_views.graphs.index_base',
                        ['graphs_select' => $graphs,
                        'is_trash' => true,])
            @endif

        @endslot

    @endcomponent
@endsection

@section('footer')

@endsection
