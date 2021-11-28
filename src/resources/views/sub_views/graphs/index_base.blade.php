<div class="row row-cols-1 row-cols-md-2 no-gutters">
    @foreach ($graphs_select as $graph)
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

            @if($is_trash)
                <div class="ml-4 pt-3 text-center">
                    <ul class="list-unstyled list-inline">

                        {{-- 復元ボタン --}}
                        <li class="list-inline-item">
                            <button form="restore-button" type="submit" class="btn m-0 p-1 shadow-none">
                                <i class="fas fa-trash-restore fa-lg"></i>
                            </button>
                        </li>

                        {{-- 完全削除ボタン --}}
                        <li class="list-inline-item ml-5">
                            <button form="delete-button" type="submit" class="btn m-0 p-1 shadow-none">
                                <span class="fa-stack">
                                    <i class="fas fa-trash fa-stack-1x fa-lg"></i>
                                    <i class="fas fa-times fa-stack-1x fa-xs text-white"></i>
                                </span>
                            </button>
                        </li>

                        <!--復元用のフォーム -->
                        <form id="restore-button" method="POST" action="{{ route('trash.restore', $graph->id) }}">
                            @method('PUT')
                            @csrf
                        </form>

                        <!--完全削除用のフォーム -->
                        <form id="delete-button" method="POST" action="{{ route('trash.destroy', $graph->id) }}">
                            @method('DELETE')
                            @csrf
                        </form>
                    </ul>
                </div>
                {{ $graph->created_at->format('Y/m/d') }}
            @else
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

            {{-- タグ一覧表示 --}}
            @foreach($graph->tags as $tag)
                @if($loop->first)
                <div class="card-body pt-0 pb-4 pl-3">
                    <div class="card-text line-height">
                @endif
                    <a href="" class="border p-1 mr-1 mt-1 text-muted">
                        {{ $tag->name }}
                    </a>
                @if($loop->last)
                    </div>
                </div>
                @endif
            @endforeach

            {{ $graph->created_at->format('Y/m/d') }}

            @endif
        </div>
    </div>
    @endforeach
</div>

{{-- <div class="d-flex align-items-center justify-content-center">
    {{ $graphs->links() }}
</div> --}}
