@extends('layouts.top_layout')

@section('title')
    ユーザー登録
@endsection

@section('content')

    @component('components.common.top_header', ['register_view_flag' => true, 'login_view_flag' => false, 'user_policy_flag' => false, 'privacy_policy_flag' => false])
        @slot('header_content')
            <div class="container-fluid" style="padding-top:100px">
                <div class="row justify-content-center">
                    <div class="col-sm-7 col-md-6 col-xl-5">
                        <div class="card mx-auto">
                            <div class="card-body">
                                <h3 class="font-weight-bold text-center border-bottom pb-3">新規アカウントの作成</h3>

                                {{-- フォーム --}}
                                <form method="POST" action="{{ route('register') }}" class="p-0 py-3 p-sm-3 p-md-2 p-lg-5">
                                    @csrf

                                    {{-- ニックネームの入力フォーム --}}
                                    <div class="form-group">
                                        <label class="form-label" for="name">
                                            <sup class="text-danger mr-1" style="font-size: 60%">(必須)</sup>ニックネーム
                                        </label>

                                        <input
                                            id="name"
                                            name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            autocomplete="name"
                                            value="{{ old('name') }}"
                                            placeholder="グラフ太郎"
                                            required autofocus
                                        >
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- メールアドレスの入力フォーム --}}
                                    <div class="form-group">
                                        <label class="form-label" for="email">
                                            <sup class="text-danger mr-1" style="font-size: 60%">(必須)</sup>メールアドレス
                                        </label>

                                        <input
                                            type="email"
                                            id="email"
                                            name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            autocomplete="email"
                                            value="{{ old('email') }}"
                                            placeholder="graph-t@example.com"
                                            required
                                        >
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- パスワードの入力フォーム --}}
                                    <div class="form-group">
                                        <label class="form-label" for="password">
                                            <sup class="text-danger mr-1" style="font-size: 60%">(必須)</sup>パスワード
                                        </label>

                                        <input
                                            type="password"
                                            id="password"
                                            name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            autocomplete="new-password"
                                            placeholder="********"
                                            required
                                        >
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <small class="grey-text">半角英数字8文字以上を入力してください。</small>
                                    </div>

                                    {{-- パスワードの確認用入力フォーム --}}
                                    <div class="form-group">
                                        <label class="form-label" for="password_confirm">
                                            <sup class="text-danger mr-1" style="font-size: 60%">(必須)</sup>パスワードの確認
                                        </label>

                                        <input
                                            type="password"
                                            id="password_confirm"
                                            name="password_confirmation"
                                            class="form-control"
                                            autocomplete="new-password"
                                            placeholder="********"
                                            required
                                        >
                                        <small class="grey-text">もう一度パスワードを入力してください。</small>
                                    </div>

                                    {{-- 登録ボタン --}}
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-success">
                                            アカウント作成
                                        </button>
                                    </div>

                                    {{-- ログイン画面へ --}}
                                    <div>
                                        既にアカウントをお持ちの方は<a href="{{ route('login') }}">こちら</a>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endslot

    @endcomponent

@endsection
