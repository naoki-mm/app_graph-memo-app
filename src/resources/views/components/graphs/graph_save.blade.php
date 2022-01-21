<div class="row">
    <div class="col">
        <div class="form-group mt-3 mb-2">

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

        <div class="form-group mb-2">

            <label class="form-label" for="memo">
                メモ
            </label>

                <textarea
                    id="memo"
                    name="memo"
                    class="form-control @error('memo') is-invalid @enderror"
                    rows="4"
                    autocomplete="off"
                >{{ old('memo', $graph->memo ?? '') }}</textarea>

            @error('memo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <small class="grey-text">300字以内で入力してください</small>
        </div>

        <div class="form-group mb-2">
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

        @isset($graph->id)
            @foreach (\GraphIdConst::SAMPLES as $sample_graph_id)
                    @if ($graph->id === $sample_graph_id)
                        <p class="text-danger text-left">
                            <i class="fas fa-exclamation-triangle mr-1 mt-2"></i>このサンプルデータは変更できません。
                            <br>変更機能を試す場合は、メモを新規登録してください。
                        </p>
                    @endif
            @endforeach
        @endisset

        <div class="text-center">
            <button type="submit" v-if="isEditOperation" class="mt-3 btn btn-custom btn-block">
                データを変更する
            </button>

            <button type="submit" v-else class="mt-4 btn btn-block btn-custom">
                データを登録する
            </button>

            <button type="button" class="mt-3 btn btn-outline-success btn-block waves-effect"
                style="height: 37.05px; padding: 6px 12px" onClick="history.back()">
                キャンセル
            </button>
        </div>
    </div>
</div>
