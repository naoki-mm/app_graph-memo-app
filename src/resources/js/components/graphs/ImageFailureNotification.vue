<template>

</template>

<script>
export default {
    props: {
        imageErrors: {
            default: '',
        },
    },
    data() {
        return {

        };
    },

    computed: {
        getImageErrors() {
            if(this.imageErrors) {
                let errors = Object.values(this.imageErrors)
                errors = errors.flat()
                return errors;
            } else {
                return ['指定されたファイルは読み込むことができません。'];
            }
        },
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

        if(this.getImageErrors) {
            this.getImageErrors.forEach((error) => {
                this.showNotification(options, error);
            })
        }
        this.$emit("switch-error-flag", false);
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
