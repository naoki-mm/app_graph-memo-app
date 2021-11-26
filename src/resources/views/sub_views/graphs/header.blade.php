<header>
    {{-- ナビバーの読み込み --}}
    @include('components.common.navbar')

    {{-- サイドバーの読み込みと個別のリストを定義 --}}
    <side-navbar :is-image-file='graphImage.isFile' >
        <a
        href="{{ route('graph.index') }}"
        class="list-group-item list-group-item-action py-2 ripple active"
        aria-current="true"
        >
        <i class="fas fas fa-home fa-fw me-3 mr-2"></i><span>ホーム</span>
        </a>

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
