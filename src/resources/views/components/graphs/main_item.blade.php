<!--メインレイアウト-->
<main :class="{'main-layout': !graphImage.isFile}"
        style="margin-top: 58px">
    <div class="container-fluid pt-2">

        @if (session('status'))
            <success-notification
                :notification='@json(session('status'))'
            ></success-notification>
        @endif

        {{ $main_content }}

    </div>
</main>
<!--メインレイアウト-->
