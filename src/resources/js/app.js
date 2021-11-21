// CDNで読み込んだJQueryと重複するためコメントアウト。
// require('./bootstrap');

window.Vue = require('vue');
require('vue-toasted');

Vue.component('avatar-image-change', require('./components/users/AvatarImageChange.vue').default);
Vue.component('success-notification', require('./components/common/SuccessNotification.vue').default);
Vue.component('failure-notification', require('./components/graphs/FailureNotification.vue').default);
Vue.component('image-upload', require('./components/graphs/ImageUpload.vue').default);
Vue.component('graph-canvas', require('./components/graphs/GraphCanvas.vue').default);
Vue.component('side-navbar', require('./components/common/SideNavbar.vue').default);

// vue-toastedの読み込み
Vue.use(Toasted);

const app = new Vue({
    el: '#app',
    data() {
        return {
            graphImage: {
                isFile: false,
                data: null,
            },

            axisSettingDetect: {
                isActiveX: true,
                isActiveY: false,
                isCompleteX: '',
                isCompleteY: '',
                isResetClick: false,
            },

            showCanvasEventDetect: {
                isAxisSetCanvas: true,
                isPlotCanvas: false,
                isSetSave: false,
            },

            axisValue: {
                xMin: '',
                xMax: '',
                yMin: '',
                yMax: '',
            },

            graphPlotPoint: {
                graphData: [],
            },
            sideNavTab: 'tab',
            isEditOperation: false,
        }
    },
    computed: {
        // グラフデータを表示・更新するテキストエリアの処理。
        showPlotData: {
            get() {
                // dataの値がある場合は、カンマを入れてテキストエリアに表示
                return this.graphPlotPoint.graphData.map(function(plotData) {
                    if(!plotData.x  && !plotData.y) {
                        return;
                    } else if (!plotData.x){
                        return ',' + plotData.y;
                    } else if (!plotData.y){
                        return plotData.x + ',' ;
                    } else {
                        return plotData.x + ',' + plotData.y;
                    }
                }).join('\n'); // 配列の余計なカンマを改行にするためjoinで処理(文字列に変換)
            },
            set(textAreaValue) {
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
                        this.graphPlotPoint.graphData.push({x: textAreaLineComponents[0], y: textAreaLineComponents[1]});
                    }

                });
                // canvas上の描画データの更新
                this.$refs.graphCanvas.updatePlotData();
            }
        }
    },
    methods: {
        resetSettingAxis() {
            // 軸値のリセット
            this.axisValue.xMin = '';
            this.axisValue.xMax = '';
            this.axisValue.yMin = '';
            this.axisValue.yMax = '';

            // 完了通知のリセット
            this.axisSettingDetect.isCompleteX = '',
            this.axisSettingDetect.isCompleteY = '',

            // 描画のリセットで用いるリセットフラグ
            this.axisSettingDetect.isResetClick = true;

            // 描画のリセット
            this.$refs.graphCanvas.resetDrawingSettingAxis();
        },

        // サイドナビタブのクリックによる画面切り替え
        switchContent(axis, plot, save) {
            this.switchShowCanvas(axis, plot, save);
            this.judgeTabMove();
        },

        // canvasの切り替え
        switchShowCanvas(axis, plot, save) {
            this.showCanvasEventDetect.isAxisSetCanvas = axis;
            this.showCanvasEventDetect.isPlotCanvas = plot;
            this.showCanvasEventDetect.isSetSave = save;
        },

        // 軸設定の完了有無によるタブ切り替え可否の判定
        judgeTabMove() {
            if(this.axisValue.xMin && this.axisValue.xMax && this.axisValue.yMin && this.axisValue.yMax
                && this.axisSettingDetect.isCompleteX && this.axisSettingDetect.isCompleteY) {
                this.sideNavTab = 'tab';
                return;
            } else {
                alert('軸設定が未完了です。');
                this.sideNavTab = '';
                this.switchShowCanvas(true, false, false);
            }
        },

        // テキストエリアの自動スクロール処理
        scrollTextArea() {
            let plotTextArea = this.$refs.plotTextArea;
            let plotTextAreaHeight = plotTextArea.scrollHeight;
            plotTextArea.scrollTo(0, plotTextAreaHeight);
        },

        // input要素を作成し、ファイル送信の準備をする
        setFile(sendFile) {

            // input要素を作成
            const input_data = document.createElement('input');

            // input要素の属性を設定
            input_data.type = 'file';
            input_data.name = 'graph_image';
            input_data.files = sendFile;
            input_data.accept = 'image/png,image/jpeg,image/gif';
            input_data.className = 'd-none';

            // formにinputを追加
            let graphForm = this.$refs.graphForm;
            graphForm.appendChild(input_data);
        },

        // グラフ画像を表示するメソッドの呼び出し
        callSetCanvas() {
            setTimeout(this.$refs.graphCanvas.setCanvas,50);
        },
    },
});
