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

        <!-- 検索フォーム -->
        <form class="d-none d-md-flex input-group w-auto my-auto">
            <input
                autocomplete="off"
                type="search"
                class="form-control rounded"
                placeholder='Search...'
                style="min-width: 225px"
                />
            <span class="input-group-text border-0"><i class="fas fa-search"></i></span>
        </form>

        <!-- 右サイドのリスト -->
        <ul class="navbar-nav ms-auto d-flex flex-row">
            <!-- 通知機能 -->
            <li class="nav-item">
                <a
                    class="nav-link me-3 me-lg-0"
                    href="#"
                    role="button"
                    >
                    <i class="fas fa-bell"></i>
                    <span class="badge rounded-pill badge-notification bg-danger"
                        >1</span
                    >
                </a>
            </li>

            <!-- ユーザー -->
            <li class="nav-item dropdown pl-1">
                <a
                    class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center"
                    id="navbarDropdownMenuLink"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    >
                    <img
                        src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg"
                        class="rounded-circle mr-1"
                        height="22"
                        alt=""
                        loading="lazy"
                        />
                    <span>
                        {{ auth()->user()->name }}
                    </span>
                </a>

                <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <button form="user-info" class="dropdown-item" type="button" onclick="location.href='{{ route("user-profile.edit", auth()->user()->id) }}'">
                        <i class="fas fa-user-cog fa-fw mr-1"></i></i>アカウント設定
                    </button>
                    <button class="dropdown-item" type="button" onclick="location.href=''">
                        <i class="fas fa-question fa-fw mr-1"></i>使い方
                    </button>
                    <div class="dropdown-divider"></div>
                    <button form="logout-button" class="dropdown-item" type="submit">
                        <i class="fas fa-sign-out-alt fa-fw mr-1"></i>ログアウト
                    </button>
                </div>
            </li>
            <!--ログアウト用のフォーム -->
            <form id="logout-button" method="POST" action="{{ route('logout') }}">
                @csrf
            </form>
        </ul>
    </div>
    <!-- コンテナ -->
</nav>
<!-- ナビバー -->
