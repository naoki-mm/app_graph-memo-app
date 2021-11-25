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
                <a href="{{ route("graph.edit", $graph->id) }}">
                    <div class="mask flex-center rgba-blue-slight">
                        <h3 class="font-weight-bold">詳  細</h3>
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

            <div class="ml-4 pt-3 text-center">
                <ul class="list-unstyled list-inline">

                    {{-- お気に入りボタン --}}
                    <li class="list-inline-item">
                        <graph-favorite
                            :initial-is-favorite = '@json($graph->favorite)'
                            favorite-update-endpoint="{{ route('favorite.update', $graph->id) }}"
                        >
                        </graph-favorite>
                    </li>

                    {{-- 削除ボタン --}}
                    <li class="list-inline-item ml-5">
                        <button form="delete-button" type="submit" class="btn m-0 p-1 shadow-none">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </li>

                    <!--削除用のフォーム -->
                    <form id="delete-button" method="POST" action="{{ route('graph.destroy', $graph->id) }}">
                        @method('DELETE')
                        @csrf
                    </form>
                </ul>
            </div>
            {{ $graph->created_at->format('Y/m/d') }}
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
