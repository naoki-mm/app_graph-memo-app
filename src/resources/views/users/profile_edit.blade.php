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

                    {{-- 画像の選択プレビュー、登録データ表示 --}}
                    <avatar-image-change
                        :image-name='@json($user_profile->image_name)'
                    ></avatar-image-change>

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

