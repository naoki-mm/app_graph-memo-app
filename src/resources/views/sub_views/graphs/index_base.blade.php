<div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 no-gutters">
    @foreach ($graphs_select as $graph)
    <div class="col mb-2 px-1">

        <div class="card h-100 index-card @if($is_trash) no_active_a ml-3 @endif">

            {{-- Card header --}}
            <a @if(!$is_trash) href="{{ route("graph.edit", $graph->id) }}" @endif class="m-0 pb-0 card-header" style="background-color: rgba(0,0,0,0); border-color: rgba(0,0,0,0)">
                <p class="text-center p-0 pt-2 ml-2 mb-3 font-weight-bold">{{ $graph->title }}</p>
            </a>

            {{-- Card image プロット画像 --}}
            @foreach ($graph->plotData as $plot_data)
                <a @if(!$is_trash) href="{{ route("graph.edit", $graph->id) }}" @endif class="" id="index-plot-image">
                    <img
                        class=""
                        src="{{ Storage::disk('s3')->url('plot_images/'.$plot_data->plot_image_name) }}"
                        alt="Card image cap"
                        style="aspect-ratio: 1 / 0.7; width: 100%;
                            background-image: url({{ Storage::disk('s3')->url('graph_images/'.$graph->image_name) }});
                            background-repeat: no-repeat;
                            background-size: 100% 100%;
                            ">
                        {{-- ローカルの画像保存先
                        src="{{ asset('storage/graph_images/'.$graph->image_name) }}" --}}
                </a>
            @endforeach

            {{-- Card content --}}
            <a @if(!$is_trash) href="{{ route("graph.edit", $graph->id) }}" @endif class="card-body pb-0">
                <blockquote class="blockquote card-text">
                    <small class="mb-0">{{ $graph->memo }}</small>
                </blockquote>
            </a>

            {{-- card footer --}}
            <div class="card-footer m-0 pb-0" style="background-color: rgba(0,0,0,0); border-color: rgba(0,0,0,0)">
                @if (!$is_trash)

                    {{-- タグ一覧表示 --}}
                    @foreach($graph->tags as $tag)
                        @if($loop->first)
                        <div class="pt-0 pb-0">
                            <div class="card-text line-height">
                        @endif
                            <a href="{{ route('tag.search', ['name' => $tag->name]) }}" class="tag-badge d-inline-block badge badge-light p-1 mr-1 mt-1"
                                id="{{ session('tag_name') === $tag->name ? 'badge-active-style': '' }}">
                                {{ $tag->name }}
                            </a>
                        @if($loop->last)
                            </div>
                        </div>
                        @endif
                    @endforeach
                    <footer class="pb-1 pt-2 text-center"><small>更新日時：{{ $graph->updated_at->format('Y/m/d H:i') }}</small></footer>
                @else
                    <footer class="pb-1 pt-2 text-center"><small>削除日：{{ $graph->deleted_at->format('Y/m/d') }}</small></footer>

                    @isset($graph->id)
                        @foreach (\GraphIdConst::SAMPLES as $sample_graph_id)
                                @if ($graph->id === $sample_graph_id)
                                    <p class="text-danger text-left">
                                        ※このサンプルデータは完全に削除できません。
                                        <br>削除機能を試す場合は、メモを新規登録してください。
                                    </p>
                                @endif
                        @endforeach
                    @endisset
                @endif
            </div>

            {{-- card footer --}}
            <div class="card-footer p-0 index-card-footer">
                <ul class="index-ul list-unstyled list-inline m-0 d-flex">
                    @if($is_trash)
                        {{-- 復元ボタン --}}
                        <li class="list-inline-item mx-auto"
                            data-toggle="tooltip" data-placement="top" title="復元する">
                        <!--復元用のフォーム -->
                            <form method="POST" action="{{ route('trash.restore', $graph->id) }}">
                                @method('PUT')
                                @csrf
                                <button type="submit" class="trash-btn btn m-0 p-2 shadow-none">
                                    <i class="fas fa-trash-restore"></i>
                                </button>
                            </form>
                        </li>

                        {{-- 完全削除ボタン --}}
                        <li class="list-inline-item mx-auto"
                            data-toggle="tooltip" data-placement="top" title="完全に削除する">
                            @component('components.common.warning_modal')

                                @slot('modal_view_button')
                                    <button type="button" class="trash-btn btn m-0 p-1 shadow-none" data-toggle="modal" data-target="{{ '#centralModalWarning'.$graph->id }}">
                                        <span class="fa-stack">
                                            <i class="fas fa-trash fa-stack-1x"></i>
                                            <i class="fas fa-times fa-stack-1x trash-x-mark"></i>
                                        </span>
                                    </button>
                                @endslot

                                @slot('modal_view_id')
                                    {{ 'centralModalWarning'.$graph->id }}
                                @endslot

                                @slot('modal_header')
                                    メモ削除の確認
                                @endslot

                                @slot('modal_body')
                                    削除したメモは復元できません。よろしいですか？
                                @endslot

                                @slot('modal_submit_button')
                                    <!--完全削除用のフォーム -->
                                    <form method="POST" action="{{ route('trash.destroy', $graph->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="py-2 btn btn-warning white-text" style="padding: 8px 32.5px">O K</button>
                                    </form>
                                @endslot
                            @endcomponent
                        </li>

                    @else
                        {{-- 編集ボタン --}}
                        <li class="index-li list-inline-item mx-auto"
                                data-toggle="tooltip" data-placement="top" title="編集する">
                            <a href="{{ route("graph.edit", $graph->id) }}" class="bi-btn btn m-0 p-1 shadow-none">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </li>

                        {{-- csvダウンロードボタン --}}
                        <li class="list-inline-item mx-auto" data-toggle="tooltip"
                            data-placement="top" title="csvをダウンロードする">
                            <a href="{{ route("csv.download", $graph->id) }}" class="bi-btn btn m-0 p-1 shadow-none">
                                <i class="bi bi-download"></i>
                            </a>
                        </li>

                        {{-- お気に入りボタン --}}
                        <li class="list-inline-item mx-auto" data-toggle="tooltip" data-placement="top" title="お気に入り">
                            <graph-favorite
                                :initial-is-favorite = '@json($graph->favorite)'
                                favorite-update-endpoint="{{ route('favorite.update', $graph->id) }}"
                            >
                            </graph-favorite>
                        </li>

                        {{-- 削除ボタン --}}
                        <li class="list-inline-item mx-auto"
                            data-toggle="tooltip" data-placement="top" title="ゴミ箱に移動する">
                            @component('components.common.warning_modal')

                                @slot('modal_view_button')
                                    <button type="button" class="bi-btn btn m-0 p-1 shadow-none" data-toggle="modal" data-target="{{ '#centralModalWarning'.$graph->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                @endslot

                                @slot('modal_view_id')
                                    {{ 'centralModalWarning'.$graph->id }}
                                @endslot

                                @slot('modal_header')
                                    メモ削除の確認
                                @endslot

                                @slot('modal_body')
                                    メモをゴミ箱に移動します。よろしいですか？
                                @endslot

                                @slot('modal_submit_button')
                                    <!--削除用のフォーム -->
                                    <form method="POST" action="{{ route('graph.destroy', $graph->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="py-2 btn btn-warning white-text" style="padding: 8px 32.5px">O K</button>
                                    </form>
                                @endslot
                            @endcomponent
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="d-flex align-items-center justify-content-center">
    {{ $graphs->appends(request()->input())->links() }}
</div>
