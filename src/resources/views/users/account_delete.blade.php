{{-- 共通レイアウトの読み込み --}}
@extends('layouts.app')

{{-- WEBページタイトル --}}
@section('title')
    退会
@endsection

{{-- ヘッダー--}}
@section('header')
    @include('sub_views.users.header')
@endsection

{{-- メインコンテンツ --}}
@section('content')
    {{-- ユーザー情報変更のメインレイアウトの読み込み --}}
    @component('components.users.main_item')

        {{-- コンテンツタイトル --}}
        @slot('page_title')
            退会の手続き
        @endslot

        @slot('form')
            <div class="my-4">
                退会(アカウント削除)手続きを行います。注意事項をご確認の上、問題なければ同意にチェックして「退会する」ボタンを押してください。
            </div>
            <div class="card mx-auto px-2" style="width: 93%">
                <div class="card-body pb-2"></div>
                    <h5 class="card-title font-weight-bold text-center border-bottom pb-2">注意事項と同意</h5>
                    <div class="card-text mt-4">
                        <ol class="pl-4">
                            <li class="mb-2">退会後に退会の取り消しはできません。</li>
                            <li class="mb-2">退会後は、現在ログイン中のアカウントでログインができなくなります。</li>
                            <li class="mb-2">ご利用中に登録されたグラフデータ、ユーザーデータ、その他全てのアプリデータは全て削除され、復旧することはできません。</li>
                        </ol>
                        <div class="mt-4 text-center">
                            <div class="custom-control custom-checkbox">
                                <input name="user_delete_check" value="true" form="user-delete-form" type="checkbox" class="custom-control-input" id="delete-confirm-check"
                                    v-on:click="isDeleteCheck = !isDeleteCheck">
                                <label class="custom-control-label" for="delete-confirm-check">
                                    上記事項に同意の上、退会手続きを行います。
                                </label>
                            </div>
                            <p v-show="!isDeleteCheck" class="mb-2"><br></p>
                            <p v-show="isDeleteCheck" class="text-danger">
                                <i class="fas fa-exclamation-triangle mr-1 mt-2"></i>注意事項の同意にチェックしてください。
                            </p>
                        </div>

                        <form id="user-delete-form" method="POST" action="{{ route('delete-account.destroy', $delete_account->id) }}">
                            @method('DELETE')
                            @csrf
                            {{-- 変更ボタン --}}
                            <div class="form-group mt-3 text-center">
                                <button type="submit" class="px-5 btn btn-danger" :disabled="isDeleteCheck">
                                    退会する
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>



        @endslot
    @endcomponent
@endsection

{{-- フッター --}}
@section('footer')

@endsection

