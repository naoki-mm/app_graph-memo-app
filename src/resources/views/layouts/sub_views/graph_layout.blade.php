@component('components.sidebar')
    @slot('sidebar_list')
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
    @endslot
@endcomponent

@component('components.navbar')
    <!-- 検索フォーム -->
    @slot('search_form')
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
    @endslot

    <!-- 右サイドのリスト -->
    @slot('right_side_list')
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
                    <button class="dropdown-item" type="button" onclick="location.href=''">
                        <i class="fas fa-user-circle fa-fw mr-1"></i></i>プロフィール
                    </button>
                    <button class="dropdown-item" type="button" onclick="location.href=''">
                        <i class="fas fa-cog fa-fw mr-1"></i>アカウント設定
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
    @endslot
@endcomponent
