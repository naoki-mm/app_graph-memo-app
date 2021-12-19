{{-- 共通レイアウトの読み込み --}}
@extends('layouts.app')

{{-- WEBページタイトル --}}
@section('title')
    メールアドレス変更
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
            メールアドレス変更
        @endslot

        {{-- 入力フォーム --}}
        @slot('form')
            <form method="POST" action="{{ route('user-email.update', $user_email->id) }}" class="p-5">
                @method('PATCH')
                @csrf

                {{-- 現在のメールアドレスの入力フォーム --}}
                <div class="form-group mb-4">
                    <label class="form-label disabled" for="current-email">
                        現在のメールアドレス
                    </label>

                    <input
                        id="current-email"
                        type="email"
                        class="form-control"
                        value="{{ $user_email->email }}"
                        disabled
                    >
                </div>

                {{-- 新しいメールアドレスの入力フォーム --}}
                <div class="form-group">
                    <label class="form-label" for="email">
                        新しいメールアドレス
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        autocomplete="email"
                        value="{{ old('email') }}"
                        required autofocus
                    >
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- 確認用メールアドレスの入力フォーム --}}
                <div class="form-group">
                    <label class="form-label" for="email">
                        新しいメールアドレス (確認用)
                    </label>

                    <input
                        id="email_confirm"
                        type="email"
                        name="email_confirmation"
                        class="form-control"
                        autocomplete="email"
                        required
                    >
                    <small class="grey-text">もう一度、新しいメールアドレスを入力してください。</small>
                </div>

                {{-- 変更ボタン --}}
                <div class="form-group mt-5">
                    <button type="submit" class="btn btn-block btn-custom">
                        変更する
                    </button>
                    @if (Auth::id() === 1)
                        <p class="text-danger text-center">
                            <i class="fas fa-exclamation-triangle mr-1 mt-2"></i>ゲストユーザーは変更処理を行うことができません。
                        </p>
                    @endif
                </div>

            </form>
        @endslot
    @endcomponent
@endsection

{{-- フッター --}}
@section('footer')

@endsection

