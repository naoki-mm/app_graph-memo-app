<header>
    {{-- ナビバーの読み込み --}}
    @include('components.navbar')

    {{-- サイドバーの読み込みと個別のリストを定義 --}}
    @component('components.sidebar')
        @slot('sidebar_list')
            <a
            href="{{ route('graph.index') }}"
            class="list-group-item list-group-item-action py-2 ripple"
            aria-current="true"
            >
            <i class="fas fas fa-home fa-fw me-3 mr-2"></i><span>ホーム</span>
            </a>

            <a
            href="{{ route('graph.index') }}"
            class="list-group-item list-group-item-action py-2 ripple active"
            aria-current="true"
            >
            <i class="fas fa-user-edit fa-fw me-3 mr-2"></i><span>ユーザー基本情報</span>
            </a>

            <a
            href="#"
            class="list-group-item list-group-item-action py-2 ripple"
            aria-current="true"
            >
            <i class="fas fa-envelope fa-fw me-3 mr-2"></i><span>メールアドレス変更</span>
            </a>

            <a
            href="#"
            class="list-group-item list-group-item-action py-2 ripple"
            aria-current="true"
            >
            <i class="fas fa-unlock-alt fa-fw me-3 mr-2"></i><span>パスワード変更</span>
            </a>

            <a
            href="#"
            class="list-group-item list-group-item-action py-2 ripple"
            >
            <i class="fas fa-user-slash fa-fw me-3 mr-2"></i><span>退会</span>
            </a>
        @endslot
    @endcomponent
</header>
