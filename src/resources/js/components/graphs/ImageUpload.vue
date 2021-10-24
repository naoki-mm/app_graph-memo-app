<template>
    <!-- ファイル選択 or ドロップ時にcanvasを表示 -->
    <div v-if="isDropFile" class="card">
        <div class="card-body w-100
            d-flex align-items-center justify-content-center text-center"
            style="height: 90vmin">

            <canvas ref="canvas" class="w-100 h-100"
            ></canvas>

        </div>
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
                <label for="input_file" class="btn btn-success btn-success btn-block" style="font-size: 1.4rem">
                    <i class="fas fa-upload mr-2"></i>ファイルを選択
                </label>
                <input type="file" id="input_file" style="display:none;"
                >
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            // ドラッグ&ドロップ
            isDragEnterOver: false,
            isDropFile: false,
            dropGraphImage: null,

            // canvas
            canvas: null,
            canvasWidth: null,
            canvasHeight: null,
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

        // ドロップ時にCSSを初期スタイルに戻す&canvasに画像を設定。
        async dropFile(e) {
            // ドロップした画像オブジェクトの取得
            let files = e.dataTransfer.files;

            this.dropGraphImage = new Image();

            if(files.length > 0) {
                const file = files[0];
                const reader = new FileReader();

                // 画像ファイルの読み込み完了後にresultにセットされたデータを格納
                reader.onload = (e) => {
                    this.dropGraphImage.src = e.target.result;
                };
                 // 画像ファイルの読み込み処理
                reader.readAsDataURL(file);
            }

            await (this.isDropFile = true);
            this.isDragEnterOver = false;

            this.canvas = this.$refs.canvas;

            if(this.canvas) {
                // イメージインスタンスの作成
                this.dropGraphImage.onload = () => {

                    // 親要素の値を取得
                    this.canvasWidth = this.canvas.parentElement.clientWidth;
                    this.canvasHeight = this.canvas.parentElement.clientHeight;

                    // キャンバスサイズを親要素のサイズに設定
                    this.canvas.width = this.canvasWidth;
                    this.canvas.height = this.canvasHeight;

                    const ctx = this.canvas.getContext("2d");

                    // キャンバスへの画像読み込み
                    ctx.drawImage(this.dropGraphImage, 0, 0, this.canvasWidth, this.canvasHeight);
                }
            }
        },
    }
}
</script>

<style>
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
