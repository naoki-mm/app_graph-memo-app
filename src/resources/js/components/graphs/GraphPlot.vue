<template>
    <div class="col-12 col-lg-9 pl-lg-2 pt-2 pt-lg-0">
        <div class="card">
            <div class="card-body w-100
                d-flex align-items-center justify-content-center text-center"
                style="height: 90vmin">

                <canvas ref="canvas" class="w-100 h-100"></canvas>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['graphImage'],

    data() {
        return {
            canvas: null,
            canvasWidth: null,
            canvasHeight: null,
        }
    },

    mounted() {
        // canvas要素を取得。
        this.canvas = this.$refs.canvas;

        // 画像取得後に実行する処理
        this.graphImage.onload = () => {

            // 親要素のサイズを取得
            this.canvasWidth = this.canvas.parentElement.clientWidth;
            this.canvasHeight = this.canvas.parentElement.clientHeight;

            // キャンバスサイズを親要素のサイズに設定
            this.canvas.width = this.canvasWidth;
            this.canvas.height = this.canvasHeight;

            const ctx = this.canvas.getContext("2d");

            // キャンバスへの画像表示
            ctx.drawImage(this.graphImage, 0, 0, this.canvasWidth, this.canvasHeight);
        }
    },

    methods: {

    }
}
</script>

<style>

</style>
