<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     * ログイン後は、グラフデータ一覧画面へリダイレクトする。
     * @var string
     */

    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // ログアウト時の遷移先をオーバーライド
    protected function loggedOut(Request $request)
    {
        return redirect()->route('top.show')
            ->with('status', 'ログアウトしました');
    }

    // ゲストユーザー用ユーザーID
    private const GUEST_USER_ID = 1;

    // ゲストログイン処理
    public function guestLogin()
    {
        // IDによるゲストログイン
        if (Auth::loginUsingId(self::GUEST_USER_ID)) {
            return redirect()->route('graph.index')
                ->with('status', 'ゲストユーザーとしてログインしました');
        }

        return redirect()->route('top.show')
            ->with('user_error_message', 'ゲストログインに失敗しました');
    }
}
