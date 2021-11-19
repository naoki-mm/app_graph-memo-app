<div class="mt-4">
    <div class="mb-3 btn rounded-pill btn-block"
        :class="{'btn-primary': axisSettingDetect.isActiveX}"
        v-on:click="axisSettingDetect.isActiveX = true; axisSettingDetect.isActiveY = false">
        横(x)軸を設定する
    </div>

    <div class="btn rounded-pill btn-block"
        :class="{'btn-primary': axisSettingDetect.isActiveY}"
        v-on:click="axisSettingDetect.isActiveY = true; axisSettingDetect.isActiveX = false">
        縦(y)軸を設定する
    </div>
</div>

<div class="axis-setting-nav"
    v-show="axisSettingDetect.isActiveX">
    <ol class="mt-5 pl-3 mb-3">
        <li>グラフ上で横軸の最小値、最大値を順にクリックしてください。
            <i class="fas fa-check-circle"
                :class="[axisSettingDetect.isCompleteX ? 'green-text': 'grey-text']"
            ></i>
        </li>

        <li class="mt-3">
            <p class="mb-1">
                </p>軸の値を下記に入力してください。
                <i class="fas fa-check-circle"
                    :class="[axisValue.xMin && axisValue.xMax ? 'green-text': 'grey-text']"
                ></i>
            </p>
            {{-- 数値の入力フォーム --}}
            <div class="row" style="height: 50px">
                <div class="col pr-2">
                    <div class="mt-0">

                    <label class="form-label ml-1 mb-1" for="x_min_value">
                        x min
                    </label>
                    <input
                        type="number"
                        step="0.0000001"
                        id="x_min_value"
                        name="x_min_value"
                        class="form-control @error('x_min_value') is-invalid @enderror"
                        autocomplete="off"
                        v-model="axisValue.xMin"
                    >
                    @error('x_min_value')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>

                <div class="col pl-2">
                    <div class="mt-0">

                    <label class="form-label ml-1 mb-1" for="x_max_value">
                        x max
                    </label>
                    <input
                        type="number"
                        step="0.0000001"
                        id="x_max_value"
                        name="x_max_value"
                        class="form-control @error('x_max_value') is-invalid @enderror"
                        autocomplete="off"
                        v-model="axisValue.xMax"
                    >
                    @error('x_max_value')
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
        <div class="btn btn-link mr-2 pr-0"
            style="color: #3490dc; margin-top: 60px"
            v-on:click="resetSettingAxis">
            <strong>軸設定をリセット</strong>
        </div>
    </div>
</div>

<div class="axis-setting-nav"
    v-show="axisSettingDetect.isActiveY">
    <ol class="mt-5 pl-3 mb-3">
        <li>グラフ上で縦軸の最小値、最大値を順にクリックしてください。
            <i class="fas fa-check-circle"
                :class="[axisSettingDetect.isCompleteY ? 'green-text': 'grey-text']"
            ></i>
        </li>

        <li class="mt-3">
            <p class="mb-1">軸の値を下記に入力してください。
                <i class="fas fa-check-circle"
                    :class="[axisValue.yMin && axisValue.yMax ? 'green-text': 'grey-text']"
                ></i>
            </p>
            {{-- 数値の入力フォーム --}}
            <div class="row" style="height: 50px">
                <div class="col pr-2">
                    <div class="mt-0">

                    <label class="form-label ml-1 mb-1" for="y_min_value">
                        y min
                    </label>
                    <input
                        type="number"
                        step="0.0000001"
                        id="y_min_value"
                        name="y_min_value"
                        class="form-control @error('y_min_value') is-invalid @enderror"
                        autocomplete="off"
                        v-model="axisValue.yMin"
                    >
                    @error('y_min_value')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>

                <div class="col pl-2">
                    <div class="mt-0">

                    <label class="form-label ml-1 mb-1" for="y_max_value">
                        y max
                    </label>
                    <input
                        type="number"
                        step="0.0000001"
                        id="y_max_value"
                        name="y_max_value"
                        class="form-control @error('y_max_value') is-invalid @enderror"
                        autocomplete="off"
                        v-model="axisValue.yMax"
                    >
                    @error('y_max_value')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>
            </div>
        </li>
    </ol>

    <div class="text-right mr-1">
        <div class="btn btn-link mr-2 pr-0"
            style="color: #3490dc; margin-top: 60px"
            v-on:click="resetSettingAxis">
            <strong>軸設定をリセット</strong>
        </div>
    </div>
</div>
