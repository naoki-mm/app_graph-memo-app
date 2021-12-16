
<header>
    {{-- ナビバー --}}
    @if($login_view_flag || $register_view_flag)
        <nav class="navbar navbar-expand-lg fixed-top navbar-dark" id="authNavbar">
    @else
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar">
    @endif
        <div class="container">
            <a class="navbar-brand mr-1" href="{{ route('top.show') }}">
                <img
                    src="https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/plotemo_logo.svg"
                    width="130"
                    height="25"
                    alt=""
                    loading="lazy"
                    />
            </a>

            {{-- ハンバーガーボタン --}}
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7" aria-controls="navbarSupportedContent-7" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- ナビバーの項目 --}}
            <div class="collapse navbar-collapse" id="navbarSupportedContent-7">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item {{ $login_view_flag || $register_view_flag ? '' : 'active' }}">
                        <a class="nav-link" href="{{ route('top.show') }}">Home
                        </a>
                    </li>
                    <li class="nav-item {{ $register_view_flag ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('register') }}" >新規登録</a>
                    </li>
                    <li class="nav-item {{ $login_view_flag ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ゲストログイン</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{ $header_content}}

</header>
