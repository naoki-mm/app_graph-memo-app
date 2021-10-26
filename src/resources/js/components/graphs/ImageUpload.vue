<template>
    <!-- ファイル選択 or ドロップ時にcanvasを表示 -->
    <div v-if="isImageFile" class="row no-gutters">

        <plot-side-navbar></plot-side-navbar>
        <graph-plot :graph-image='graphImage'></graph-plot>

    </div>

    <!-- ファイル未選択時にドロップ領域を表示 -->
    <div v-else class="card drop_area"
        @dragenter.prevent="checkDragEnterOver"
        @dragover.prevent="checkDragEnterOver"
        @dragleave.prevent="dragLeave"
        @drop.prevent="dropFile"
        :class="{enter_drop_area: isDragEnterOver}"
    >
        <div class="card-body w-100
            d-flex align-items-center justify-content-center text-center"
            style="height: 90vmin">

            <!-- ドロップ領域の表示内容 -->
            <div>
                <div class="d-none d-sm-block">
                    <i class="fas fa-cloud-upload-alt fa-8x mb-4" style="color: #BDBDBD"></i>
                    <p class="h2 drag-drop-info">ここにファイルをドロップ</p>
                    <p class="h4 my-5">または</p>
                </div>
                <label for="graph_image" class="btn btn-success btn-success btn-block" style="font-size: 1.4rem">
                    <i class="fas fa-upload mr-2"></i>ファイルを選択
                </label>
                <input
                    id="graph_image"
                    type="file"
                    name="graph_image"
                    class="d-none"
                    accept="image/png,image/jpeg,image/gif"
                    @change="onGraphImageSelect"
                >
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isDragEnterOver: false,
            isImageFile: false,
            graphImage: null,
        }
    },

    mounted() {
        this.graphImage = new Image();
    },

    methods: {
        // ドロップ領域にファイルあり&マウスホバー時にCSSをアクティブなスタイルに変更する。
        checkDragEnterOver(e){
            //ファイルではなく、html要素がドラッグされた時は処理を中止
            if (e.dataTransfer.types == "text/plain") {
                return false
            }
            this.isDragEnterOver = true;
        },

        // ファイルがドロップ領域外に出た時にCSSを初期のスタイルに変更する。
        dragLeave() {
            this.isDragEnterOver = false;
        },

        // ドロップ時にCSSを初期スタイルに戻す&画像オブジェクトの取得。
        dropFile(e) {
            this.isImageFile = true;
            this.isDragEnterOver = false;

            // ドロップした画像オブジェクトの取得
            const files = e.dataTransfer.files;
            this.graphImageUpload(files);
        },

        // ファイル選択した画像オブジェクトの取得。
        onGraphImageSelect(e) {
            this.isImageFile = true;

            const files = e.target.files;
            this.graphImageUpload(files);
        },

        // アップロードしたグラフ画像をImageインスタンスに設定する。
        graphImageUpload (files) {
            if(files.length > 0) {
                const file = files[0];
                const reader = new FileReader();

                // 画像ファイルの読み込み完了後にresultにセットされたデータを格納
                reader.onload = (e) => {
                    this.graphImage.src = e.target.result;
                };
                // 画像ファイルの読み込み処理
                reader.readAsDataURL(file);

                // サイドバーを削除してグラフ読み取りUIを表示させるためのイベント
                this.$emit("image-upload", this.isImageFile);
            }
        },
    }
}
</script>

<style scoped>
/* ドロップエリアの初期設定 */
.drop_area {
    border: dashed 3px #BDBDBD;
    color: #BDBDBD;
}

/* ドロップエリアがアクティブになった時の設定 */
.enter_drop_area {
    border: dashed 3px #42A5F5;
    color: #42A5F5;
    background-color: #E3F2FD;
}

/* .graph-plot {
    margin-left: calc(((100vw - 100%) / 2) * -1);
    margin-right: calc(((100vw - 100%) / 2) * -1);
} */
</style>
