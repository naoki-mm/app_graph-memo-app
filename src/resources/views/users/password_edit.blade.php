{{-- 共通レイアウトの読み込み --}}
@extends('layouts.app')

{{-- WEBページタイトル --}}
@section('title')
    パスワード変更
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
            パスワード変更
        @endslot

        {{-- 入力フォーム --}}
        @slot('form')
            <form method="POST" action="{{ route('user-password.update', $user_password->id) }}" class="p-5">
                @method('PATCH')
                @csrf

                {{-- 現在のパスワードの入力フォーム --}}
                <div class="form-group">
                    <label class="form-label" for="password">
                        現在設定しているパスワード
                    </label>

                    <input
                        type="password"
                        id="current_password"
                        name="current_password"
                        class="form-control @error('current_password') is-invalid @enderror"
                        autocomplete="new-password"
                        required
                    >
                    @error('current_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <small class="grey-text">現在のパスワードを入力してください。</small>
                </div>

                {{-- 新しいパスワードの入力フォーム --}}
                <div class="form-group mt-4">
                    <label class="form-label" for="password">
                        新しいパスワード
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        autocomplete="new-password"
                        required
                    >
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <small class="grey-text">半角英数字8文字以上を入力してください。</small>
                </div>

                {{-- 新しいパスワードの確認用入力フォーム --}}
                <div class="form-group">
                    <label class="form-label" for="password_confirm">
                        新しいパスワード (確認用)
                    </label>

                    <input
                        type="password"
                        id="password_confirm"
                        name="password_confirmation"
                        class="form-control"
                        autocomplete="new-password"
                        required
                    >
                    <small class="grey-text">もう一度、新しいパスワードを入力してください。</small>
                </div>

                {{-- 変更ボタン --}}
                <div class="form-group mt-5">
                    <button type="submit" class="btn btn-block btn-primary">
                        変更する
                    </button>
                </div>

            </form>
        @endslot
    @endcomponent
@endsection

{{-- フッター --}}
@section('footer')

@endsection

