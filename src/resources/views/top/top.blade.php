@extends('layouts.top_layout')

@section('title')

@endsection

@section('content')

    @component('components.common.top_header', ['login_view_flag' => false, 'register_view_flag' => false, 'user_policy_flag' => false, 'privacy_policy_flag' => false])
        @slot('header_content')

            <div class="view" style="background-image: url('https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/top_background.jpg');
                    background-repeat: no-repeat; background-size: cover; background-position: center center;">
                <div class="mask rgba-gradient align-items-center">
                    <div class="container" style="height: 100%!important">
                        <div class="row align-items-center h-100">
                            <div class="col-sm-11 col-md-8 col-lg-7 white-text text-center text-md-left mb-5 wow fadeInLeft align-self-center" data-wow-delay="0.3s" style="margin-top: 57px">

                                {{-- メインタイトル --}}
                                <h1 class="mt-4 mt-sm-5 text-left">
                                    <p class="mb-1">グラフ画像のデータ読み取りを効率化 & メモ管理</p>
                                </h1>

                                <hr class="hr-light my-4">

                                {{-- サブタイトル --}}
                                <h5 class="mb-4 text-left">
                                    PLOTemo (プロッテモ) は画像・PDFなどのグラフデータポイントを効率的に読み取り、クラウド上にメモのように保存・一括管理が可能です。検索や
                                    CSVダウンロードも可能で、欲しいデータがすぐに使えます。
                                </h5>

                                {{-- 認証系 --}}
                                <div class="text-center top-image-layout-contents">
                                    <a href="{{ route('register') }}" class="h5 btn btn-success font-weight-bold" style="padding: 15px 40px">無料で登録</a>
                                    <a href="{{ route('guest.login') }}" class="h5 btn btn-outline-success font-weight-bold bg-white" style="padding: 15px 40px">機能を試す</a>
                                    <h5 class="mt-3 top-image-layout-contents">
                                        <a href="{{ route('login') }}" class="border-bottom border-success font-weight-bold">すでにアカウトをお持ちですか？ログイン</a>
                                    </h5>
                                </div>
                            </div>

                            {{-- イラスト --}}
                            <div class="d-none d-md-block col-md-4 col-lg-5 wow fadeInRight align-self-center" data-wow-delay="0.3s" style="margin-top: 80px">
                                <img src="https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/Site+Stats-amico.svg"
                                    class="float-right mt-5" style="max-width: 90%; height: auto; filter: drop-shadow(30px 25px 3px rgba(0, 0, 0, 0.514));">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endslot
    @endcomponent

    {{-- メインレイアウト --}}
    <main>
        {{-- 機能紹介 --}}
        <div class="container">
            <div class="row my-1 my-sm-4 justify-content-center">
                <div class="col-12 text-center">
                    <h1 class="px-0 border-bottom"><img src="https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/content_logo_1.svg"
                        class="img-main-title pb-1 pb-lg-2"></h1>
                </div>
            </div>

            <div class="row py-1 justify-content-center mb-3">
                <div class="col-11 col-lg-7 col-xl-6 pl-lg-3 pl-xl-5 align-self-center">
                    <h2 class="mb-4 text-success">グラフ画像の読み取りを効率的に<i class="far fa-lightbulb text-success ml-1 ml-md-3"></i></h2>
                    <h4 class="font-weight-light">目視で行っていたグラフ画像の読み取り時間を短縮。グラフ画像上をクリックするだけで、簡単に座標データを取得。もう読み取りミスも起こさない。</h4>
                </div>
                <div class="col-11 col-lg-5 col-xl-6 text-center align-self-center">
                    <img src="https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/Site+Stats-amico.svg"
                        style="max-width: 85%; height: auto">
                </div>
            </div>

            <div class="row py-1 justify-content-center mb-3">
                <div class="col-11 col-lg-5 col-xl-6 text-center align-self-center order-2 order-lg-1">
                    <img src="https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/Site+Stats-amico.svg"
                        style="max-width: 85%; height: auto">
                </div>
                <div class="col-11 col-lg-7 col-xl-6 pl-lg-3 pl-xl-5 align-self-center order-1 order-lg-2">
                    <h2 class="text-success mb-4">データの一括管理・再利用<i class="fas fa-cloud-upload-alt text-success ml-1 ml-md-3"></i></h2>
                    <h4 class="font-weight-light">読み取ったデータはメモ形式で保存でき、クラウド上で一括管理が可能。一度読み取ったデータを再利用でき、作成した資料のエビデンスとしても活用できる。</h4>
                </div>
            </div>

            <div class="row py-1 justify-content-center mb-3">
                <div class="col-11 col-lg-7 col-xl-6 pl-lg-3 pl-xl-5 align-self-center">
                    <h2 class="text-success mb-4">すぐに見つかる、すぐ使える<i class="fas fa-search text-success ml-1 ml-md-3"></i></h2>
                    <h4 class="font-weight-light">タグ、お気に入り、キーワード検索、ソートを使えば必要なデータがすぐに見つかる。プロットデータのCSVダウンロードによりすぐに使える。</h4>
                </div>
                <div class="col-11 col-lg-5 col-xl-6 text-center align-self-center">
                    <img src="https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/Site+Stats-amico.svg"
                        style="max-width: 85%; height: auto">
                </div>
            </div>
        </div>

        {{-- 利用シーン --}}
        <div class="container" style="margin-top: 120px">
            <div class="row my-5 justify-content-center">
                <div class="col-12 text-center mb-5">
                    <h1 class="px-0 border-bottom"><img src="https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/content_logo_2.svg"
                        class="img-main-title pb-1 pb-lg-2"></h1>
                </div>

                <div class="col-12 text-left mb-5">
                    <h3 class="font-weight-light">「PLOTemo」はさまざまな業界、シーンで役立ちます。</h3>
                    <h3 class="font-weight-light">下記のようなデータを取得することで、データ分析・予測・比較・設計計算などに活用できます。</h3>

                </div>

                <div class="col-6 col-md-3 text-center align-self-center">
                    <img src="https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/undraw_book_lover_re_rwjy.svg"
                        style="aspect-ratio: 1 / 0.7; width: 100%;">
                    <h4 class="mt-4 font-weight-light">紙の資料</h4>
                </div>
                <div class="col-6 col-md-3 text-center align-self-center">
                    <img src="https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/undraw_online_articles_re_yrkj.svg"
                        style="aspect-ratio: 1 / 0.7; width: 100%;">
                    <h4 class="mt-4 font-weight-light">論文データ</h4>
                </div>
                <div class="col-6 col-md-3 text-center align-self-center">
                    <img src="https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/undraw_alien_science_re_0f8q.svg"
                        style="aspect-ratio: 1 / 0.7; width: 100%;">
                    <h4 class="mt-4 font-weight-light">実験・測定データ</h4>
                </div>
                <div class="col-6 col-md-3 text-center align-self-center">
                    <img src="https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/undraw_report_re_f5n5.svg"
                        style="aspect-ratio: 1 / 0.7; width: 100%;">
                    <h4 class="mt-4 font-weight-light">データシート</h4>
                </div>

            </div>
        </div>

        {{-- 認証系 --}}
        <div class="container mb-5" style="margin-top: 120px">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <h1 class="border-bottom">ー さあ、今すぐ無料で始めましょう ー</h1>
                </div>

                <div class="col-12 text-center my-4">

                    <h4 class="mb-3">全ての機能が無料で使えます。</h4>

                    <a class="h5 btn btn-success font-weight-bold" href="{{ route('register') }}" style="padding: 20px 50px">無料で登録</a>
                    <a class="h5 btn btn-outline-success font-weight-bold bg-white" href="{{ route('guest.login') }}" style="padding: 20px 50px">機能を試す</a>
                    <h4 class="mt-3 top-image-layout-contents">
                        <a href="{{ route('login') }}" class="border-bottom border-success font-weight-bold">すでにアカウトをお持ちですか？ログイン</a>
                    </h4>
                </div>
            </div>
        </div>
    </main>

    @include('components.common.top_footer', ['login_view_flag' => false, 'register_view_flag' => false])

@endsection
