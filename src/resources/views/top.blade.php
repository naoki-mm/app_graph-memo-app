@extends('layouts.top_layout')

@section('title')

@endsection

@section('content')

<header>
    {{-- ナビバー --}}
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar">
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
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home
                        <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">新規登録</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ログイン</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ゲストログイン</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- ヘッダーの項目 --}}
    <div class="view" style="background-image: url('https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/top_background.jpg');
            background-repeat: no-repeat; background-size: cover; background-position: center center;">
        <div class="mask rgba-gradient align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 white-text text-center text-md-left mb-5 wow fadeInLeft" data-wow-delay="0.3s" style="margin-top: 57px">

                        {{-- メインタイトル --}}
                        <h1 class="h1-responsive font-weight-bold mt-sm-5">
                            <p class="mb-1">グラフ画像のデータ読み取りを</p>
                            <p>効率化 & メモライクな管理</p>
                        </h1>

                        <hr class="hr-light my-4">

                        {{-- サブタイトル --}}
                        <h5 class="mb-5">
                            PLOTemo (プロッテモ) は画像・PDFなどのグラフデータポイントを効率的に読み取り、クラウド上にメモのように保存・一元管理が可能。検索機能も備え、すぐにデータが使えます。
                        </h5>

                        {{-- 認証系 --}}
                        <div class="ml-2">
                            <a class="h5 btn btn-success mr-4 font-weight-bold" style="padding: 15px 45px">無料で登録</a>
                            <a class="h5 btn btn-outline-success font-weight-bold bg-white" style="padding: 15px 45px">機能を試す</a>
                            <h5 class="mt-3 ml-5">
                                <a href="{{ route('login') }}" class="border-bottom border-success font-weight-bold">すでにアカウトをお持ちですか？ログイン</a>
                            </h5>
                        </div>
                    </div>

                    {{-- イラスト --}}
                    <div class="col-md-5 col-xl-5 wow fadeInRight" data-wow-delay="0.3s" style="margin-top: 80px">
                        <img src="https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/Site+Stats-amico.svg"
                            class="float-right mt-5" style="max-width: 90%; height: auto; filter: drop-shadow(30px 25px 3px rgba(0, 0, 0, 0.514));">
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

{{-- メインレイアウト --}}
<main>
    {{-- 機能紹介 --}}
    <div class="container">
        <div class="row my-4 justify-content-center">
            <div class="col-md-12 text-center">
                    <h1>「 できること 」</h1>
            </div>
        </div>

        <div class="row py-1 justify-content-center mb-3">
            <div class="pl-5 col-6 align-self-center">
                <h2 class="font-weight-light mb-4">グラフ画像の読み取りを効率的に</h2>
                <h4 class="font-weight-light">グラフ画像上をクリックして、座標データを取得。従来、目視で行っていたグラフの読み取り時間を短縮。読み取りミスも起こさない。</h4>
            </div>
            <div class="col-6 text-center align-self-center">
                <img src="https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/Site+Stats-amico.svg"
                    style="max-width: 85%; height: auto">
            </div>
        </div>

        <div class="row py-1 justify-content-center mb-3">
            <div class="col-6 text-center align-self-center">
                <img src="https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/Site+Stats-amico.svg"
                    style="max-width: 85%; height: auto">
            </div>
            <div class="pl-5 col-6 align-self-center">
                <h2 class="font-weight-light mb-4">データの一元管理・再利用</h2>
                <h4 class="font-weight-light">読み取ったデータはメモ形式で保存でき、クラウド上で一元管理が可能。一度読み取ったデータが再利用でき、エビデンスとしても活用できる。</h4>
            </div>
        </div>

        <div class="row py-1 justify-content-center mb-3">
            <div class="pl-5 col-6 align-self-center">
                <h2 class="font-weight-light mb-4">スマートな検索</h2>
                <h4 class="font-weight-light">タグ、お気に入り、キーワード検索、ソートを使えば必要なデータがすぐに見つかる。データコピー・CSVダウンロードによりすぐに使える。</h4>
            </div>
            <div class="col-6 text-center align-self-center">
                <img src="https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/Site+Stats-amico.svg"
                    style="max-width: 85%; height: auto">
            </div>
        </div>
    </div>

    {{-- 利用シーン --}}
    <div class="container">
        <div class="row my-5 justify-content-center">
            <div class="col-12 text-center mb-5">
                <h1>「さまざまな利用シーン 」</h1>
            </div>

            <div class="col-2 text-center align-self-center">
                <img src="https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/undraw_science_re_mnnr.svg"
                    style="max-width: 100%; height: auto">
                <h5 class="mt-1 font-weight-light">実験</h5>
            </div>
            <div class="col-2 text-center align-self-center">
                <img src="https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/undraw_science_re_mnnr.svg"
                    style="max-width: 100%; height: auto">
                <h5 class="mt-1 font-weight-light">実験</h5>
            </div>
            <div class="col-2 text-center align-self-center">
                <img src="https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/undraw_science_re_mnnr.svg"
                    style="max-width: 100%; height: auto">
                <h5 class="mt-1 font-weight-light">実験</h5>
            </div>
            <div class="col-2 text-center align-self-center">
                <img src="https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/undraw_science_re_mnnr.svg"
                    style="max-width: 100%; height: auto">
                <h5 class="mt-1 font-weight-light">実験</h5>
            </div>
            <div class="col-2 text-center align-self-center">
                <img src="https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/undraw_science_re_mnnr.svg"
                    style="max-width: 100%; height: auto">
                <h5 class="mt-1 font-weight-light">実験</h5>
            </div>
            <div class="col-2 text-center align-self-center">
                <img src="https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/undraw_science_re_mnnr.svg"
                    style="max-width: 100%; height: auto">
                <h5 class="mt-1 font-weight-light">実験</h5>
            </div>
        </div>
    </div>

    {{-- 認証系 --}}
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 80px">
            <div class="col-md-12 text-center">
                <h1>「さあ、今すぐ PLOTemo を始めましょう。」</h1>
            </div>

            <div class="col-12 text-center my-5">
                <a class="h5 btn btn-success mr-4 font-weight-bold" style="padding: 20px 50px">無料で登録</a>
                <a class="h5 btn btn-outline-success font-weight-bold bg-white" style="padding: 20px 50px">機能を試す</a>
                <h5 class="mt-3 ml-5">
                    <a href="{{ route('login') }}" class="border-bottom border-success font-weight-bold">すでにアカウトをお持ちですか？ログイン</a>
                </h5>
            </div>
        </div>


</main>

<footer class="mt-5 page-footer font-small bg-success">
    <div class="pt-3 footer-copyright text-center">
        <a href="{{ route('top.show') }}" class="mr-4">ホーム</a>
        <a href="https://twitter.com/hinanam3" class="mr-4">利用規約</a>
        <a href="https://twitter.com/hinanam3">プライバシーポリシー</a>
    </div>

    <div class="pb-3 pt-2 footer-copyright text-center">Copyright © 2021 ：na
        <a href="https://twitter.com/hinanam3"> @hinanam3</a>
    </div>

</footer>
@endsection
