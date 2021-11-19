<!-- ナビバー -->
<nav
    id="main-navbar"
    {{-- navbar-expand-lgを削除 --}}
    class="navbar navbar-light bg-white fixed-top"
    :class="{'navbar-expand-lg': !graphImage.isFile}"
    >
    <!-- コンテナ -->
    <div class="container-fluid">
        <!-- ロゴ -->
        <a class="navbar-brand mr-1" href="{{ route('graph.index') }}">
            <img
                src="{{ asset('images/logo.png')}}"
                height="25"
                alt=""
                loading="lazy"
                />
        </a>

        <!-- ハンバーガーボタン -->
        <button
            class="navbar-toggler mr-auto mt-2"
            type="button"
            data-toggle="collapse"
            data-target="#sidebarMenu"
            aria-controls="sidebarMenu"
            aria-expanded="false"
            aria-label="Toggle navigation"
            >
            <i class="fas fa-bars"></i>
        </button>

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
                    {{-- アバター画像がDBに保存されていれば、その画像を表示。 --}}
                    @if (!empty(auth()->user()->image_name))
                        <img src="/storage/avatar_images/{{ auth()->user()->image_name }}"
                            class="rounded-circle mr-1"
                            style="object-fit: cover; width: 24px; height: 24px;"
                        >
                    {{-- アバター画像がDBに保存されていなければ、初期画像を表示。 --}}
                    @else
                        <img src="/images/avatar-default.svg"
                            class="rounded-circle mr-1"
                            style="object-fit: cover; width: 24px; height: 24px;"
                        >
                    @endif

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
