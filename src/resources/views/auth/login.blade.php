@extends('layouts.app')

@section('title')
    ログイン
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-auto">
                <div class="card" style="width: 500px">
                    <div class="card-body">
                        <div class="font-weight-bold text-center border-bottom pb-3" style="font-size: 24px">ログイン</div>

                        {{-- フォーム --}}
                        <form method="POST" action="{{ route('login') }}" class="p-5">
                            @csrf

                            {{-- メールアドレスの入力フォーム --}}
                            <div class="form-group">
                                <label class="form-label" for="email">
                                    <sup class="text-danger mr-1" style="font-size: 60%">＊</sup>メールアドレス
                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    autocomplete="email"
                                    value="{{ old('email') }}"
                                    placeholder="graph-t@example.com"
                                    required autofocus
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
                                    <sup class="text-danger mr-1" style="font-size: 60%">＊</sup>パスワード
                                </label>

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    autocomplete="current-password"
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

                            {{-- Remember Me機能 --}}
                            <div class="form-group mt-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        ログイン状態を保存する
                                    </label>
                                </div>
                            </div>

                            {{-- ログインボタン --}}
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">
                                    ログイン
                                </button>
                            </div>

                            {{-- ユーザー登録画面へのリンク --}}
                            <div class="mt-5">
                                アカウントをお持ちでない方は<a href="{{ route('register') }}">こちら</a>
                            </div>

                            {{-- パスワードリセット画面へのリンク --}}
                            <div class="mt-2">
                                パスワードをお忘れの方は<a href="{{ route('password.request') }}">こちら</a>
                            </div>
                        </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
