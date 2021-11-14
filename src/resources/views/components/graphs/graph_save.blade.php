<div class="row">
    <div class="col">
        <div class="form-group md-form">

            <textarea
                id="title"
                name="title"
                class="form-control md-textarea @error('title') is-invalid @enderror"
                rows="2"
                autocomplete="off"
            ></textarea>

            <label class="form-label" for="title">
                グラフタイトル
            </label>

            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group md-form">

            <textarea
                id="memo"
                name="memo"
                class="form-control md-textarea @error('memo') is-invalid @enderror"
                rows="6"
                autocomplete="off"
            ></textarea>

            <label class="form-label" for="memo">
                メモ
            </label>

            @error('memo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button class="mt-5 btn btn-block btn-primary">
            新規保存する
        </button>

    </div>
</div>
