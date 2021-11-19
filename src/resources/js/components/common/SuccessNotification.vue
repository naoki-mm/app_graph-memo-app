<template>

</template>

<script>
export default {
    props: {
        notification: {
            type: String,
        },
    },
    data() {
        return {
            notificationMessage: this.notification
        };
    },

    mounted() {
        // トースト通知の設定
        const options = {
            theme: "bubble",
            position: "top-center",
            duration : 3000,
            fitToScreen : true,
            action: {
                text : 'x',
                onClick : function(e, toastObject){
                toastObject.goAway(0);
                }
            }
        }
        // トースト通知の表示
        this.$toasted.success(this.notificationMessage, options);
    }
}
</script>

<style>
</style>
