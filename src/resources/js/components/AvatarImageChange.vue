<template>
    <div>
        <label class="form-label d-block" for="avatar">
            <span class="d-block mb-2">プロフィール画像</span>

            <!-- アバター画像の表示 -->
            <img v-if="AvatarImage" :src="AvatarImage"
                class="rounded-circle d-block mx-auto"
                style="object-fit: cover; width: 200px; height: 200px;"
            >

        </label>

        <span class="avatar-form">
            <input
                id="avatar"
                type="file"
                name="avatar"
                class="d-none form-control-file"
                accept="image/png,image/jpeg,image/gif"
                @change="onAvatarImageSelect"
            >
        </span>
    </div>
</template>

<script>
export default {
    props: {
        imageName: {
            type: String,
            dfault: '/images/avatar-default.svg'
        },
    },
    data() {
        return {
            AvatarImage: '/storage/avatar_images/' + this.imageName
        };
    },

    mounted() {
        // アバター画像が登録されていなければ、デフォルト画像を設定する。
        if(this.imageName === null) {
            const defaultAvatarImage = '/images/avatar-default.svg';
            this.AvatarImage = defaultAvatarImage;
        }
    },

    // アバター画像が選択された場合に表示設定をする処理。
    methods: {
        onAvatarImageSelect(e) {

            const files = e.target.files;
            if(files.length > 0) {
                const file = files[0];
                const reader = new FileReader();

                reader.onload = (e) => {
                    this.AvatarImage = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    }
}
</script>
