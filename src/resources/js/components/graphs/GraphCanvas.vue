<template>
    <!-- canvas -->
    <div class="col-12 col-lg-9 pl-lg-2 pt-2 pt-lg-0">

        <div class="card">
            <div class="canvas-card card-body w-100
                d-flex align-items-center justify-content-center text-center"
                style="height: 90vmin">

                <img
                    id="background-grah-image"
                    ref="backGroundGraphImage"
                    :src="getGraphImage"
                    class="w-100 h-100"
                >

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

                <input form="graph_form" type="hidden" name="graph_image_text" :value="getGraphImage" >

                <input form="graph_form" type="hidden" name="x_min_plot_x" :value="axisSetting.value.axisX.min.x" required>
                <input form="graph_form" type="hidden" name="x_min_plot_y" :value="axisSetting.value.axisX.min.y" required>
                <input form="graph_form" type="hidden" name="x_max_plot_x" :value="axisSetting.value.axisX.max.x" required>
                <input form="graph_form" type="hidden" name="x_max_plot_y" :value="axisSetting.value.axisX.max.y" required>
                <input form="graph_form" type="hidden" name="y_min_plot_x" :value="axisSetting.value.axisY.min.x" required>
                <input form="graph_form" type="hidden" name="y_min_plot_y" :value="axisSetting.value.axisY.min.y" required>
                <input form="graph_form" type="hidden" name="y_max_plot_x" :value="axisSetting.value.axisY.max.x" required>
                <input form="graph_form" type="hidden" name="y_max_plot_y" :value="axisSetting.value.axisY.max.y" required>

                <input form="graph_form" type="hidden" name="width" :value="canvas.size.drawWidth" >
                <input form="graph_form" type="hidden" name="height" :value="canvas.size.drawHeight" >

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

        oldGraphData: {
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
                graphData: '',
            })
        },

        initialGraph: {
            default: '',
        },

        initialGraphCanvas: {
            default: '',
        },

        initialAxisValue: {
            default: '',
        },

        initialAxisPlot: {
            default: '',
        },

        initialPlotData: {
            default: '',
        },
    },

    data() {
        return {
            canvas: {
                plotCanvas: null,
                axisSetCanvas: null,
                size: {
                    drawWidth: null,
                    drawHeight: null,
                },
                context: {
                    plot: null,
                    axisSetting: null,
                },
                click: {
                    x: 0,
                    y: 0,
                },

            },
            axisSetting: {
                clickCount: {
                    X: 0,
                    Y: 0,
                },

                value: {
                    axisX: {min: {x:'', y: ''},
                            max: {x:'', y: ''}},
                    axisY: {min: {x:'', y: ''},
                            max: {x:'', y: ''}}
                },
            },

            plotPoint: {
                onCanvasData: {
                    X: 0,
                    Y: 0,
                },
                converGraphData: {
                    X: 0,
                    Y: 0,
                },
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
        getPlotPoint() {
            return this.graphPlotPoint;
        },
        getGraphImage() {
            if(this.graphImage) {
                return this.graphImage;
            }
            else if(Object.keys(this.oldGraphData).length) {
                // 画面更新時にグラフ画像のoldデータがあれば表示
                return this.oldGraphData['graph_image_text'];
            } else if(Object.keys(this.initialGraph).length) {
                // 画面更新時にグラフ画像の初期データがあれば表示
                return '/storage/graph_images/' + this.initialGraph['image_name'];
            } else {
                return null;
            }
        },
        getOldAxisPlot() {
            if(Object.keys(this.oldGraphData).length) {
                // 画面更新時にグラフ画像のoldデータがあれば表示
                return this.oldGraphData;
            } else if(Object.keys(this.initialAxisPlot).length) {
                // 画面更新時にグラフ画像の初期データがあれば表示
                return this.initialAxisPlot;
            } else {
                return null;
            }
        }
    },

    mounted() {
        // グラフ画像がoldデータがあれば画像・キャンバスの表示設定を行う。
        if(Object.keys(this.oldGraphData).length || Object.keys(this.initialGraph).length) {
            this.$root.graphImage.isFile = true;
            setTimeout(this.setCanvas, 50);
        }
    },

    methods: {
        // キャンバスをセット
        setCanvas() {
            // canvas要素を取得。
            this.canvas.axisSetCanvas = this.$refs.axisSetCanvas;
            this.canvas.plotCanvas = this.$refs.plotCanvas;

            // キャンバスの表示サイズを親要素のサイズに設定
            this.setCanvasDisplaySize(this.canvas.axisSetCanvas);
            this.setCanvasDisplaySize(this.canvas.plotCanvas);

            // キャンバスの描画サイズを変数に代入
            this.canvas.size.drawWidth = this.canvas.axisSetCanvas.width;
            this.canvas.size.drawHeight = this.canvas.axisSetCanvas.height;

            // コンテキストの設定
            this.canvas.context.axisSetting = this.canvas.axisSetCanvas.getContext("2d");
            this.canvas.context.plot = this.canvas.plotCanvas.getContext("2d");

            // 軸設定のoldデータがあれば、セットする。
            if(Object.keys(this.oldGraphData).length) {
                this.setOldAxisValue(this.$root.axisValue, this.oldGraphData);
                this.setOldAxisPlotValue(this.oldGraphData);
                this.setOldAxis(this.oldGraphData);
                this.setOldPlot(this.oldGraphData['data']);

            } else if(Object.keys(this.initialGraph).length) {
                this.setOldAxisValue(this.$root.axisValue, this.initialAxisValue);
                this.setOldAxisPlotValue(this.initialAxisPlot);
                this.setOldAxis(this.initialGraphCanvas);
                this.setOldPlot(this.initialPlotData[0]['data']);
                this.$root.isEditOperation = true;
            }
        },

        // 軸設定値のoldデータをセット
        setOldAxisValue(value, data) {
            value.xMin = Number(data['x_min_value']);
            value.xMax = Number(data['x_max_value']);
            value.yMin = Number(data['y_min_value']);
            value.yMax = Number(data['y_max_value']);
        },

        // 軸設定のoldプロットデータをセット
        setOldAxisPlotValue() {
            this.axisSetting.value =  {axisX: {min: {x: this.getOldAxisPlot['x_min_plot_x'], y: this.getOldAxisPlot['x_min_plot_y']},
                                                max: {x: this.getOldAxisPlot['x_max_plot_x'], y: this.getOldAxisPlot['x_max_plot_y']}},
                                        axisY: {min: {x: this.getOldAxisPlot['y_min_plot_x'], y: this.getOldAxisPlot['y_min_plot_y']},
                                                max: {x: this.getOldAxisPlot['y_max_plot_x'], y: this.getOldAxisPlot['y_max_plot_y']}}}
        },

        // 軸設定のoldデータがあれば、軸設定を行う。
        setOldAxis(oldCanvas) {
            Object.keys(this.axisSetting.value).forEach((oldAxisName) => {
                Object.keys(this.axisSetting.value[oldAxisName]).forEach((scale) => {
                    if(oldAxisName === 'axisX') {
                        // x軸設定プロットの描画
                        this.setOldAxisPlot(true, false, oldAxisName, scale, oldCanvas);
                    }
                    if(oldAxisName === 'axisY') {
                        // y軸設定プロットの描画
                        this.setOldAxisPlot(false, true, oldAxisName, scale, oldCanvas);
                    }
                });

            })
                // タブのアクティブ状態を初期に戻す
                this.$root.axisSettingDetect.isActiveX = true;
                this.$root.axisSettingDetect.isActiveY = false;
        },

        setOldAxisPlot(isActiveX, isActiveY, oldAxisName, scale, oldCanvas) {
            // 軸設定タブの切り替え
            this.$root.axisSettingDetect.isActiveX = isActiveX;
            this.$root.axisSettingDetect.isActiveY = isActiveY;

            // oldデータと現在の軸設定時のキャンバス描画サイズの比率を求める（レスポンシブ対応のため）
            let oldAxisAdjustX = this.canvas.size.drawWidth / oldCanvas['width'];
            let oldAxisAdjustY = this.canvas.size.drawHeight / oldCanvas['height'];

            // データセットされていない値があれば処理を飛ばす。
            if(this.axisSetting.value[oldAxisName][scale]['x'] === null || this.axisSetting.value[oldAxisName][scale]['y'] === null) {
                return;
            }

            // プロットデータをセット
            this.plotPoint.onCanvasData.X = this.axisSetting.value[oldAxisName][scale]['x'] * oldAxisAdjustX;
            this.plotPoint.onCanvasData.Y = this.axisSetting.value[oldAxisName][scale]['y'] * oldAxisAdjustY;
            this.setAxis(null, true);
        },

        // プロットデータのoldデータをセット
        setOldPlot(textAreaValue) {
            if(!textAreaValue) {
                return;
            }
            // テキストエリア内の一行を取得
            let textAreaLines = textAreaValue.split(/\n/);

            // 初期化
            let textAreaLineComponents = ''
            this.graphPlotPoint.graphData = [];

            // テキストエリア内の編集をdataへ反映
            textAreaLines.forEach((textAreaLine) => {
                // 行区切りのデータをカンマを境にx, yの配列に変換
                textAreaLineComponents = textAreaLine.split(',');

                // カンマを削除した場合undefinedとなるため、該当する値を空にする。
                if(typeof textAreaLineComponents[1] === 'undefined') {
                    textAreaLineComponents[1] = '';
                }
                // x, y両方のデータがない(消去)された場合は、配列データを挿入しない。
                if(!textAreaLineComponents[0] && !textAreaLineComponents[1]) {
                    return;
                } else {
                    // 更新されたデータで配列データを挿入
                    this.$root.graphPlotPoint.graphData.push({x: textAreaLineComponents[0], y: textAreaLineComponents[1]});
                }

            });
            // canvas上の描画データの更新
            this.updatePlotData();
        },

        // キャンバスの表示サイズのを親要素のサイズに設定
        setCanvasDisplaySize(canvas) {
            canvas.width  = canvas.parentElement.clientWidth;
            canvas.height  = canvas.parentElement.clientHeight;
        },

        // グラフ軸設定
        setAxis(e, isOldAxisSetting) {
            const axisSetPointNumber = 2;

            // 各軸の設定時のクリック数を取得
            let clickCount = this.clickCountUp();
            // canvasのクリック数により、処理を変更
            if(clickCount <= axisSetPointNumber) {
                if(!isOldAxisSetting) {
                    // クリック座標の取得
                    this.getClickPoint(e, this.canvas.axisSetCanvas);
                    // クリック座標をレスポンシブ対応に変換
                    this.convertClickPoint(this.canvas.axisSetCanvas);
                }
                // クリック座標にプロットポインタを描画する。
                this.showPlotPoint(this.canvas.context.axisSetting);
                // 軸設定時のプロット設定
                this.showAxisNavText(this.canvas.context.axisSetting);
                // プロットした値を各軸のmin,maxのデータを配列に格納
                if(this.getAxisSettingDetect.isActiveX && clickCount === 1) {
                    this.axisSetting.value.axisX.min = {x:this.plotPoint.onCanvasData.X, y:this.plotPoint.onCanvasData.Y};
                } else if(this.getAxisSettingDetect.isActiveX && clickCount === 2) {
                    this.axisSetting.value.axisX.max = {x:this.plotPoint.onCanvasData.X, y:this.plotPoint.onCanvasData.Y};
                }
                if(this.getAxisSettingDetect.isActiveY && clickCount === 1) {
                    this.axisSetting.value.axisY.min = {x:this.plotPoint.onCanvasData.X, y:this.plotPoint.onCanvasData.Y};
                } else if(this.getAxisSettingDetect.isActiveY && clickCount === 2) {
                    this.axisSetting.value.axisY.max = {x:this.plotPoint.onCanvasData.X, y:this.plotPoint.onCanvasData.Y};
                }

            } else {
                alert('軸設定を変更する場合は、リセットボタンを押してください。');
            }
        },

        // 軸設定のリセット処理
        resetDrawingSettingAxis() {
            if(this.$root.axisSettingDetect.isResetClick) {
                // canvasのクリック数を初期化
                this.axisSetting.clickCount.X = 0;
                this.axisSetting.clickCount.Y = 0;

                this.axisSetting.value.axisX = {min: {x:0, y:0}, max: {x:0, y:0}};
                this.axisSetting.value.axisY = {min: {x:0, y:0}, max: {x:0, y:0}};

                // リセットフラグを初期化
                this.$root.axisSettingDetect.isResetClick = false;

                // 軸設定の描画をリセット
                this.canvas.context.axisSetting.clearRect(0, 0, this.canvas.axisSetCanvas.width, this.canvas.axisSetCanvas.height);
            }
        },

        // 軸設定時のクリック数をカウント
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

        // 軸設定プロット時にテキストナビを表示
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
                    context.fillText("x min",this.plotPoint.onCanvasData.X + textPositionAdjust, this.plotPoint.onCanvasData.Y);
                }
                if(this.axisSetting.clickCount.X === axisSetCountMaxNumber) {
                    context.fillText("x max",this.plotPoint.onCanvasData.X + textPositionAdjust, this.plotPoint.onCanvasData.Y);
                    this.$emit("complete-set-axis-x", this.axisSetting.clickCount.X);
                }
            }
            // y軸のプロット設定
            if(this.getAxisSettingDetect.isActiveY) {
                context.textBaseline = "bottom";
                // クリック数により、テキストの表示を切り替える
                if(this.axisSetting.clickCount.Y === axisSetCountMinNumber) {
                    context.fillText("y min",this.plotPoint.onCanvasData.X + textPositionAdjust, this.plotPoint.onCanvasData.Y - textPositionAdjust);
                }
                if(this.axisSetting.clickCount.Y === axisSetCountMaxNumber) {
                    context.fillText("y max",this.plotPoint.onCanvasData.X + textPositionAdjust, this.plotPoint.onCanvasData.Y - textPositionAdjust);
                    this.$emit("complete-set-axis-y", this.axisSetting.clickCount.Y);
                }
            }
        },

        // グラフプロット時の処理
        graphPlot(e) {
            // 現在のサイドナビが保存タブであれば、プロットは無効化してアラートを出す。
            if(this.getShowCanvasEventDetect.isSetSave) {
                alert('グラフをプロットするには「プロットタブ」を開いてください。');
                return;
            }
            // クリックの座標取得
            this.getClickPoint(e, this.canvas.plotCanvas);
            // クリック座標をレスポンシブ対応に変換
            this.convertClickPoint(this.canvas.plotCanvas);
            // クリック座標にプロットポインタを描画する。
            this.showPlotPoint(this.canvas.context.plot);
            // ユーザーが設定したグラフ画像の軸を基準に、プロットポイントの座標変換を行う。
            this.setConvertPlotData();
            // 桁数の調整
            this.setDigits();
            // プロットデータを配列に格納して親データに渡す。
            this.setArrayPlotData();
        },

        // プロットデータを配列に格納して、親に渡す。
        setArrayPlotData() {
            let currentPlot = this.getPlotPoint;

            currentPlot.graphData.push({x: this.plotPoint.converGraphData.X, y: this.plotPoint.converGraphData.Y});
            this.$emit("graph-plot", currentPlot);
            this.$emit("scroll-text-area");
        },

        // canvas上のプロットデータをグラフベースのデータに変換
        setConvertPlotData() {
            const exponent = 2;
            // 各x,y成分を実際のグラフ軸スケールする係数（canvasとグラフ画像軸に角度がある場合も考慮）。
            let scaleAdjustValueX = this.getAxisScaleAdjustValue(exponent, this.getAxisValue.xMax, this.getAxisValue.xMin, this.axisSetting.value.axisX.max, this.axisSetting.value.axisX.min);
            let scaleAdjustValueY = this.getAxisScaleAdjustValue(exponent, this.getAxisValue.yMax, this.getAxisValue.yMin, this.axisSetting.value.axisY.max, this.axisSetting.value.axisY.min);

            // プロットデータの斜辺の長さ
            let plotHypotenuse = Math.sqrt(Math.pow((this.plotPoint.onCanvasData.X - this.axisSetting.value.axisX.min.x), exponent) + Math.pow((this.plotPoint.onCanvasData.Y - this.axisSetting.value.axisY.min.y), exponent));

            // グラフ画像の軸に対するプロットポイントの角度
            let plotPointAngle = this.getPlotPointAngle(this.axisSetting.value.axisX.max, this.axisSetting.value.axisX.min);

            // プロットデータの斜辺に対する対辺と隣辺を計算。
            let plotHypotenuseSin = plotHypotenuse * Math.sin(plotPointAngle);
            let plotHypotenuseCos = plotHypotenuse * Math.cos(plotPointAngle);

            // 対辺と隣辺に軸補正係数を掛けて, プロットデータの変換値を計算してdataにセット。
            this.plotPoint.converGraphData.X = plotHypotenuseCos * scaleAdjustValueX;
            this.plotPoint.converGraphData.Y = plotHypotenuseSin * scaleAdjustValueY;
        },

        // データ表示の桁数調整
        setDigits() {
            const plotPointRoundDigits = 3;
            // 小数点以下の桁数を指定した値で四捨五入して表示。
            this.plotPoint.converGraphData.X = this.plotPoint.converGraphData.X.toFixed(plotPointRoundDigits);
            this.plotPoint.converGraphData.Y = this.plotPoint.converGraphData.Y.toFixed(plotPointRoundDigits);
        },

        // canvasとグラフ軸のスケール変換
        getAxisScaleAdjustValue(exponent, graphValueMax, graphValueMin, plotValueMax, plotValueMin) {
            // 三平方の定理でcanvas上の軸のプロット長(max-min間距離)を求める。
            let diffPlotValue = Math.sqrt(Math.pow(plotValueMax.x - plotValueMin.x, exponent) + Math.pow(plotValueMax.y - plotValueMin.y, exponent));
            //  ユーザーが入力した軸値の差分
            let diffGraphValue = graphValueMax - graphValueMin;
            // ユーザーが入力した軸値とcanvas上のプロット値の比率
            return diffGraphValue / diffPlotValue;
        },

        // プロットポイントのグラフ軸をベースとした角度を求める。
        getPlotPointAngle(plotValueMax, plotValueMin) {
            let graphPlotAngle = Math.atan2((-(this.plotPoint.onCanvasData.Y - plotValueMin.y)), (this.plotPoint.onCanvasData.X - plotValueMin.x));
            let axisPlotAngle = Math.atan2((-(plotValueMax.y - plotValueMin.y)), (plotValueMax.x - plotValueMin.x));

            return graphPlotAngle - axisPlotAngle;
        },

        // canvas上のクリック座標を取得(レスポンシブのスケール変換あり)
        getClickPoint(e, canvas) {
            // canvasの左上角の座標を取得
            let canvasTopLeftCorner = canvas.getBoundingClientRect();

            // クリックした座標(画面左上が基準)をcanvasの座標(canvas描画領域の左上が基準)に変換
            this.canvas.click.x = e.clientX - canvasTopLeftCorner.left;
            this.canvas.click.y = e.clientY - canvasTopLeftCorner.top;
        },

        convertClickPoint(canvas) {
            // クリック時の親要素のサイズを取得して、canvasの表示サイズとして扱う。
            let displayCanvasWidth = canvas.parentElement.clientWidth;
            let displayCanvasHeight = canvas.parentElement.clientHeight;

            // canvasの描画領域と表示領域の差異の軸補正係数
            let xAxisAdjust = this.canvas.size.drawWidth / displayCanvasWidth;
            let yAxisAdjust = this.canvas.size.drawHeight / displayCanvasHeight;

            // クリックした座標をcanvas内の描画値に換算
            this.plotPoint.onCanvasData.X = this.canvas.click.x * xAxisAdjust;
            this.plotPoint.onCanvasData.Y = this.canvas.click.y * yAxisAdjust;
        },

        // canvas上の描画データの更新
        updatePlotData() {
            // 描画データのリセット
            this.canvas.context.plot.clearRect(0, 0, this.canvas.axisSetCanvas.width, this.canvas.axisSetCanvas.height);
            // 描画データを更新して再描画
            this.showPlotPoint(this.canvas.context.plot, this.getPlotPoint);
        },

        // グラフ軸上のデータからcanvas軸のデータへ変換
        convertToCanvasPlotData(graphPlotPoint) {
            const canvasExponent = 2;
            // 各x,y成分を実際のグラフ軸スケールする係数
            let scaleAdjustX = this.getAxisScaleAdjustValue(canvasExponent, this.getAxisValue.xMax, this.getAxisValue.xMin, this.axisSetting.value.axisX.max, this.axisSetting.value.axisX.min);
            let scaleAdjustY = this.getAxisScaleAdjustValue(canvasExponent, this.getAxisValue.yMax, this.getAxisValue.yMin, this.axisSetting.value.axisY.max, this.axisSetting.value.axisY.min);

            // プロットデータのユーザー設定軸に対するsin,cos成分
            let plotPointHypotenuseCos = graphPlotPoint.x / scaleAdjustX;
            let plotPointHypotenuseSin = graphPlotPoint.y / scaleAdjustY;

            // ユーザーが設定した軸をベースとした斜辺の長さ
            let plotPointHypotenuse = Math.sqrt(Math.pow(plotPointHypotenuseSin, canvasExponent) + Math.pow(plotPointHypotenuseCos, canvasExponent));

            // ユーザーが設定した軸をベースとしたプロットデータの角度[rad]
            let plotAngle = Math.atan2(plotPointHypotenuseSin, plotPointHypotenuseCos);
            // ユーザーが設定した軸の角度[rad]
            let axisAngle = Math.atan2((-(this.axisSetting.value.axisX.max.y - this.axisSetting.value.axisX.min.y)), (this.axisSetting.value.axisX.max.x - this.axisSetting.value.axisX.min.x));

            // canvas軸をベースとしたプロットデータの角度
            let canvasPlotPointAngle =  plotAngle + axisAngle;

            // プロットデータのcanvas軸に対するsin,cos成分
            let HypotenuseCos = plotPointHypotenuse * Math.cos(canvasPlotPointAngle);
            let HypotenuseSin = plotPointHypotenuse * Math.sin(canvasPlotPointAngle);

            let graphPlotPointX = HypotenuseCos + this.axisSetting.value.axisX.min.x;
            let graphPlotPointY = this.axisSetting.value.axisX.min.y - HypotenuseSin;

            return [graphPlotPointX, graphPlotPointY];
        },

        // canvas上にプロットデータを表示する
        showPlotPoint(context, updatePlotData) {

            // 円の描画開始角度 0[rad]
            const startAngle = 0;
            // 円の描画終了角度 2π[rad]
            const endAngle = Math.PI * 2;
            // プロットポインタのサイズ
            const plotPointerSize = 5;

            // 描画スタイルの設定
            context.fillStyle = "rgba(200, 0, 0, 0.8)";

            if(updatePlotData) {
                // 描画配列データがあれば描画する
                updatePlotData.graphData.forEach((graphPlotPoint) => {
                    let [convertPlotX, convertPlotY] = this.convertToCanvasPlotData(graphPlotPoint);
                    context.beginPath();
                    context.arc(convertPlotX, convertPlotY, plotPointerSize, startAngle, endAngle, false);
                    context.fill();
                })
            } else {
                // クリックした箇所にプロッタを描画
                context.beginPath();
                context.arc(this.plotPoint.onCanvasData.X, this.plotPoint.onCanvasData.Y, plotPointerSize, startAngle, endAngle, false);
                context.fill();
            }
        },

    },
}

</script>

<style>
.canvas-card {
    padding: 0px;
}

#plot-layer {
    position: absolute;
    z-index: 3;
}
#axsis-set-layer {
    position: absolute;
    z-index: 2;

}
#background-grah-image {
    position: absolute;
    z-index: 1;
}
</style>
