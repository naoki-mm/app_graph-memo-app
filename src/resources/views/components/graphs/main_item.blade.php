<!--メインレイアウト-->
<main :class="{'main-layout': !graphImage.isFile}"
        style="margin-top: 58px">
    <div class="container-fluid pt-2">

        {{-- バリデーションエラーの共通通知 --}}
        @if ($errors->any())
            <failure-notification
                :errors='{{ $errors }}'
            ></failure-notification>
        @endif

        {{ $main_content }}

    </div>
</main>
<!--メインレイアウト-->
