<template>
    <!-- ファイル選択 or ドロップ時にcanvasを表示 -->
    <div v-if="isDropFile">

    </div>

    <!-- ファイル未選択時にドロップ領域を表示 -->
    <div v-else class="card drop_area"
        @dragenter.prevent="checkDragEnterOver"
        @dragover.prevent="checkDragEnterOver"
        @dragleave.prevent="dragLeave"
        @drop.prevent="dropFile"
        :class="{enter_drop_area: isDragEnterOver}"
    >
        <!-- カードレイアウト -->
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
            isDragEnterOver: false,
            isDropFile: false,
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

        // ドロップ領域内でファイルをドロップした時にCSSを初期スタイルに戻す&ファイル情報の取得する。
        dropFile(e) {
            console.log(e.dataTransfer.files)
            this.isDropFile = true;
            this.isDragEnterOver = false;
        }
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
