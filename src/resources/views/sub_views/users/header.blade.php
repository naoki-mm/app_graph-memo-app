<header>
    {{-- ナビバーの読み込み --}}
    @include('components.common.navbar')

    {{-- サイドバーの読み込みと個別のリストを定義 --}}
    <side-navbar>
        <a
        href="{{ route('graph.index') }}"
        class="list-group-item list-group-item-action py-2 ripple"
        aria-current="true"
        >
        <i class="fas fa-file-signature  fa-fw me-2 mr-1"></i><span>メモ一覧に戻る</span>
        </a>

        <hr class="sidebar-hr mt-1 mb-1">

        <a
        href="{{ route("user-profile.edit", auth()->user()->id) }}"
        class="list-group-item list-group-item-action py-2 ripple
        {{ $profile_active_flag ?? ''  ? 'custom-active' : '' }}"
        aria-current="true"
        >
        <i class="fas fa-user-edit fa-fw me-3 mr-2"></i><span>プロフィール編集</span>
        </a>

        <a
        href="{{ route("user-email.edit", auth()->user()->id) }}"
        class="list-group-item list-group-item-action py-2 ripple
        {{ $email_active_flag ?? ''  ? 'custom-active' : '' }}"
        aria-current="true"
        >
        <i class="fas fa-envelope fa-fw me-3 mr-2"></i><span>メールアドレス変更</span>
        </a>

        <a
        href="{{ route("user-password.edit", auth()->user()->id) }}"
        class="list-group-item list-group-item-action py-2 ripple
        {{ $password_active_flag ?? ''  ? 'custom-active' : '' }}"
        aria-current="true"
        >
        <i class="fas fa-lock fa-fw me-3 mr-2"></i><span>パスワード変更</span>
        </a>

        <a
        href="{{ route("delete-account.edit", auth()->user()->id) }}"
        class="list-group-item list-group-item-action py-2 ripple
        {{ $delete_active_flag ?? ''  ? 'custom-active' : '' }}"
        >
        <i class="fas fa-user-slash fa-fw me-3 mr-2"></i><span>退会</span>
        </a>
    </side-navbar>
</header>
