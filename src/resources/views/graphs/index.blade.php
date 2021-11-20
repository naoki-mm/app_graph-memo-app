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

    @component('components.graphs.main_item')

        @slot('main_content')

<div class="row row-cols-1 row-cols-md-2 no-gutters">
    @foreach ($graphs as $graph)
    <div class="col mb-2 px-1">
        <div class="card h-100">
            <!--Card image-->
            <div class="view overlay">
                <img class="card-img-top"
                    src="{{ asset('storage/graph_images/'.$graph->image_name) }}"
                    alt="Card image cap"
                    style="aspect-ratio: 1 / 0.7; width: 100%;">
                <a href="#!">
                    <div class="mask flex-center rgba-blue-slight">
                        <h3 class="font-weight-bold">編   集</h3>
                    </div>
                </a>

            </div>

            <!--Card content-->
            <div class="card-body">

                <!--Title-->
                <p class="card-title">{{ $graph->title }}</p>
                <hr>
                <!--Text-->
                <p class="card-text">{{ $graph->memo }}</p>

            </div>
            <!-- Card footer -->
            <div class="ml-4 pt-3">
                <ul class="list-unstyled list-inline font-small">
                    <li class="list-inline-item"><i class="far fa-star pr-1"></i></li>
                    <li class="list-inline-item pr-2">{{ $graph->created_at->format('Y/m/d') }}</li>
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="d-flex align-items-center justify-content-center">
    {{ $graphs->links() }}
</div>

        @endslot

    @endcomponent
@endsection

@section('footer')

@endsection
