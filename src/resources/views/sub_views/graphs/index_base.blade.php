<div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 no-gutters">
    @foreach ($graphs_select as $graph)
    <div class="col mb-2 px-1">

        <div class="card h-100 index-card">

        @if ($is_trash)
            <div class="no_active_a disabled ml-3">
        @endif

                {{-- Card header --}}
                <a href="{{ route("graph.edit", $graph->id) }}" class="m-0 pb-0 card-header" style="background-color: rgba(0,0,0,0); border-color: rgba(0,0,0,0)">
                    <p class="p-0 ml-2 mb-0 font-weight-bold">{{ $graph->title }}</p>
                </a>

                {{-- Card image --}}
                <a  href="{{ route("graph.edit", $graph->id) }}" class="view overlay mt-1">
                    <img
                        class="card-img-top"
                        src="{{ asset('storage/graph_images/'.$graph->image_name) }}"
                        alt="Card image cap"
                        style="aspect-ratio: 1 / 0.7; width: 100%;">

                </a>

                {{-- Card content --}}
                <a href="{{ route("graph.edit", $graph->id) }}" class="card-body pb-0">
                    <blockquote class="blockquote card-text">
                        <small class="mb-0">{{ $graph->memo }}</small>
                    </blockquote>
                </a>

        @if ($is_trash)
            </div>
        @endif

            {{-- card footer --}}
            <div class="card-footer m-0 pb-0 text-center" style="background-color: rgba(0,0,0,0); border-color: rgba(0,0,0,0)">
                @if (!$is_trash)

                    {{-- タグ一覧表示 --}}
                    @foreach($graph->tags as $tag)
                        @if($loop->first)
                        <div class="pt-0 pb-0 pl-3">
                            <div class="card-text line-height">
                        @endif
                            <a href="{{ route('tag.search', ['name' => $tag->name]) }}" class="tag-badge d-inline-block badge badge-light p-1 mr-1 mt-1">
                                {{ $tag->name }}
                            </a>
                        @if($loop->last)
                            </div>
                        </div>
                        @endif
                    @endforeach
                    <footer class="py-1"><small>作成日：{{ $graph->created_at->format('Y/m/d') }}</small></footer>
                @else
                    <footer class="py-1"><small>削除日：{{ $graph->deleted_at->format('Y/m/d') }}</small></footer>
                @endif
            </div>


            {{-- card footer --}}
            <div class="card-footer p-0 index-card-footer">
                <ul class="index-ul list-unstyled list-inline m-0 d-flex">
                    @if($is_trash)
                        {{-- 復元ボタン --}}
                        <li class="list-inline-item mx-auto">
                            <button form="restore-button" type="submit" class="trash-btn btn m-0 p-2 shadow-none">
                                <i class="fas fa-trash-restore"></i>
                            </button>
                        </li>

                        {{-- 完全削除ボタン --}}
                        <li class="list-inline-item mx-auto">
                            <button form="delete-button" type="submit" class="trash-btn btn m-0 p-1 shadow-none">
                                <span class="fa-stack">
                                    <i class="fas fa-trash fa-stack-1x"></i>
                                    <i class="fas fa-times fa-stack-1x trash-x-mark"></i>
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

                    @else
                        {{-- お気に入りボタン --}}
                        <li class="list-inline-item mx-auto">
                            <graph-favorite
                                :initial-is-favorite = '@json($graph->favorite)'
                                favorite-update-endpoint="{{ route('favorite.update', $graph->id) }}"
                            >
                            </graph-favorite>
                        </li>

                        {{-- 編集ボタン --}}
                        <li class="index-li list-inline-item mx-auto">
                            <a href="{{ route("graph.edit", $graph->id) }}" class="bi-btn btn m-0 p-1 shadow-none">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </li>

                        {{-- 削除ボタン --}}
                        <li class="list-inline-item mx-auto">
                            <button form="delete-button" type="submit" class="bi-btn btn m-0 p-1 shadow-none">
                                <i class="bi bi-trash"></i>
                            </button>
                        </li>

                        <!--削除用のフォーム -->
                        <form id="delete-button" method="POST" action="{{ route('graph.destroy', $graph->id) }}">
                            @method('DELETE')
                            @csrf
                        </form>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="d-flex align-items-center justify-content-center">
    {{ $graphs->links() }}
</div>
