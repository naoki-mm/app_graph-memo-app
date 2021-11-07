<template>
    <!-- canvas -->
    <div class="col-12 col-lg-9 pl-lg-2 pt-2 pt-lg-0">

        <div class="card">
            <div class="canvas-card card-body w-100
                d-flex align-items-center justify-content-center text-center"
                style="height: 90vmin">

                <canvas
                    id="axsis-set-layer"
                    ref="axisSetCanvas"
                    class="w-100 h-100"
                    v-show="getShowCanvasEventDetect.isAxisSetCanvas"
                    @click="setAxis"
                    >
                </canvas>

                <canvas
                    id="plot-layer"
                    ref="plotCanvas"
                    class="w-100 h-100"
                    v-show="getShowCanvasEventDetect.isPlotCanvas"
                    @click="graphPlot"
                    >
                </canvas>

                <canvas
                    id="background-grah-image-layer"
                    ref="graphImageCanvas"
                    class="w-100 h-100"
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
        axisSettingDetect: {
            type: Object,
            default: () => ({
                isActiveX: true,
                isActiveY: false,
            })
        },

        showCanvasEventDetect: {
            type: Object,
            default: () => ({
                isAxisSetCanvas: true,
                isPlotCanvas: false,
                isSetSave: false,
            })
        },

        axisValue: {
            type: Object,
            default: () => ({
                xMin: '',
                xMax: '',
                yMin: '',
                yMax: '',
            })
        },
    },

    data() {
        return {
            canvas: {
                graphImageCanvas: null,
                plotCanvas: null,
                axisSetCanvas: null,
                size: {
                    drawWidth: null,
                    drawHeight: null,
                },
                context: {
                    graphImage: null,
                    plot: null,
                    axisSetting: null,
                },

            },
            clickCount: {
                X: 0,
                Y : 0,
            },

            plotPoint: {
                X: 0,
                Y: 0,
            },

            // clickXmin: null,
            // clickXmax: null,
            // clickXdiff: 0,

            // realGraphXmin: 0,
            // realGraphXmax: 0,

            // realGraphXdiff: 0,
        }
    },

    computed: {
        getAxisSettingDetect() {
            return this.axisSettingDetect;
        },

        getShowCanvasEventDetect() {
            return this.showCanvasEventDetect;
        },

        getAxisValue() {
            return this.axisValue;
        },
    },

    mounted() {
        // canvas要素を取得。
        this.canvas.graphImageCanvas = this.$refs.graphImageCanvas;
        this.canvas.axisSetCanvas = this.$refs.axisSetCanvas;
        this.canvas.plotCanvas = this.$refs.plotCanvas;

        // キャンバスの表示サイズを親要素のサイズに設定
        this.setCanvasDisplaySize(this.canvas.graphImageCanvas);
        this.setCanvasDisplaySize(this.canvas.axisSetCanvas);
        this.setCanvasDisplaySize(this.canvas.plotCanvas);

        // キャンバスの描画サイズを変数に代入
        this.canvas.size.drawWidth = this.canvas.graphImageCanvas.width;
        this.canvas.size.drawHeight = this.canvas.graphImageCanvas.height;

        // 画像取得後に実行する処理
        this.graphImage.onload = () => {
            this.canvas.context.graphImage = this.canvas.graphImageCanvas.getContext("2d");
            this.canvas.context.axisSetting = this.canvas.axisSetCanvas.getContext("2d");
            this.canvas.context.plot = this.canvas.plotCanvas.getContext("2d");

            // キャンバスへの画像表示
            this.canvas.context.graphImage.drawImage(this.graphImage, 0, 0, this.canvas.size.drawWidth, this.canvas.size.drawHeight);
        }
},

    methods: {
        // キャンバスの表示サイズのを親要素のサイズに設定
        setCanvasDisplaySize(canvas) {
            canvas.width  = canvas.parentElement.clientWidth;
            canvas.height  = canvas.parentElement.clientHeight;
        },

        setAxis(e) {
            const axisSetPointNumber = 2;

            // canvasのクリック数により、処理を変更
            if(this.clickCountUp() <= axisSetPointNumber) {
                // クリック座標の取得
                this.getClickPoint(e, this.canvas.axisSetCanvas);
                // クリック座標にプロットポインタを描画する。
                this.showPlotPoint(this.canvas.context.axisSetting);
            } else {
                alert('軸設定を変更する場合は、リセットボタンを押してください。');
            }
        },

        resetDrawingSettingAxis() {
            if(this.$root.axisSettingDetect.isResetClick) {
                // canvasのクリック数を初期化
                this.clickCount.X = 0;
                this.clickCount.Y = 0;

                // リセットフラグを初期化
                this.$root.axisSettingDetect.isResetClick = false;

                // 軸設定の描画をリセット
                this.canvas.context.axisSetting.clearRect(0, 0, this.canvas.graphImageCanvas.width, this.canvas.graphImageCanvas.height);
            }
        },

        clickCountUp() {
            if(this.getAxisSettingDetect.isActiveX) {
                this.clickCount.X++;
                return this.clickCount.X;
            }
            if(this.getAxisSettingDetect.isActiveY) {
                this.clickCount.Y++;
                return this.clickCount.Y;
            }
        },

        graphPlot(e) {
            // クリックの座標取得
            this.getClickPoint(e, this.canvas.plotCanvas);
            // クリック座標にプロットポインタを描画する。
            this.showPlotPoint(this.canvas.context.plot);
        },
        getClickPoint(e, canvas) {
            // クリック時の親要素のサイズを取得して、canvasの表示サイズとして扱う。
            let displayCanvasWidth = canvas.parentElement.clientWidth;
            let displayCanvasHeight = canvas.parentElement.clientHeight;

            // canvasの左上角の座標を取得
            let canvasTopLeftCorner = canvas.getBoundingClientRect();

            // クリックした座標(画面左上が基準)をcanvasの座標(canvas描画領域の左上が基準)に変換
            let clickX = e.clientX - canvasTopLeftCorner.left;
            let clickY = e.clientY - canvasTopLeftCorner.top;

            // canvasの描画領域と表示領域の差異の軸補正係数
            let xAxisAdjust = this.canvas.size.drawWidth / displayCanvasWidth;
            let yAxisAdjust = this.canvas.size.drawHeight / displayCanvasHeight;

            // クリックした座標をcanvas内の描画値に換算
            this.plotPoint.X = clickX * xAxisAdjust;
            this.plotPoint.Y = clickY * yAxisAdjust;

            // this.convertPlotPoint();
        },

        showPlotPoint(context) {

            // 円の描画開始角度 0[rad]
            const startAngle = 0;
            // 円の描画終了角度 2π[rad]
            const endAngle = Math.PI * 2;
            // プロットポインタのサイズ
            const plotPointerSize = 5;

            // 描画スタイルの設定
            context.fillStyle = "rgba(200, 0, 0, 0.8)";
            // クリックした箇所に円を表示
            context.beginPath();
            context.arc(this.plotPoint.X, this.plotPoint.Y, plotPointerSize, startAngle, endAngle, false);
            context.fill();

            // 軸設定時のプロット設定
            if(this.getShowCanvasEventDetect.isAxisSetCanvas) {
                this.showAxisNavText(context);
            }
        },

        showAxisNavText(context) {
            const axisSetCountMinNumber = 1;
            const axisSetCountMaxNumber = 2;
            const textPositionAdjust = 10;
            // テキスト描画コンテキストの設定変数
            context.font = "20px 'ＭＳ ゴシック'";
            context.textAlign = "left";

            // x軸のプロット設定
            if(this.getAxisSettingDetect.isActiveX) {
                context.textBaseline = "top";
                // クリック数により、テキストの表示を切り替える
                if(this.clickCount.X === axisSetCountMinNumber) {
                    context.fillText("x min",this.plotPoint.X + textPositionAdjust, this.plotPoint.Y);
                }
                if(this.clickCount.X === axisSetCountMaxNumber) {
                    context.fillText("x max",this.plotPoint.X + textPositionAdjust, this.plotPoint.Y);
                    this.$emit("complete-set-axis-x", this.clickCount.X);
                }
            }
            // y軸のプロット設定
            if(this.getAxisSettingDetect.isActiveY) {
                context.textBaseline = "bottom";
                // クリック数により、テキストの表示を切り替える
                if(this.clickCount.Y === axisSetCountMinNumber) {
                    context.fillText("y min",this.plotPoint.X + textPositionAdjust, this.plotPoint.Y - textPositionAdjust);
                }
                if(this.clickCount.Y === axisSetCountMaxNumber) {
                    context.fillText("y max",this.plotPoint.X + textPositionAdjust, this.plotPoint.Y - textPositionAdjust);
                    this.$emit("complete-set-axis-y", this.clickCount.Y);
                }
            }
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
canvas{
    position: absolute;
}
#plot-layer {
    z-index: 3;
}
#axsis-set-layer {
    z-index: 2;

}
#background-grah-image-layer {
    z-index: 1;
}
</style>
