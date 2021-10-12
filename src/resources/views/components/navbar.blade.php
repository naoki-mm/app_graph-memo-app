<!-- ナビバー -->
<nav
    id="main-navbar"
    class="navbar navbar-expand-lg navbar-light bg-white fixed-top"
    >
    <!-- コンテナ -->
    <div class="container-fluid">
        <!-- ハンバーガーボタン -->
        <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#sidebarMenu"
            aria-controls="sidebarMenu"
            aria-expanded="false"
            aria-label="Toggle navigation"
            >
            <i class="fas fa-bars"></i>
        </button>

        <!-- ロゴ -->
        <a class="navbar-brand" href="{{ route('graph.index') }}">
            <img
                src="{{ asset('images/logo.png')}}"
                height="25"
                alt=""
                loading="lazy"
                />
        </a>

        {{-- 検索フォーム --}}
        {{ $search_form }}

        {{-- 右サイドのリスト --}}
        {{ $right_side_list }}

    </div>
    <!-- コンテナ -->
</nav>
<!-- ナビバー -->
