<!--メインレイアウト-->
<main style="margin-top: 58px">
    <div class="container-fluid pt-2">

        <div class="row justify-content-center">
            <div class="col">

                @if (session('status'))
                    <success-notification
                        :notification='@json(session('status'))'
                    ></success-notification>
                @endif

                {{ $main_content }}

            </div>
        </div>
    </div>
</main>
<!--メインレイアウト-->
