@extends('layouts.app')

@section('title')
    ホーム
@endsection

@section('header')
    @include('sub_views.graphs.header')
@endsection

@section('content')

    @component('components.graphs.main_item')

        @slot('main_content')
            <div v-if="!isImageFile">
                <image-upload
                    v-on:image-upload='isImageFile = $event'
                    v-on:set-canvas='graphImage = $event'>
                </image-upload>
            </div>

            <div v-if="isImageFile" class="row no-gutters">
                <!-- グラフ読み取りサイドバー -->
                <div class="col-12 col-lg-3">
                    <div class="card">
                        <div class="card-body graph-sidebar-card w-100">
                            <ul class="nav nav-tabs nav-pills graph-nav-pills" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="axis-tab" data-toggle="tab" href="#axis" role="tab" aria-controls="axis"
                                    aria-selected="true">1. 軸設定</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="plot-tab" data-toggle="tab" href="#plot" role="tab" aria-controls="plot"
                                    aria-selected="false">2. プロット</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="save-tab" data-toggle="tab" href="#save" role="tab" aria-controls="save"
                                    aria-selected="false">3. 保存</a>
                                </li>
                            </ul>

                        {{-- フォーム --}}
                        <form method="POST" action="{{ route('login') }}" class="pt-3">
                            @csrf
                            <div class="tab-content" id="myTabContent">

                                {{-- 軸設定タブの内容 --}}
                                <div class="tab-pane fade show active" id="axis" role="tabpanel" aria-labelledby="axis-tab">

                                    {{-- メールアドレスの入力フォーム --}}
                                    <div class="form-group">
                                        <label class="form-label" for="email">
                                            メールアドレス
                                        </label>

                                        <input
                                            type="text"
                                            id="email"
                                            name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            autocomplete="email"
                                            value="{{ old('email') }}"
                                            placeholder="graph-t@example.com"
                                            required autofocus
                                        >
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>



                                </div>

                                {{-- グラフプロットタブ --}}
                                <div class="tab-pane fade" id="plot" role="tabpanel" aria-labelledby="plot-tab">

                                </div>

                                {{-- 保存タブ --}}
                                <div class="tab-pane fade" id="save" role="tabpanel" aria-labelledby="save-tab">

                                    {{-- 保存ボタン --}}
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-primary">
                                            保存する
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        </div>
                    </div>
                </div>

                <!-- ファイル選択 or ドロップ時にcanvasを表示 -->
                <graph-plot :graph-image='graphImage'></graph-plot>

            </div>
        @endslot

    @endcomponent
@endsection

@section('footer')

@endsection
