<template>
    <!-- canvas -->
    <div class="col-12 col-lg-9 pl-lg-2 pt-2 pt-lg-0">

        <div class="card">
            <div class="canvas-card card-body w-100
                d-flex align-items-center justify-content-center text-center"
                style="height: 90vmin">

                <canvas
                    ref="axisSetCanvas"
                    class="w-100 h-100 bg-secondary"
                    v-show="isAxisSetCanvas"
                    >
                </canvas>

                <canvas
                    ref="plotCanvas"
                    class="w-100 h-100 bg-secondary"
                    v-show="isPlotCanvas"
                    @click="graphPlot"
                    >
                </canvas>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        graphImage: {
            default: null,
        },
        isActiveSetAxisX: {
            type: Boolean,
            default: true,
        },
        isActiveSetAxisY: {
            type: Boolean,
            default: false,
        },
        isAxisSetCanvas: {
            type: Boolean,
            default: true,
        },
        isPlotCanvas: {
            type: Boolean,
            default: false,
        },
        isSetSave: {
            type: Boolean,
            default: false,
        },
    },

    computed: {
        setAxisX() {
            return this.isActiveSetAxisX
        },

        setAxisY() {
            return this.isActiveSetAxisY
        },

        setAxisCanvas() {
            return this.isAxisSetCanvas
        },

        setPlotCanvas() {
            return this.isPlotCanvas
        },

        setSave() {
            return this.isSetSave
        },
    },

    data() {
        return {
            plotCanvas: null,
            axisSetCanvas: null,
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

            plotContext: null,
            axisSetContext: null,
        }
    },

    mounted() {
        // canvas要素を取得。
        this.axisSetCanvas = this.$refs.axisSetCanvas;
        this.plotCanvas = this.$refs.plotCanvas;

        // キャンバスの描画サイズを親要素のサイズに設定
        this.axisSetCanvas.width  = this.axisSetCanvas.parentElement.clientWidth;
        this.axisSetCanvas.height = this.axisSetCanvas.parentElement.clientHeight;
        this.plotCanvas.width  = this.plotCanvas.parentElement.clientWidth;
        this.plotCanvas.height = this.plotCanvas.parentElement.clientHeight;

        // 描画サイズを変数に代入
        this.drawCanvasWidth = this.plotCanvas.width;
        this.drawCanvasHeight = this.plotCanvas.height;

        // 画像取得後に実行する処理
        this.graphImage.onload = () => {

            this.axisSetcontext = this.axisSetCanvas.getContext("2d");
            this.plotContext = this.plotCanvas.getContext("2d");

            // キャンバスへの画像表示
            this.axisSetcontext.drawImage(this.graphImage, 0, 0, this.drawCanvasWidth, this.drawCanvasHeight);
            this.plotContext.drawImage(this.graphImage, 0, 0, this.drawCanvasWidth, this.drawCanvasHeight);
        }
    },

    methods: {
        graphPlot(e) {
            this.getClickPoint(e)
            this.showPlotPoint()
        },
        getClickPoint(e) {

            // クリック時の親要素のサイズを取得して、canvasの表示サイズとして扱う。
            let displayCanvasWidth = this.plotCanvas.parentElement.clientWidth;
            let displayCanvasHeight = this.plotCanvas.parentElement.clientHeight;

            // canvasの左上角の座標を取得
            let canvasTopLeftCorner = this.plotCanvas.getBoundingClientRect();

            // クリックした座標(画面左上が基準)をcanvasの座標(canvas描画領域の左上が基準)に変換
            this.clickX = e.clientX - canvasTopLeftCorner.left;
            this.clickY = e.clientY - canvasTopLeftCorner.top;

            // canvasの描画領域と表示領域の差異の軸補正係数
            let xAxisAdjust = this.drawCanvasWidth / displayCanvasWidth;
            let yAxisAdjust = this.drawCanvasHeight / displayCanvasHeight;

            // クリックした座標をcanvas内の描画値に換算
            this.plotPointX = this.clickX * xAxisAdjust;
            this.plotPointY = this.clickY * yAxisAdjust;

            // this.convertPlotPoint();
        },

        showPlotPoint() {

            // 円の描画開始角度 0[rad]
            const startAngle = 0;
            // 円の描画終了角度 2π[rad]
            const endAngle = Math.PI * 2;
            // プロットポインタのサイズ
            const plotPointerSize = 5;

            // 描画スタイルの設定
            this.plotContext.fillStyle = "rgba(200, 0, 0, 0.8)";
            // クリックした箇所に円を表示
            this.plotContext.beginPath();
            this.plotContext.arc(this.plotPointX, this.plotPointY, plotPointerSize, startAngle, endAngle, false);
            this.plotContext.fill();
        },

        showPlotData() {
            // this.SetGraphAxis();
        },

        // convertPlotPoint() {
        //     let GraphXaxisMin
        // },

        // SetGraphAxis(e) {
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
        // }

    }
}
</script>

<style>
.canvas-card {
    padding: 0px;
}
</style>
