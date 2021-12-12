<header>
    {{-- ナビバーの読み込み --}}
    @include('components.common.navbar')

    {{-- サイドバーの読み込みと個別のリストを定義 --}}
    <side-navbar :is-image-file='graphImage.isFile' >

        <div class="list-group-item list-group-item-action border-0
                {{ $index_active_flag ?? ''  ? 'custom-active' : '' }}"
                aria-current="true"
                >
            <div class="accordion" id="accordionExample">
                <div id="headingOne">
                    <ul class="list-unstyled list-inline mb-0">
                        {{-- メモ一覧遷移リンク --}}
                        <li class="list-inline-item">
                            <a href="{{ route('graph.index') }}" class="list-group-item-action main-bar-content">
                                <i class="fas fa-file-signature  fa-fw me-2 mr-1"></i><span>プロットメモ</span>
                            </a>
                        </li>
                        {{-- トグルボタン --}}
                        <li class="list-inline-item" style="margin-left: 30px">
                            <i
                                class="fas"
                                :class="{'fa-angle-down': isToggleAngleDown, 'fa-angle-right': !isToggleAngleDown}"
                                data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne"
                                v-on:click="isToggleAngleDown = !isToggleAngleDown">
                            </i>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="list-group-item py-0" aria-current="true">
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="pl-2 mb-2 navbar-sub-contents">

                    {{-- 全てのメモ --}}
                    <div class="pl-4 mt-2 custom-switch" style="margin-left: 13px">
                        <input type="checkbox" onclick="location.href='{{ route('graph.index') }}'"
                            class="custom-control-input" id="customSwitchesAll"
                            @if($index_active_flag ?? '') {{ session('favorite') || session('tag_name') ? '' : 'checked disabled' }} @endif
                        >
                        <label class="custom-control-label" for="customSwitchesAll">全てのメモを表示</label>
                    </div>
                    <hr class="sidebar-hr">

                    @if(session('index_order') === 'desc')
                        {{-- 新しい順に並べ替え --}}
                        <div class="pl-4 custom-switch" style="margin-left: 13px">
                            <input type="checkbox" onclick="location.href='{{ route('index.sort', ['order' => 'desc']) }}'"
                                class="custom-control-input" id="customSwitchesNew"
                            >
                            <label class="custom-control-label" for="customSwitchesNew">新しい順に表示中</label>
                        </div>
                        <hr class="sidebar-hr">

                    @elseif(session('index_order') === 'asc')
                        {{-- 古い順に並べ替え --}}
                        <div class="pl-4 custom-switch" style="margin-left: 13px">
                            <input type="checkbox" onclick="location.href='{{ route('index.sort', ['order' => 'asc']) }}'"
                                class="custom-control-input" id="customSwitchesOld" checked
                            >
                            <label class="custom-control-label" for="customSwitchesOld">古い順に表示中</label>
                        </div>
                        <hr class="sidebar-hr">

                    @else
                    @endif

                    {{-- お気に入り絞り込み --}}
                    <div class="pl-4 custom-switch" style="margin-left: 13px">
                        <input type="checkbox" onclick="location.href='{{ route('favorite.search') }}'"
                            class="custom-control-input" id="customSwitchesFavorite"
                            {{ session('favorite') ? 'checked': '' }}
                        >
                        <label class="custom-control-label" for="customSwitchesFavorite">お気に入り</label>
                    </div>

                    {{-- タグ絞り込み --}}
                    <div class="pl-4 pb-1 custom-switch" style="margin-left: 13px">
                        <input type="checkbox" onclick="location.href='{{ route('tag.search', ['name' => session('tag_name') ?? 'a']) }}'"
                            class="custom-control-input" id="customSwitchesTag"
                            {{ session('tag_name') ? 'checked': 'disabled' }}
                        >
                        <label class="custom-control-label" for="customSwitchesTag">タグ検索</label>
                    </div>

                    {{-- タグ一覧表示 --}}
                    @isset($all_tags)
                        @foreach($all_tags as $tag_array)
                            @if($loop->first)
                                <div class="pb-3 pl-3">
                                @endif
                                    <a href="{{ route('tag.search', ['name' => $tag_array['text']]) }}"
                                        class="badge tag-badge d-inline-block p-1 mr-1 mt-1"
                                        id="{{ session('tag_name') ===  $tag_array['text'] ? 'badge-active-style': '' }}"
                                        >
                                        {{ $tag_array['text'] ?? [] }}
                                    </a>
                                @if($loop->last)
                                </div>
                            @endif
                        @endforeach
                    @endisset

                </div>

            </div>
        </div>

        <a
        href="{{ route('graph.create') }}"
        class="list-group-item list-group-item-action py-2 ripple main-bar-content
            {{ $create_active_flag ?? ''  ? 'custom-active' : '' }}"
            aria-current="true"
            >
        <i class="fas fa-plus-square me-3 mr-2"></i><span>新規作成</span>
        </a>

        <a
        href="{{ route('trash.index') }}"
        class="list-group-item list-group-item-action py-2 ripple main-bar-content
            {{ $trash_active_flag ?? ''  ? 'custom-active' : '' }}"
            >
        <i class="fas fa-trash-alt me-3 mr-2"></i><span>ゴミ箱</span></a
        >
    </side-navbar>
</header>
