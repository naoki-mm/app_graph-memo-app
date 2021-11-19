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
        const options = {
            theme: "outline",
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

        this.$toasted.success(this.notificationMessage, options);
    }
}
</script>

<style>
    /* .toasted-container .toasted {
    } */
</style>
