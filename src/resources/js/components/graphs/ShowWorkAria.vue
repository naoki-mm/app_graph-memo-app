<template>
    <div class="row no-gutters">
        <!-- グラフ読み取りサイドバー -->
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body sidebar-card w-100">

                    <ul class="nav nav-tabs nav-pills" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="axis-tab" data-toggle="tab" href="#axis" role="tab" aria-controls="axis"
                            aria-selected="true">軸設定</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="plot-tab" data-toggle="tab" href="#plot" role="tab" aria-controls="plot"
                            aria-selected="false">プロット</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="save-tab" data-toggle="tab" href="#save" role="tab" aria-controls="save"
                            aria-selected="false">保存</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="axis" role="tabpanel" aria-labelledby="axis-tab">
                            <axis-setting></axis-setting>
                        </div>
                        <div class="tab-pane fade" id="plot" role="tabpanel" aria-labelledby="plot-tab">
                            <graph-plot></graph-plot>
                        </div>
                        <div class="tab-pane fade" id="save" role="tabpanel" aria-labelledby="save-tab">
                            <save-plot-data></save-plot-data>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- canvas -->
        <div class="col-12 col-lg-9 pl-lg-2 pt-2 pt-lg-0">
            <div class="card">
                <div class="card-body w-100
                    d-flex align-items-center justify-content-center text-center"
                    style="height: 90vmin">

                    <canvas ref="canvas" class="w-100 h-100"></canvas>

                </div>
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

<style scoped>
@media (max-width: 991.98px) {
    .sidebar-card {
        height: 30vmin;
    }
}

@media (min-width: 991.98px) {
    .sidebar-card{
        height: 90vmin;
    }
}

</style>
