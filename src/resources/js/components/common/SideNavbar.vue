<template>
    <div>
        <!-- サイドバー -->
        <nav
            id="sidebarMenu"
        class="collapse navbar-collapse bg-white"
        :class="{'d-lg-block': !isImage, sidebar: !isImage, 'none-sidebar': isImage}"
        >
            <!-- サイドに固定 -->
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-4">
                    <!-- サイドバーのリスト -->
                    <slot></slot>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    props: {
        isImageFile: {
            type: Boolean,
            dfault: false
        },
    },
    data() {
        return {

        }
    },

    computed: {
    isImage() {
        return this.$props.isImageFile
    }

    },

    methods: {

    }
}
</script>

<style>
.sidebar {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    padding: 58px 0 0; /* ナビバーの高さ */
    box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
    width: 240px;
    z-index: 600;
}

@media (max-width: 991.98px) {
    .sidebar {
        width: 100%;
    }
}
.sidebar .active {
    border-radius: 5px;
    box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
}

.sidebar-sticky {
    position: relative;
    top: 0;
    height: calc(100vh - 48px);
    padding-top: 0.5rem;
    overflow-x: hidden;
    overflow-y: auto;
}

.none-sidebar {
    padding-top: 45px
}
</style>
