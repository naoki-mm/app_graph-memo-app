<header>
    {{-- ナビバーの読み込み --}}
    @include('components.common.navbar')

    {{-- サイドバーの読み込みと個別のリストを定義 --}}
    <side-navbar :is-image-file='graphImage.isFile' >

        <div class="list-group-item list-group-item-action border-0" aria-current="true">
            <div class="accordion" id="accordionExample">
                <div id="headingOne">
                    <ul class="list-unstyled list-inline mb-0">
                        {{-- メモ一覧遷移リンク --}}
                        <li class="list-inline-item">
                            <a href="{{ route('graph.index') }}" class="list-group-item-action">
                                <i class="fas fas fa-home fa-fw me-3 mr-2"></i><span>プロットメモ</span>
                            </a>
                        </li>
                        {{-- トグルボタン --}}
                        <li class="list-inline-item" style="margin-left: 30px">
                            <i class="fas fa-angle-down"
                                data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne">
                            </i>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="list-group-item py-0" aria-current="true">
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="my-1">
                    {{-- タグ一覧表示 --}}
                    @isset($all_tags)
                        @foreach($all_tags as $tag_array)
                            @if($loop->first)
                                <div class="pb-4 pl-3">
                                @endif
                                    <a href="{{ route('tag.index', ['name' => $tag_array['text']]) }}" class="d-inline-block badge badge-light p-1 mr-1 mt-1">
                                        {{ $tag_array['text'] ?? [] }}
                                    </a>
                                @if($loop->last)
                                </div>
                            @endif
                        @endforeach
                    @endisset
                    @isset($tag)
                        <div>
                            {{ $tag->graphs->count() }}件
                        </div>
                    @endisset
                </div>

            </div>
        </div>

        <a
        href="{{ route('graph.create') }}"
        class="list-group-item list-group-item-action py-2 ripple"
        aria-current="true"
        >
        <i class="far fa-plus-square fa-fw me-3 mr-2"></i><span>新規作成</span>
        </a>

        <a
        href="#"
        class="list-group-item list-group-item-action py-2 ripple"
        >
        <i class="fas fa-tag fa-fw me-3 mr-2"></i><span>タグ</span>
        </a>

        <a
        href="{{ route('trash.index') }}"
        class="list-group-item list-group-item-action py-2 ripple"
        ><i class="fas fa-trash fa-fw me-3 mr-2"></i><span>ゴミ箱</span></a
        >
    </side-navbar>
</header>
