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
                                <i class="fas fa-sticky-note me-3 mr-2"></i></i></i><span>プロットメモ</span>
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
                <div class="pl-2 my-1 navbar-sub-contents">
                    <p class="mb-0 pl-2"><i class="bi bi-star-fill mr-1"></i>お気に入り</p>
                    <hr class="my-1">
                    <p class="mb-1 pl-2"><i class="bi bi-tags-fill mr-1"></i>タグ一覧</p>
                    {{-- タグ一覧表示 --}}
                    @isset($all_tags)
                        @foreach($all_tags as $tag_array)
                            @if($loop->first)
                                <div class="pb-2 pl-3">
                                @endif
                                    <a href="{{ route('tag.index', ['name' => $tag_array['text']]) }}" class="tag-badge d-inline-block badge badge-light p-1 mr-1 mt-1">
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
                    <hr class="my-1">
                    <p class="mb-0 pl-2"><i class="fas fa-sort-amount-up mr-1"></i>新しい順</p>
                    <hr class="my-1">
                    <p class="mb-0 pl-2 mb-2"><i class="fas fa-sort-amount-down mr-1"></i>古い順</p>
                </div>

            </div>
        </div>

        <a
        href="{{ route('graph.create') }}"
        class="list-group-item list-group-item-action py-2 ripple"
        aria-current="true"
        >
        <i class="fas fa-plus-square me-3 mr-2"></i><span>新規作成</span>
        </a>

        <a
        href="{{ route('trash.index') }}"
        class="list-group-item list-group-item-action py-2 ripple"
        ><i class="fas fa-trash-alt me-3 mr-2"></i><span>ゴミ箱</span></a
        >
    </side-navbar>
</header>
