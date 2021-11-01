<template>
    <!-- canvas -->
    <div class="col-12 col-lg-9 pl-lg-2 pt-2 pt-lg-0">

        <div class="card">
            <div class="canvas-card card-body w-100
                d-flex align-items-center justify-content-center text-center"
                style="height: 90vmin">

                <canvas
                    ref="canvas"
                    class="w-100 h-100 bg-secondary"
                    @click="plot"
                    >
                </canvas>

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
            drawCanvasWidth: null,
            drawCanvasHeight: null,

            clickX: 0,
            clickY: 0,
            plotPointX: 0,
            plotPointY: 0,


            clickXmin: null,
            clickXmax: null,
            clickXdiff: 0,

            realGraphXmin: 0,
            realGraphXmax: 0,

            realGraphXdiff: 0,

            context: null,

        }
    },

    mounted() {
        // canvas要素を取得。
        this.canvas = this.$refs.canvas;

        // キャンバスの描画サイズを親要素のサイズに設定
        this.canvas.width  = this.canvas.parentElement.clientWidth;
        this.canvas.height = this.canvas.parentElement.clientHeight;

        // 描画サイズを変数に代入
        this.drawCanvasWidth = this.canvas.width;
        this.drawCanvasHeight = this.canvas.height;

        // 画像取得後に実行する処理
        this.graphImage.onload = () => {

            this.context = this.canvas.getContext("2d");

            // キャンバスへの画像表示
            this.context.drawImage(this.graphImage, 0, 0, this.drawCanvasWidth, this.drawCanvasHeight);
        }
    },

    methods: {
        plot(e) {

            // クリック時の親要素のサイズを取得して、canvasの表示サイズとして扱う。
            let displayCanvasWidth = this.canvas.parentElement.clientWidth;
            let displayCanvasHeight = this.canvas.parentElement.clientHeight;

            // canvasの左上角の座標を取得
            let canvasTopLeftCorner = this.canvas.getBoundingClientRect();

            // クリックした座標(画面左上が基準)をcanvasの座標(canvas描画領域の左上が基準)に変換
            this.clickX = e.clientX - canvasTopLeftCorner.left;
            this.clickY = e.clientY - canvasTopLeftCorner.top;

            // canvasの描画領域と表示領域の差異の軸補正係数
            let xAxisAdjust = this.drawCanvasWidth / displayCanvasWidth;
            let yAxisAdjust = this.drawCanvasHeight / displayCanvasHeight;

            // クリックした座標をcanvas内の描画値に換算
            this.plotPointX = this.clickX * xAxisAdjust;
            this.plotPointY = this.clickY * yAxisAdjust;

            this.showPlotPoint();
        },

        showPlotPoint() {
            // 円の描画開始角度 0[rad]
            const startAngle = 0;
            // 円の描画終了角度 2π[rad]
            const endAngle = Math.PI * 2;
            // プロットポインタのサイズ
            const plotPointerSize = 5;

            // 描画スタイルの設定
            this.context.fillStyle = "rgba(200, 0, 0, 0.8)";
            // クリックした箇所に円を表示
            this.context.beginPath();
            this.context.arc(this.plotPointX, this.plotPointY, plotPointerSize, startAngle, endAngle, false);
            this.context.fill();


        }
        // setXaxisStart(e) {
        //     const rectangle = this.canvas.getBoundingClientRect();

        //     if (!this.clickXmin && !this.clickXmax) {
        //         this.clickXmin = e.clientX;

        //     } else if(!this.clickXmax) {
        //         this.clickXmax = e.clientX;
        //     } else {
        //         return;
        //     }

        //     this.clickXdiff = this.clickXmax - this.clickXmin;

        //     this.realGraphXmin = 0;
        //     this.realGraphXmax = 20;

        //     this.realGraphXdiff = this.realGraphXmax - this.realGraphXmin;

        // },
    }
}
</script>

<style>
.canvas-card {
    padding: 0px;
}
</style>
