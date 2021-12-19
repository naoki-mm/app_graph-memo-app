<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\PasswordChangeRequest;
use Illuminate\Support\Facades\Hash;
use App\User;

class PasswordChangeController extends Controller
{
    public function __construct()
    {
        // "edit"と"update"メソッドにおいて, Policyクラスにて定義した認可機能を適用
        $this->authorizeResource(User::class, 'user_password');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user_password
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user_password)
    {
        $password_active_flag = true;

        return view('users.password_edit', compact('user_password', 'password_active_flag'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  User  $user_password
     * @return \Illuminate\Http\Response
     */
    public function update(PasswordChangeRequest $request, User $user_password)
    {
        $guest_user_id = 1;
        // ゲストユーザーの処理防止
        if ($guest_user_id === Auth::id()) {
            return redirect()->route('user-password.edit', [$user_password])
                ->with('user_error_message', 'ゲストユーザーはパスワードを変更することができません。');
        }

        $user_password->password = Hash::make($request->input('password'));
        $user_password->save();
        return redirect()->route('user-password.edit', [$user_password])
            ->with('status', 'パスワードを変更しました。');
    }
}
