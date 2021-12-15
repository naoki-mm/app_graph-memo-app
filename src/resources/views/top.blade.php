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
                            グラフ画像の読み取り＆管理
                        </h1>

                        <hr class="hr-light my-4">

                        {{-- サブタイトル --}}
                        <h5 class="mb-5">
                            グラフ画像のプロットデータを読み取り、メモのように保存。<br>検索機能も備えているため、いつでもデータを取得できます。
                        </h5>

                        {{-- 認証系 --}}
                        <div class="ml-2">
                            <a class="h6 btn btn-success mr-3" style="padding: 12px 40px">無料で登録</a>
                            <a class="h6 btn btn-outline-success bg-white" style="padding: 12px 40px">機能を試す</a>
                            <h6 class="mt-3 ml-5">
                                <a href="{{ route('login') }}" class="border-bottom border-success">すでにアカウトをお持ちですか？ログイン</a>
                            </h6>
                        </div>
                    </div>

                    {{-- イラスト --}}
                    <div class="col-md-5 col-xl-5 wow fadeInRight" data-wow-delay="0.3s" style="margin-top: 80px">
                        <img src="https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/Graphic+chart_Monochromatic.svg"
                            class="float-right" style="max-width: 60%; height: auto; filter: drop-shadow(-17px 16px 5px #353434);">
                        <img src="https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/Notes_Monochromatic.svg"
                            class="float-left mt-3" style="max-width: 80%; height: auto; filter: drop-shadow(-17px 16px 7px #353434);">
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

{{-- メインレイアウト --}}
<main>
    <div class="container">
        <div class="row py-5">
            <div class="col-md-12 text-center">
                <p></p>
            </div>
        </div>
    </div>
</main>

@endsection
