<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\EmailChangeRequest;
use App\User;

class EmailChangeController extends Controller
{
    public function __construct()
    {
        // "edit"と"update"メソッドにおいて, Policyクラスにて定義した認可機能を適用
        $this->authorizeResource(User::class, 'user_email');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user_email
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user_email)
    {
        $email_active_flag = true;

        return view('users.email_edit', compact('user_email', 'email_active_flag'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  User  $user_email
     * @return \Illuminate\Http\Response
     */
    public function update(EmailChangeRequest $request, User $user_email)
    {
        $guest_user_id = 1;
        // ゲストユーザーの処理防止
        if ($guest_user_id === Auth::id()) {
            return redirect()->route('user-email.edit', [$user_email])
                ->with('user_error_message', 'ゲストユーザーはメールアドレスを変更することができません。');
        }

        $user_email->email = $request->input('email');
        $user_email->save();

        return redirect()->route('user-email.edit', [$user_email])
            ->with('status', 'メールアドレスを変更しました。');
    }
}
