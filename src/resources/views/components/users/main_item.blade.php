<!--メインレイアウト-->
<main style="margin-top: 58px">
    <div class="container-fluid pt-5">

        <div class="row justify-content-center">
            <div class="col-sm-7 col-xl-6">

                <div class="font-weight-bold text-center border-bottom pb-3" style="font-size: 24px">
                    {{ $page_title }}
                </div>

                @if (session('status'))
                    <success-notification
                        :notification='@json(session('status'))'
                    ></success-notification>
                @endif

                {{-- フォーム --}}
                {{ $form }}

            </div>
        </div>
    </div>
</main>
<!--メインレイアウト-->

