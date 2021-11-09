/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// CDNで読み込んだJQueryと重複するためコメントアウト。
// require('./bootstrap');

window.Vue = require('vue');
require('vue-toasted');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('avatar-image-change', require('./components/users/AvatarImageChange.vue').default);
Vue.component('success-notification', require('./components/common/SuccessNotification.vue').default);
Vue.component('image-upload', require('./components/graphs/ImageUpload.vue').default);
Vue.component('graph-canvas', require('./components/graphs/GraphCanvas.vue').default);
Vue.component('side-navbar', require('./components/common/SideNavbar.vue').default);

// vue-toastedの読み込み
Vue.use(Toasted);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data() {
        return {
            graphImage: {
                isFile: false,
                fileName: null,
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
                data: [{x: 1.55, y: 2.63},{x: 3.55, y:4.66},{x: 5, y:6}],
            }
        }
    },
    computed: {
        // グラフデータを表示・更新するテキストエリアの処理。
        showPlotData: {
            get() {
                // dataの値がある場合は、改行を入れてテキストエリアに表示
                return this.graphPlotPoint.data.map(function(plotData) {
                    if(!plotData.x  && !plotData.y) {
                        return '';
                    } else if (!plotData.x){
                        return plotData.y + '\n';
                    } else if (!plotData.y){
                        return plotData.x + '\n';
                    } else {
                        return plotData.x + ',' + plotData.y + '\n';
                    }
                }).join(''); // 行頭のカンマを消去するためにjoinで処理
            },
            set(textAreaValue) {
                // テキストエリア内の一行を取得
                let textAreaLines = textAreaValue.split('\n');
                let textAreaLineComponents = ''

                // テキストエリア内の編集をdataへ反映
                textAreaLines.forEach((textAreaLine, index) => {
                    // 行区切りのデータをカンマを境にx, yの配列に変換
                    textAreaLineComponents = textAreaLine.split(',');
                    // カンマを削除した場合undefinedとなるため、該当する値を空にする。
                    if(typeof textAreaLineComponents[0] === 'undefined') {
                        textAreaLineComponents[0] = '';
                    }
                    if(typeof textAreaLineComponents[1] === 'undefined') {
                        textAreaLineComponents[1] = '';
                    }
                    // 編集データをdataへ反映
                    if(typeof this.graphPlotPoint.data[index] !== 'undefined') {
                        this.graphPlotPoint.data[index].x = textAreaLineComponents[0];
                        this.graphPlotPoint.data[index].y = textAreaLineComponents[1];
                    }
                });

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

        switchShowCanvas(axis, plot, save) {
            this.showCanvasEventDetect.isAxisSetCanvas = axis;
            this.showCanvasEventDetect.isPlotCanvas = plot;
            this.showCanvasEventDetect.isSetSave = save;
        }
    },
});
