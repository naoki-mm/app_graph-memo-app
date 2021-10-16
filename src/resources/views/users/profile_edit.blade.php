{{-- 共通レイアウトの読み込み --}}
@extends('layouts.app')

{{-- WEBページタイトル --}}
@section('title')
    プロフィール
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
            プロフィールの編集
        @endslot

        {{-- 入力フォーム --}}
        @slot('form')
            <form method="POST" action="{{ route('user-profile.update', $user_profile->id) }}" class="p-5" enctype="multipart/form-data">
                @method('PATCH')
                @csrf

                {{-- ニックネームの入力フォーム --}}
                <div class="form-group">
                    <label class="form-label" for="name">
                        ニックネーム
                    </label>

                    <input
                        id="name"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        autocomplete="name"
                        value="{{ old('name', $user_profile->name) }}"
                        placeholder="グラフ太郎"
                        required autofocus
                    >
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- アバター画像の選択フォーム --}}
                <div class="form-group mt-4">
                    <label class="form-label d-block" for="avatar">
                        <span class="d-block mb-2">プロフィール画像</span>
                        @if (!empty($user_profile->image_name))
                            <img src="/storage/avatar_images/{{ $user_profile->image_name }}"
                                class="rounded-circle d-block mx-auto"
                                style="object-fit: cover; width: 200px; height: 200px;"
                            >
                        @else
                            <img src="/images/avatar-default.svg"
                                class="ounded-circle d-block mx-auto"
                                style="object-fit: cover; width: 200px; height: 200px;"
                            >
                        @endif
                    </label>

                    <span class="avatar-form image-picker">
                        <input
                            id="avatar"
                            type="file"
                            name="avatar"
                            class="d-none form-control-file"
                            accept="image/png,image/jpeg,image/gif"
                        >
                    </span>
                    @error('image_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
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

