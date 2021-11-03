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

            {{--  画像選択 or 画像ドロップ時にcanvasとグラフ読み取りサイドバーを表示  --}}
            <div v-if="isImageFile" class="row no-gutters">
                <!-- グラフ読み取りサイドバー -->
                <div class="col-12 col-lg-3">
                    <div class="card overflow-auto">
                        <div class="card-body graph-sidebar-card w-100">
                            <ul class="nav nav-tabs nav-pills graph-nav-pills" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="axis-tab" data-toggle="tab"
                                        href="#axis" role="tab" aria-controls="axis" aria-selected="true"
                                        v-on:click="isAxisSetCanvas = true; isPlotCanvas = false; isSetSave = false">
                                        軸設定
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="plot-tab" data-toggle="tab"
                                        href="#plot" role="tab" aria-controls="plot" aria-selected="false"
                                        v-on:click="isAxisSetCanvas = false; isPlotCanvas = true; isSetSave = false">
                                        プロット
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="save-tab" data-toggle="tab"
                                        href="#save" role="tab" aria-controls="save" aria-selected="false"
                                        v-on:click="isAxisSetCanvas = false; isPlotCanvas = true; isSetSave = true">
                                        保存
                                    </a>
                                </li>
                            </ul>

                        {{-- フォーム --}}
                        <form method="POST" action="{{ route('login') }}" class="pt-2">
                            @csrf
                            <div class="tab-content" id="myTabContent">

                                {{-- 軸設定タブの内容 --}}
                                <div class="tab-pane fade show active" id="axis" role="tabpanel" aria-labelledby="axis-tab">

                                    <div class="">

                                        <div class="mt-4">
                                            <div class="mb-3 btn rounded-pill btn-block"
                                                :class="{'btn-primary': isActiveSetAxisX}"
                                                v-on:click="isActiveSetAxisX = true; isActiveSetAxisY = false">
                                                横(x)軸を設定する
                                            </div>

                                            <div class="btn rounded-pill btn-block"
                                                :class="{'btn-primary': isActiveSetAxisY}"
                                                v-on:click="isActiveSetAxisY = true; isActiveSetAxisX = false">
                                                縦(y)軸を設定する
                                            </div>
                                        </div>
                                        <ol class="mt-5 pl-3 mb-2">
                                            <li>グラフ上で横軸の最小値、最大値を順にクリックしてください。</li>

                                            <li class="mt-3">
                                                <p class="mb-2">軸の値を下記に入力してください。</p>
                                                {{-- 数値の入力フォーム --}}
                                                <div class="row" style="height: 50px">
                                                    <div class="col pr-2">
                                                        <div class="md-form mt-0">

                                                        <label class="form-label ml-1 mb-1" for="x_axis_min">
                                                            x min
                                                        </label>

                                                        <input
                                                            type="number"
                                                            id="x_axis_min"
                                                            name="x_axis_min"
                                                            class="form-control @error('x_axis_min') is-invalid @enderror"
                                                            autocomplete="off"
                                                            value="{{ old('x_axis_min') }}"
                                                            required
                                                        >
                                                        @error('x_axis_min')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col pl-2">
                                                        <div class="md-form mt-0">

                                                        <label class="form-label ml-1 mb-1" for="x_axis_max">
                                                            x max
                                                        </label>

                                                        <input
                                                            type="number"
                                                            id="x_axis_max"
                                                            name="x_axis_max"
                                                            class="form-control @error('x_axis_max') is-invalid @enderror"
                                                            autocomplete="off"
                                                            value="{{ old('x_axis_max') }}"
                                                            required
                                                        >
                                                        @error('x_axis_max')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        </div>
                                                    </div>
                                                </div>


                                            </li>
                                        </ol>

                                        <div class="text-right mt-3 mr-1">
                                            <div class="btn btn-link mr-0 pr-0">
                                                リセット
                                            </div>
                                            <div class="btn btn-link" style="color: #3490dc">
                                                <strong>OK</strong>
                                            </div>
                                        </div>
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

                <graph-canvas
                    :graph-image='graphImage'
                    :is-active-set-axis-x='isActiveSetAxisX'
                    :is-active-set-axis-y='isActiveSetAxisY'
                    :is-axis-set-canvas='isAxisSetCanvas'
                    :is-plot-canvas='isPlotCanvas'
                    :is-set-save='isSetSave'>
                </graph-canvas>

            </div>
        @endslot

    @endcomponent
@endsection

@section('footer')

@endsection
