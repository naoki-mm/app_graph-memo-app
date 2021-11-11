<div class="mt-2">
    グラフ上をクリックしてプロットデータを取得してください。
</div>

    <div class="row" style="height: 50px">
        <div class="col pr-2">
            <div class="form-group">

            <label class="form-label mt-3" for="plot_data">
                プロットデータ
            </label>

            <textarea
                id="plot_data"
                ref="plotTextArea"
                name="plot_data"
                class="form-control @error('plot_data') is-invalid @enderror"
                rows="15"
                autocomplete="off"
                required
                v-model="showPlotData"
            ></textarea>
            @error('plot_data')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
    </div>
