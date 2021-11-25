<template>
    <button type="button" class="btn m-0 p-1 shadow-none">
        <i class="fa-star"
            :class="{far:!isFavorite, fas:isFavorite, 'yellow-text':isFavorite}"
            @click="updateFavorite()"
        >
        </i>
    </button>
</template>

<script>
export default {
    props: {
        initialIsFavorite: {
            default: false,
        },
        favoriteUpdateEndpoint: {
            type: String,
        },
    },
    data() {
        return {
            isFavorite: this.initialIsFavorite,
        };
    },

    methods: {
        updateFavorite() {
            this.isFavorite  = !this.isFavorite;
            let booleanIsFavorite = Number(this.isFavorite);
            axios.put(this.favoriteUpdateEndpoint, {'favorite': booleanIsFavorite});
        }
    }
}
</script>

<style>

</style>
