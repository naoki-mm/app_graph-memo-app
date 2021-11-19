<template>

</template>

<script>
export default {
    props: {
        errors: {
            default: null,
        },
    },
    data() {
        return {

        };
    },

    mounted() {
        // トースト通知の設定
        const options = {
            theme: "bubble",
            position: "top-center",
            duration : 6000,
            fitToScreen : true,
            action: {
                text : 'x',
                onClick : function(e, toastObject){
                toastObject.goAway(0);
                }
            }
        }

        if(this.errors) {
            // Laravelから返ってきたエラーメッセージを検索し、条件に合うメッセージを表示
            Object.keys(this.errors).forEach((error) => {
                switch(error) {
                    case 'title' || 'memo':
                        this.showNotification(options, '保存タブの入力に誤りがあります。');
                        break;
                    case 'data':
                        this.showNotification(options, 'プロットデータの入力に誤りがあります。');
                        break;
                    case 'graph_image':
                        this.showNotification(options, '画像データが読み込めません');
                        break;
                    default:
                        this.showNotification(options, '軸設定に誤りがあります。');
                }
            })
        }
    },

    methods: {
        // トースト通知の表示
        showNotification (options, message) {
            this.$toasted.error(message, options);
        }
    }
}
</script>

<style>
</style>
