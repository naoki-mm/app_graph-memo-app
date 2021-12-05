<div class="row">
    <div class="col">
        <div class="form-group mt-4">

            <label class="form-label" for="title">
                タイトル<sup class="text-danger ml-1" style="font-size: 60%">(必須)</sup>
            </label>

                <textarea
                    id="title"
                    name="title"
                    class="form-control @error('title') is-invalid @enderror"
                    rows="2"
                    autocomplete="off"
                >{{ old('title', $graph->title ?? '') }}</textarea>

            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <small class="grey-text">50字以内で入力してください</small>
        </div>

        <div class="form-group">

            <label class="form-label" for="memo">
                メモ
            </label>

                <textarea
                    id="memo"
                    name="memo"
                    class="form-control @error('memo') is-invalid @enderror"
                    rows="7"
                    autocomplete="off"
                >{{ old('memo', $graph->memo ?? '') }}</textarea>

            @error('memo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <small class="grey-text">300字以内で入力してください</small>
        </div>

        <div class="form-group">
            <graph-tags-input
                :initial-tags='@json($tags ?? [])'
                :autocomplete-items='@json($all_tags ?? [])'>
            </graph-tags-input>

            @if ($errors->has('tags'))
                <span class="text-danger">
                    <small><strong>{{ $errors->first('tags') }}</strong></small>
                </span>
            @endif
        </div>

        <button v-if="isEditOperation" class="mt-4 btn btn-block btn-custom">
            データを変更する
        </button>
        <button v-else class="mt-4 btn btn-block btn-custom">
            データを登録する
        </button>
    </div>
</div>
