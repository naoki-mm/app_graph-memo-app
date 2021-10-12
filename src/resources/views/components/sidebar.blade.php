{{-- Bootstrapで定義されたCSSとの干渉を避けるため、個別にスタイルシートを適用 --}}
@push('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

<header>
    <!-- サイドバー -->
    <nav
        {{-- トグルボタンとの紐付け --}}
        id="sidebarMenu"
        {{-- "画面がLGサイズ以上" or "トグルボタンをクリック" でサイドバー表示 --}}
        class="collapse d-lg-block sidebar collapse bg-white"
    >
        <!-- サイドに固定 -->
        <div class="position-sticky">
            <div class="list-group list-group-flush mx-3 mt-4">
                {{-- サイドバーのリスト --}}
                {{ $sidebar_list }}
            </div>
        </div>
    </nav>
    <!-- サイドバー -->
</header>
