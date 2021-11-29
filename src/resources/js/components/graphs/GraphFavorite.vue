<template>
    <button type="button" class="bi-btn btn m-0 p-1 shadow-none">
        <i class="bi"
            :class="favoriteClass"
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
            favoriteClass: {
                'bi-star': !this.initialIsFavorite,
                'bi-star-fill': this.initialIsFavorite,
                'favorite-star': this.initialIsFavorite,
            },
        };
    },

    methods: {
        updateFavorite() {
            // お気に入りアイコンのクラスを切り替え
            Object.keys(this.favoriteClass).forEach((className) => {
                this.favoriteClass[className] = !this.favoriteClass[className];
            })

            // お気に入りのアクティブ状態の切り替え
            this.isFavorite = !this.isFavorite;

            // お気に入りの状態を非同期通信
            let booleanIsFavorite = Number(this.isFavorite);
            axios.put(this.favoriteUpdateEndpoint, {'favorite': booleanIsFavorite});
        }
    }
}
</script>

<style>
/* お気に入りアイコンのスタイル */
.favorite-star {
    color: rgb(255, 230, 0) !important;
    text-shadow: 0 0 2px #000 !important;
}
</style>
