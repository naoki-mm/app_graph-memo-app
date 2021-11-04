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

<div class="axis-setting-nav"
    v-show="isActiveSetAxisX">
    <ol class="mt-5 pl-3 mb-2">
        <li>グラフ上で横軸の最小値、最大値を順にクリックしてください。
            <i class="fas fa-check-circle"
                :class="[isCompleteSetAxisX ? 'green-text': 'grey-text']"
            ></i>
        </li>

        <li class="mt-3">
            <p class="mb-2">
                </p>軸の値を下記に入力してください。
                <i class="fas fa-check-circle"
                    :class="[xAxisMinValue && xAxisMaxValue ? 'green-text': 'grey-text']"
                ></i>
            </p>
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
                        v-model="xAxisMinValue"
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
                        v-model="xAxisMaxValue"
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

<div class="axis-setting-nav"
    v-show="isActiveSetAxisY">
    <ol class="mt-5 pl-3 mb-2">
        <li>グラフ上で縦軸の最小値、最大値を順にクリックしてください。
            <i class="fas fa-check-circle"
                :class="[isCompleteSetAxisY ? 'green-text': 'grey-text']"
            ></i>
        </li>

        <li class="mt-3">
            <p class="mb-2">軸の値を下記に入力してください。
                <i class="fas fa-check-circle"
                    :class="[yAxisMinValue && yAxisMaxValue ? 'green-text': 'grey-text']"
                ></i>
            </p>
            {{-- 数値の入力フォーム --}}
            <div class="row" style="height: 50px">
                <div class="col pr-2">
                    <div class="md-form mt-0">

                    <label class="form-label ml-1 mb-1" for="y_axis_min">
                        y min
                    </label>

                    <input
                        type="number"
                        id="y_axis_min"
                        name="y_axis_min"
                        class="form-control @error('y_axis_min') is-invalid @enderror"
                        autocomplete="off"
                        value="{{ old('y_axis_min') }}"
                        required
                        v-model="yAxisMinValue"
                    >
                    @error('y_axis_min')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>

                <div class="col pl-2">
                    <div class="md-form mt-0">

                    <label class="form-label ml-1 mb-1" for="y_axis_max">
                        y max
                    </label>

                    <input
                        type="number"
                        id="y_axis_max"
                        name="y_axis_max"
                        class="form-control @error('y_axis_max') is-invalid @enderror"
                        autocomplete="off"
                        value="{{ old('y_axis_max') }}"
                        required
                        v-model="yAxisMaxValue"
                    >
                    @error('y_axis_max')
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
