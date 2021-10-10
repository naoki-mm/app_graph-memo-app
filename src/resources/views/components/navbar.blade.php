{{--
    Copyright: Material Design for Bootstrap
    https://mdbootstrap.com/

    Read the license: https://mdbootstrap.com/general/license/
--}}

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
        <a class="navbar-brand" href="#">
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
            <li class="nav-item dropdown">
                <a
                    class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center"
                    href="#"
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
                        テストユーザー
                    </span>
                </a>
                <ul
                    class="dropdown-menu dropdown-menu-end"
                    aria-labelledby="navbarDropdownMenuLink"
                    >
                    <li><a class="dropdown-item" href="#"><i class="fas fa-user-circle fa-fw mr-1"></i></i>プロフィール</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-cog fa-fw mr-1"></i>アカウント設定</a></li>
                    <div class="dropdown-divider"></div>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-fw mr-1"></i>ログアウト</a></li>
                </ul>
            </li>
        </ul>
        <!-- 右サイドのリスト -->
    </div>
    <!-- コンテナ -->
</nav>
<!-- ナビバー -->
