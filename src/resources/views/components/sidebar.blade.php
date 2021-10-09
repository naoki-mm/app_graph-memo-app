{{--
    Copyright: Material Design for Bootstrap
    https://mdbootstrap.com/

    Read the license: https://mdbootstrap.com/general/license/
--}}

@push('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

<header>
    <!-- サイドバー -->
    <nav
        {{-- トグルボタンとの紐付け --}}
        id="sidebarMenu"
        {{-- "画面がLGサイズ以上" or "トグルボタンをクリック" でサイドバー表示。 --}}
        class="collapse d-lg-block sidebar collapse bg-white"
    >
        {{-- サイドに固定 --}}
        <div class="position-sticky">
            <div class="list-group list-group-flush mx-3 mt-4">
                <a
                href="#"
                class="list-group-item list-group-item-action py-2 ripple active"
                aria-current="true"
                >
                <i class="fas fas fa-home fa-fw me-3 mr-2"></i><span>ホーム</span>
                </a>

                <a
                href="#"
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
                href="#"
                class="list-group-item list-group-item-action py-2 ripple"
                ><i class="fas fa-trash fa-fw me-3 mr-2"></i><span>ゴミ箱</span></a
                >

                <a
                href="#"
                class="list-group-item list-group-item-action py-2 ripple"
                >
                <i class="fas fa-question fa-fw me-3 mr-2"></i><span>使い方</span>
                </a>
            </div>
        </div>
    </nav>
    <!-- サイドバー -->
</header>
