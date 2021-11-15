<template>
    <!-- ファイル未選択時にドロップ領域を表示 -->
    <div class="card drop_area"
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
                    v-if="!dragSelect"
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
            dragSelect: false,
        }
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
            this.dragSelect = true;

            // ドロップした画像オブジェクトの取得
            const files = e.dataTransfer.files;

            // input要素に設定するためのイベント
            this.$emit("send-file", files);

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
                    this.graphImage = e.target.result;

                    // サイドバーを削除してグラフ読み取りUIを表示させるためのイベント
                    this.$emit("image-upload", this.isImageFile);
                    // グラフ画像をcanvasへ表示させるためのイベント
                    this.$emit("set-image", this.graphImage);
                    this.$emit("call-set-canvas");
                };
                // 画像ファイルの読み込み処理
                reader.readAsDataURL(file);
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

</style>
