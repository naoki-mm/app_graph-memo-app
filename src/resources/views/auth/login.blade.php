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

                            @if ($errors->any())
                            <div class="text-danger text-center">
                                <div class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            {{-- メールアドレスの入力フォーム --}}
                            <div class="form-group">
                                <label class="form-label" for="email">
                                    <sup class="text-danger mr-1" style="font-size: 60%">(必須)</sup>メールアドレス
                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-control"
                                    autocomplete="email"
                                    value="{{ old('email') }}"
                                    placeholder="graph-t@example.com"
                                    required autofocus
                                >

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
                                    class="form-control"
                                    autocomplete="current-password"
                                    placeholder="********"
                                    required
                                >

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
                                <button type="submit" class="btn btn-block btn-custom">
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
