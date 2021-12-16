@extends('layouts.top_layout')

@section('title')

@endsection

@section('content')

    @component('components.common.top_header', ['login_view_flag' => false, 'register_view_flag' => false])
        @slot('header_content')
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
                                    PLOTemo (プロッテモ) は画像・PDFなどのグラフデータポイントを効率的に読み取り、クラウド上にメモのように保存・一元管理が可能です。検索機能も備え、欲しいデータとすぐに出会えます。
                                </h5>

                                {{-- 認証系 --}}
                                <div class="ml-2">
                                    <a href="{{ route('register') }}" class="h5 btn btn-success mr-4 font-weight-bold" style="padding: 15px 45px">無料で登録</a>
                                    <a href="#" class="h5 btn btn-outline-success font-weight-bold bg-white" style="padding: 15px 45px">機能を試す</a>
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
        @endslot
    @endcomponent

    {{-- メインレイアウト --}}
    <main>
        {{-- 機能紹介 --}}
        <div class="container">
            <div class="row my-4 justify-content-center">
                <div class="col-md-12 text-center">
                        <h1 class="border-bottom">ー できること ー</h1>
                </div>
            </div>

            <div class="row py-1 justify-content-center mb-3">
                <div class="pl-5 col-6 align-self-center">
                    <h2 class="mb-4 text-success">グラフ画像の読み取りを効率的に<i class="far fa-lightbulb text-success ml-3"></i></h2>
                    <h4 class="font-weight-light">目視で行っていたグラフ画像の読み取り時間を短縮。グラフ画像上をクリックするだけで、簡単に座標データを取得。もう読み取りミスも起こさない。</h4>
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
                    <h2 class="text-success mb-4"><i class="fas fa-cloud-upload-alt text-success mr-3"></i>データの一元管理・再利用</h2>
                    <h4 class="font-weight-light">読み取ったデータはメモ形式で保存でき、クラウド上で一元管理が可能。一度読み取ったデータが再利用でき、エビデンスとしても活用できる。</h4>
                </div>
            </div>

            <div class="row py-1 justify-content-center mb-3">
                <div class="pl-5 col-6 align-self-center">
                    <h2 class="text-success mb-4">スマートな検索<i class="fas fa-search text-success ml-3"></i></h2>
                    <h4 class="font-weight-light">タグ、お気に入り、キーワード検索、ソートを使えば必要なデータがすぐに見つかる。コピー&ペーストやCSVダウンロードによりすぐに使える。</h4>
                </div>
                <div class="col-6 text-center align-self-center">
                    <img src="https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/Site+Stats-amico.svg"
                        style="max-width: 85%; height: auto">
                </div>
            </div>
        </div>

        {{-- 利用シーン --}}
        <div class="container" style="margin-top: 120px">
            <div class="row my-5 justify-content-center">
                <div class="col-12 text-center mb-5">
                    <h1 class="border-bottom">ー 利用シーン ー</h1>
                </div>

                <div class="col-12 text-left mb-5">
                    <h3 class="font-weight-light">「PLOTemo」はさまざまな業界、シーンで役立ちます。</h3>
                    <h3 class="font-weight-light">下記のようなデータを取得することで、データ分析・予測・比較・設計計算などに活用できます。</h3>

                </div>

                <div class="col-3 text-center align-self-center">
                    <img src="https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/undraw_book_lover_re_rwjy.svg"
                        style="aspect-ratio: 1 / 0.7; width: 100%;">
                    <h4 class="mt-4 font-weight-light">紙の資料</h4>
                </div>
                <div class="col-3 text-center align-self-center">
                    <img src="https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/undraw_online_articles_re_yrkj.svg"
                        style="aspect-ratio: 1 / 0.7; width: 100%;">
                    <h4 class="mt-4 font-weight-light">論文データ</h4>
                </div>
                <div class="col-3 text-center align-self-center">
                    <img src="https://plot-memo-app-laravel.s3.ap-northeast-1.amazonaws.com/logo_image/undraw_alien_science_re_0f8q.svg"
                        style="aspect-ratio: 1 / 0.7; width: 100%;">
                    <h4 class="mt-4 font-weight-light">実験・測定データ</h4>
                </div>
                <div class="col-3 text-center align-self-center">
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
                    <h1 class="border-bottom">ー さあ、今すぐ PLOTemo を始めましょう ー</h1>
                </div>

                <div class="col-12 text-center my-5">
                    <a class="h5 btn btn-success mr-4 font-weight-bold" style="padding: 20px 50px">無料で登録</a>
                    <a class="h5 btn btn-outline-success font-weight-bold bg-white" style="padding: 20px 50px">機能を試す</a>
                    <h4 class="mt-3 ml-3">
                        <a href="{{ route('login') }}" class="border-bottom border-success font-weight-bold">すでにアカウトをお持ちですか？ログイン</a>
                    </h4>
                </div>
            </div>
        </div>
    </main>

    @include('components.common.top_footer', ['login_view_flag' => false, 'register_view_flag' => false])

@endsection
