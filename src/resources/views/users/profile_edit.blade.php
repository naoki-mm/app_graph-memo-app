@extends('layouts.app')

@section('title')
    プロフィール
@endsection

@section('header')
    @include('sub_views.users.header')
@endsection

@section('content')
    @component('components.users.main_item')

        @slot('page_title')
            プロフィールの編集
        @endslot

        @slot('form')
            <form method="POST" action="{{ route('user-profile.update', $user_profile->id) }}" class="p-5">
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

@section('footer')

@endsection

