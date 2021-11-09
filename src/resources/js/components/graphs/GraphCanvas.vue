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

        graphPlotPoint: {
            type: Object,
            default: () => ({
                data: '',
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
            axisSetting: {
                clickCount: {
                    X: 0,
                    Y: 0,
                },
                value: {
                    X: [],
                    Y: [],
                },
            },


            plotPoint: {
                X: 0,
                Y: 0,
            },

            convertPlotData: {
                X: 0,
                Y: 0,
            },
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
        getGraphPlotPoint() {
            return this.graphPlotPoint;
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
                // 軸設定時のプロット設定
                this.showAxisNavText(this.canvas.context.axisSetting);
                // プロットした各軸のmin,maxのデータを配列に格納
                if(this.getAxisSettingDetect.isActiveX) {
                    this.axisSetting.value.X.push({x:this.plotPoint.X, y:this.plotPoint.Y});
                }
                if(this.getAxisSettingDetect.isActiveY) {
                    this.axisSetting.value.Y.push({x:this.plotPoint.X, y:this.plotPoint.Y});
                }

            } else {
                alert('軸設定を変更する場合は、リセットボタンを押してください。');
            }
        },

        resetDrawingSettingAxis() {
            if(this.$root.axisSettingDetect.isResetClick) {
                // canvasのクリック数を初期化
                this.axisSetting.clickCount.X = 0;
                this.axisSetting.clickCount.Y = 0;

                this.axisSetting.value.X = [];
                this.axisSetting.value.Y = [];

                // リセットフラグを初期化
                this.$root.axisSettingDetect.isResetClick = false;

                // 軸設定の描画をリセット
                this.canvas.context.axisSetting.clearRect(0, 0, this.canvas.graphImageCanvas.width, this.canvas.graphImageCanvas.height);
            }
        },

        clickCountUp() {
            if(this.getAxisSettingDetect.isActiveX) {
                this.axisSetting.clickCount.X++;
                return this.axisSetting.clickCount.X;
            }
            if(this.getAxisSettingDetect.isActiveY) {
                this.axisSetting.clickCount.Y++;
                return this.axisSetting.clickCount.Y;
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
                if(this.axisSetting.clickCount.X === axisSetCountMinNumber) {
                    context.fillText("x min",this.plotPoint.X + textPositionAdjust, this.plotPoint.Y);
                }
                if(this.axisSetting.clickCount.X === axisSetCountMaxNumber) {
                    context.fillText("x max",this.plotPoint.X + textPositionAdjust, this.plotPoint.Y);
                    this.$emit("complete-set-axis-x", this.axisSetting.clickCount.X);
                }
            }
            // y軸のプロット設定
            if(this.getAxisSettingDetect.isActiveY) {
                context.textBaseline = "bottom";
                // クリック数により、テキストの表示を切り替える
                if(this.axisSetting.clickCount.Y === axisSetCountMinNumber) {
                    context.fillText("y min",this.plotPoint.X + textPositionAdjust, this.plotPoint.Y - textPositionAdjust);
                }
                if(this.axisSetting.clickCount.Y === axisSetCountMaxNumber) {
                    context.fillText("y max",this.plotPoint.X + textPositionAdjust, this.plotPoint.Y - textPositionAdjust);
                    this.$emit("complete-set-axis-y", this.axisSetting.clickCount.Y);
                }
            }
        },

        graphPlot(e) {
            // クリックの座標取得
            this.getClickPoint(e, this.canvas.plotCanvas);
            // クリック座標にプロットポインタを描画する。
            this.showPlotPoint(this.canvas.context.plot);
            // ユーザーが設定したグラフ画像の軸を基準に、プロットポイントの座標変換を行う。
            this.setConvertPlotData();
            // 桁数の調整
            this.setDigits();
            // プロットデータを配列に格納して親データに渡す。
            this.setArrayPlotData();
        },

        setArrayPlotData() {
            let currentGraphPlot = this.getGraphPlotPoint;
            currentGraphPlot.data.push({x: this.convertPlotData.X, y: this.convertPlotData.Y});
            this.$emit("graph-plot", currentGraphPlot);
        },

        setConvertPlotData() {
            // 軸設定プロット値を各変数に代入
            let axisSettingPointXmax = this.axisSetting.value.X[1];
            let axisSettingPointXmin = this.axisSetting.value.X[0];
            let axisSettingPointYmax = this.axisSetting.value.Y[1];
            let axisSettingPointYmin = this.axisSetting.value.Y[0];

            const exponent = 2;
            // 各x,y成分を実際のグラフ軸スケールする係数（canvasとグラフ画像軸に角度がある場合も考慮）。
            let scaleAdjustValueX = this.getAxisScaleAdjustValue(exponent, this.getAxisValue.xMax, this.getAxisValue.xMin, axisSettingPointXmax, axisSettingPointXmin);
            let scaleAdjustValueY = this.getAxisScaleAdjustValue(exponent, this.getAxisValue.yMax, this.getAxisValue.yMin, axisSettingPointYmax, axisSettingPointYmin);

            // プロットデータの斜辺の長さ
            let plotHypotenuse = Math.sqrt(Math.pow((this.plotPoint.X - axisSettingPointXmin.x), exponent) + Math.pow((this.plotPoint.Y - axisSettingPointYmin.y), exponent));

            // グラフ画像の軸に対するプロットポイントの角度
            let plotPointAngle = this.getPlotPointAngle(axisSettingPointXmax, axisSettingPointXmin);

            // プロットデータの斜辺に対する対辺と隣辺を計算。
            let plotHypotenuseSin = plotHypotenuse * Math.sin(plotPointAngle);
            let plotHypotenuseCos = plotHypotenuse * Math.cos(plotPointAngle);

            // 対辺と隣辺に軸補正係数を掛けて, プロットデータの変換値を計算してdataにセット。
            this.convertPlotData.X = plotHypotenuseCos * scaleAdjustValueX;
            this.convertPlotData.Y = plotHypotenuseSin * scaleAdjustValueY;
        },

        setDigits() {
            const plotPointRoundDigits = 3;
            this.convertPlotData.X = this.convertPlotData.X.toFixed(plotPointRoundDigits);
            this.convertPlotData.Y = this.convertPlotData.Y.toFixed(plotPointRoundDigits);
        },

        getAxisScaleAdjustValue(exponent, graphValueMax, graphValueMin, plotValueMax, plotValueMin) {
            // 三平方の定理でcanvas上の軸のプロット長(max-min間距離)を求める。
            let diffPlotValue = Math.sqrt(Math.pow(plotValueMax.x - plotValueMin.x, exponent) + Math.pow(plotValueMax.y - plotValueMin.y, exponent));
            //  ユーザーが入力した軸値の差分
            let diffGraphValue = graphValueMax - graphValueMin;
            // ユーザーが入力した軸値とcanvas上のプロット値の比率
            return diffGraphValue / diffPlotValue;
        },

        getPlotPointAngle(plotValueMax, plotValueMin) {
            let graphPlotAngle = Math.atan2((-(this.plotPoint.Y - plotValueMin.y)), (this.plotPoint.X - plotValueMin.x));
            let axisPlotAngle = Math.atan2((-(plotValueMax.y - plotValueMin.y)), (plotValueMax.x - plotValueMin.x));

            return graphPlotAngle - axisPlotAngle;
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
        },

    },
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
